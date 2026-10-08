<?php

namespace App\Services;

use App\Models\Product;
use App\Repositories\ProductRepository;
use App\Services\Interfaces\ProductServiceInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * interface  UserService
 * @package App\Services
 */

class ProductService implements ProductServiceInterface
{
    protected $productRepository;
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function all()
    {
        return $this->productRepository->all();
    }

    public function paginate($request)
    {
        $condition = [
            'keyword' => addslashes($request->input('keyword')),
            'publish' => $request->has('publish') ? $request->integer('publish') : 0,
            'where' => [
                ['product_catalogue_id', '=',  $request->integer('product_catalogue_id')]
            ]
        ];
        $relation = ['productCatalogues'];
        $perPage = $request->integer('perpage') ?: 5;
        $products = $this->productRepository->pagination(
            $this->paginateSelect(),
            $condition,
            $relation,
            ['id', 'ASC'],
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
            
            if ($product->id > 0) {
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
            $payload = $request->except(['_token', 'submit']);
            // dd($payload);
            $data = $this->productRepository->update($slug, $payload);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            die();
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
        $payload = $request->except(['_token', 'submit', 'accept']);
        $payload['user_id'] = Auth::id();
        $product = $this->productRepository->create($payload);
        return $product;
    }
    private function createVariant($product, $request)
    {
        $payload = $request->only(['name', 'variant', 'productVariant', 'attribute']); // các input hidden của variant và productVariant 
        // dd($payload);
        $variant = $this->createVariantArray($payload);
        // xóa hết bản ghi có product variant và inseert lại  
        $product->productVariant()->delete();
        // sử dụng phương thức createmany()
        $variants = $product->productVariant()->createmany($variant);
        // lấy danh sách id của variants -> trc khi commit lần đầu empty bảng product_variant để inert đúng 
        $variantId = $variants->pluck('id');
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

                $variant[] = [
                    'name' => $product_variant_fullname, // Combined product name
                    'code' => ($payload['productVariant']['id'][$key]) ?? '',
                    'quantity' => ($payload['variant']['quantity'][$key]) ?? '',
                    'sku' => $val,
                    'price' => ($payload['variant']['price'][$key]) ?? '',
                    'file_name' => ($payload['variant']['file_name'][$key]) ?? '',
                    'file_url' => ($payload['variant']['file_url'][$key]) ?? '',
                    'album' => ($payload['variant']['album'][$key]) ?? '',
                    'user_id' => Auth::id(),
                ];
            }
        }

        return $variant;
    }
    private function paginateSelect()
    {
        return [
            'id',
            'name',
            'slug',
            'short_desc',
            'description',
            'info',
            'price',
            'brand_id',
            'user_id',
            'publish',
            'created_at'
        ];
    }
}
