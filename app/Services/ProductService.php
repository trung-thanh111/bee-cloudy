<?php

namespace App\Services;

use App\Models\AttributeCatalogue;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Repositories\ProductRepository;
use App\Repositories\AttributeCatalogueRepository;
use App\Repositories\AttributeRepository;
use App\Repositories\ProductVariantAttributeRepository;
use App\Repositories\ProductVariantRepository;
use App\Services\Interfaces\ProductServiceInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * interface  UserService
 * @package App\Services
 */

class ProductService implements ProductServiceInterface
{
    protected $productRepository;
    protected $productVariantRepository;
    protected $attributeCatalogueRepository;
    protected $attributeRepository;
    protected $productVariantAttributeRepository;
    public function __construct(
        ProductRepository $productRepository,
        AttributeCatalogueRepository $attributeCatalogueRepository,
        AttributeRepository $attributeRepository,
        ProductVariantAttributeRepository $productVariantAttributeRepository,
        ProductVariantRepository $productVariantRepository

    ) {
        $this->productRepository = $productRepository;
        $this->attributeCatalogueRepository = $attributeCatalogueRepository;
        $this->attributeRepository = $attributeRepository;
        $this->productVariantAttributeRepository = $productVariantAttributeRepository;
        $this->productVariantRepository = $productVariantRepository;
    }

    public function all()
    {
        return $this->productRepository->all();
    }

    public function paginate($request)
    {
        $condition = [
            'keyword' => addslashes($request->input('keyword')),
            'publish' => $request->input('publish') !== null ? $request->integer('publish') : null,
            'where' => [
                ['brand_id', '=',  $request->integer('brand_id')]
            ]
        ];
        $relation = ['productCatalogues'];
        $perPage = $request->integer('perpage') ?: 10;
        $products = $this->productRepository->pagination(
            $this->paginateSelect(),
            $condition,
            $relation,
            ['id', 'DESC'],
            $perPage,
        );

        // dd($products);
        return $products;
    }

    public function create($request)
    {
        DB::beginTransaction();
        try {
            $product = $this->createProduct($request);

            // Trường hợp không có phiên bản
            if (!isset($request->variant['sku']) || count($request->variant['sku']) === 0) {
                $product->sku = $request->sku; // Lưu SKU từ request
                $product->save();
            }

            // Trường hợp có phiên bản
            if (isset($request->variant['sku']) && count($request->variant['sku']) > 0) {
                $this->createVariant($product, $request);
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            return false;
        }
    }
    public function update($slug, $request)
    {
        DB::beginTransaction();
        try {
            $product = $this->productRepository->findBySlug($slug);
            if (!$product) {
                throw new \Exception("Không tìm thấy bản ghi!");
            }
            $this->updateProduct($product, $request);

            if ($product->productVariant()->exists()) {
                $product->productVariant()->delete();
            }
            $this->createVariant($product, $request);

            // Cập nhật mối quan hệ nhiều-nhiều
            if (isset($request->product_catalogue_id)) {
                $product->productCatalogues()->sync($request->product_catalogue_id);
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            return false;
        }
    }
    public function destroy($id = 0)
    {
        DB::beginTransaction();
        try {
            // xóa cứng -> forceDelete()
            $this->productRepository->forceDelete($id);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            return false;
        }
    }
    public function destroyBulk($arrayId = [])
    {
        DB::beginTransaction();
        try {
            // Kiểm tra quyền trước khi xóa (phải là admin)
            if (Auth::user()->user_catalogue_id != 2) {
                flash()->warning('Bạn không đủ quyền thực hiện thao tác!');
                return redirect()->back();
            }

            $arrayIdNotSatisfied = []; // k thỏa mãn
            $arrayIdSatisfied = []; // thỏa mãn

            // Duyệt qua từng ID trong mảng
            if (count($arrayId)) {

                foreach ($arrayId as $id) {
                    $product = $this->productRepository->findById($id);

                    // Kiểm tra nếu có liên kết trong bảng `Products`
                    if ($product->products()->exists()) {
                        // Thêm vào danh sách bản ghi không thỏa mãn điều kiện xóa
                        $arrayIdNotSatisfied[] = $id;
                    } else {
                        // Thêm vào danh sách thỏa mãn để xóa
                        $arrayIdSatisfied[] = $id;
                    }
                }
            }
            // Kiểm tra nếu có bản ghi không thỏa mãn
            if (!empty($arrayIdNotSatisfied)) {
                flash()->warning('Không thể xóa các bản ghi sau vì có liên kết: ' . implode(', ', $arrayIdNotSatisfied));
                return redirect()->back();
            }
            // Nếu tất cả các bản ghi đều thỏa mãn, thực hiện xóa
            if (!empty($arrayIdSatisfied)) {
                $this->productRepository->bulkDelete($arrayIdSatisfied);
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            return false;
        }
    }

    private function createProduct($request)
    {
        $payload = $request->only($this->payload());
        $payload['del'] = (isset($payload['del'])) ? $payload['del'] : '0';
        $payload['slug'] = Str::slug($payload['slug'], '-').'-'.rand(10000, 99999);
        $payload['attributeCatalogue'] = $this->formatJson($request, 'attributeCatalogue');
        $payload['attribute'] = $request->input('attribute');
        $payload['variant'] = $this->formatJson($request, 'variant');
        $product = $this->productRepository->create($payload);
        // dd($product);
        return $product;
    }
    private function createVariant($product, $request)
    {
        $payload = $request->only(['name', 'variant', 'productVariant', 'attribute']); // các input hidden của variant và productVariant 
        // dd($payload);
        $variant = $this->createVariantArray($payload);
        if (empty($variant)) {
            return; // Không có variant nào được tạo, thoát khỏi hàm
        }
        // sử dụng phương thức createmany()
        $variants = $product->productVariant()->createMany($variant);
        // lấy danh sách id của variants -> trc khi commit lần đầu empty bảng product_variant để inert đúng 
        $variantId = $variants->pluck('id');
        // dd($variantId);
        $attributeCombines = $this->comebineAttribute(array_values($payload['attribute']));
        if (count($variantId)) {
            foreach ($variantId as $key => $val) {
                if (count(($attributeCombines))) {
                    foreach ($attributeCombines[$key] as $attributeId) {
                        $variantAttribute[] = [
                            'product_variant_id' => $val,
                            'attribute_id' => $attributeId
                        ];
                    }
                }
            }
        }
        $variantAttribute = $this->productVariantAttributeRepository->createBatch($variantAttribute);
    }

    private function comebineAttribute($attributes = [], $index = 0)
    {
        // đk dừng đệ quy 
        if ($index === count($attributes)) return [[]];
        // đệ quy 
        $subComebines = $this->comebineAttribute($attributes, $index + 1);
        $combines  = [];
        foreach ($attributes[$index] as $key => $val) {
            foreach ($subComebines as $keySub => $valSub) {
                $combines[] = array_merge([$val], $valSub);
            }
        }
        return $combines;
    }


    private function createVariantArray($payload = [])
    {
        $variant = [];

        if (isset($payload['variant']['sku']) && count($payload['variant']['sku'])) {
            foreach ($payload['variant']['sku'] as $key => $val) {
                $variantName = isset($payload['productVariant']['name'][$key])
                    ? $payload['productVariant']['name'][$key]
                    : '';

                $product_variant_fullname = isset($payload['name'])
                    ? $payload['name'] . ' - ' . $variantName
                    : '';

                $vId = ($payload['productVariant']['id'][$key]) ?? '';
                $productVariantId = sortString($vId);
                $variant[] = [
                    'name' => $product_variant_fullname, // Combined product name
                    'code' => $productVariantId,
                    'quantity' => ($payload['variant']['quantity'][$key]) ?? '',
                    'sku' => $val,
                    'price' => ($payload['variant']['price'][$key]) ?? '',
                    'file_name' => ($payload['variant']['file_name'][$key]) ?? '',
                    'file_url' => ($payload['variant']['file_url'][$key]) ?? '',
                    'album' => ($payload['variant']['album'][$key]) ?? '',
                ];
            }
        }

        return $variant;
    }
    private function updateProduct($product, $request)
    {
        $payload = $request->only($this->payload());
        $payload['slug'] = Str::slug($payload['slug'], '-');
        $payload['attributeCatalogue'] = $this->formatJson($request, 'attributeCatalogue');
        if ($request->has('attribute')) {
            $payload['attribute'] = $request->input('attribute');
        } else {
            // Nếu không có attribute trong request, gán giá trị null hoặc một mảng rỗng
            $payload['attribute'] = null; // hoặc []
        }
        $payload['variant'] = $this->formatJson($request, 'variant');

        $product->update($payload);
        return $product;
    }
    public function formatJson($request, $inputName)
    {
        return ($request->input($inputName) && !empty($request->input($inputName)) ? json_encode($request->input($inputName)) : '');
    }

    //lấy ra các attribute của sản phẩm thông qua cột attribue trong bảng product(chitietsp)
    public function getAttribute($product)
    {
        // Lọc ra các id của nhóm thuộc tính
        if (is_null($product->attribute) || !is_array($product->attribute)) {
            if (is_string($product->attribute)) {
                $product->attribute = json_decode($product->attribute, true);
            }

            if (!is_array($product->attribute)) {
                return $product;
            }
        }
        $attributeCatalogueId = array_keys($product->attribute);
        // Lấy các thuộc tính dựa trên ID
        $attributeCatalogues = $this->attributeCatalogueRepository->getAttributeCatalogueWhereIn('id', $attributeCatalogueId);
        // ---- //
        // lấy ra mảng id và merge lại vs nhau
        $attributeId = array_merge(...$product->attribute);
        $attrs = $this->attributeRepository->findAttributeByIdArray($attributeId);
        // merge lại thành từng khối 
        if (!is_null($attributeCatalogues)) {
            foreach ($attributeCatalogues as $key => $val) {
                $tempAttributes = [];
                foreach ($attrs as $attr) {
                    if ($val->id == $attr->attribute_catalogue_id) {
                        $tempAttributes[] = $attr;
                    }
                }
                $val->attributes = $tempAttributes;
            }
        }
        $product->attributeCatalogue = $attributeCatalogues;
        return $product;
    }

    public function checkAttributeVariantQuantity(string $slug = '')
    {
        $productVariants = $this->productRepository->getVariantFindBySlug(
            [
                'productCatalogues',
                'productVariant' => function ($query) {
                    $query->where('quantity', '>', 0);
                },
                'productVariant.attributes'
            ],
            [
                ['slug', $slug],
            ]
        );

        $result = [
            'color' => [], // màu
            'size' => [], // kích thước
        ];
        // dd($productVariants);
        foreach ($productVariants->productVariant as $variant) {
            // dd($variant->code);
            if ($variant->code) {
                $codes = explode(',', $variant->code);
                if (count($codes) === 2) {
                    list($colorId, $sizeId) = $codes;

                    if (!in_array((int)$colorId, $result['color'])) {
                        $result['color'][] = (int)$colorId;
                    }
                    if (!in_array((int)$sizeId, $result['size'])) {
                        $result['size'][] = (int)$sizeId;
                    }
                } elseif (count($codes) === 1) {
                    list($colorId) = $codes;

                    $arrayColorId = $this->isColor();

                    if (in_array((int)$colorId, $arrayColorId)) {
                        if (!in_array((int)$colorId, $result['color'])) {
                            $result['color'][] = (int)$colorId;
                        }
                    } else {
                        // if (!in_array((int)$sizeId, $result['size'])) {
                        //     $result['size'][] = (int)$sizeId;
                        // }
                    }
                }
            }
        }
        // dd($result);
        return $result;
    }
    public function isColor()
    {
        $arrayColorId = [];
        $colors = $this->attributeRepository->allWhere([
            ['attribute_catalogue_id', 1]
        ]);
        foreach ($colors as $color) {
            $arrayColorId[] = $color->id;
        }
        return $arrayColorId;
    }
    // dashboard
    public function productSaler(){
        $condition = [
            'where' => [
                ['publish', '=',  1],
                ['sold_count', '>=',  5]
            ]
        ];
        $relation = ['productVariant', 'productVariant.attributes'];
        $perPage = 5;
        $products = $this->productRepository->pagination(
            $this->paginateSelect(),
            $condition,
            $relation,
            ['sold_count', 'DESC'],
            $perPage,
        );

        return $products;
    }
    public function productNews(){
        $condition = [
            'where' => [
                ['publish', '=',  1],
            ]
        ];
        $relation = ['productVariant', 'productVariant.attributes'];
        $perPage = 8;
        $products = $this->productRepository->pagination(
            $this->paginateSelect(),
            $condition,
            $relation,
            ['sold_count', 'DESC'],
            $perPage,
        );

        return $products;
    }
    public function productSales(){
        $products = $this->productRepository->getLimitOrder(
            ['productVariant', 'productVariant.attributes'],
            [
                ['publish', '=',  1],
                ['del', '>',  0],
            ],
            [
                ['del', 'asc']
            ],
            8
        );

        return $products;
    }
    public function productSupperSales(){
        $products = $this->productRepository->getLimitOrder(
            ['productVariant', 'productVariant.attributes'],
            [
                ['publish', '=',  1],
                ['del', '>',  0],
            ],
            [
                ['del', 'desc']
            ],
            8
        );

        return $products;
    }

    private function payload()
    {
        return [
            'name',
            'slug',
            'image',
            'album',
            'info',
            'description',
            'brand_id',
            'is_hot',
            'price',
            'del',
            'sku',
            'attributeCatalogue', // json
            'attribute', // json
            'variant',  // json
            'publish',
            'product_catalogue_id',
            'created_at',
        ];
    }
    private function paginateSelect()
    {
        return [
            'id',
            'name',
            'slug',
            'image',
            'album',
            'info',
            'description',
            'brand_id',
            'is_hot',
            'price',
            'del',
            'sold_count',
            'sku',
            'attributeCatalogue', // json
            'attribute', // json
            'variant',  // json
            'publish',
        ];
    }
}
