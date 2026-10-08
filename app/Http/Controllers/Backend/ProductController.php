<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Http\Controllers\Controller;
use App\Repositories\BrandRepository;
use App\Repositories\ProductRepository;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Repositories\ProductCatalogueRepository;
use App\Repositories\AttributeCatalogueRepository;

class ProductController extends Controller
{
    protected $productService;
    protected $brandRepository;
    protected $productRepository;
    protected $productCatalogueRepository;
    protected $attributeCatalogueRepository;
    public function __construct(
        ProductService $productService,
        BrandRepository $brandRepository,
        ProductRepository $productRepository,
        ProductCatalogueRepository $productCatalogueRepository,
        AttributeCatalogueRepository $attributeCatalogueRepository,
    ) {
        $this->productService = $productService;
        $this->brandRepository = $brandRepository;
        $this->productRepository = $productRepository;
        $this->attributeCatalogueRepository = $attributeCatalogueRepository;
        $this->productCatalogueRepository = $productCatalogueRepository;
    }

    public function index(Request $request)
    {
        $products = $this->productService->paginate($request);
        $brands = $this->brandRepository->all();
        // dd($products);
        $template = 'backend.product.product.index';
        return view('backend.dashboard.layout', compact(
            'template',
            'products',
            'brands',
        ));
    }
    public function create()
    {
        $products = $this->productService->all();
        $productCatalogues = $this->productCatalogueRepository->all();
        $attributeCatalogue = $this->attributeCatalogueRepository->all();
        $brands = $this->brandRepository->all();
        $template = 'backend.product.product.create';
        return view('backend.dashboard.layout', compact(
            'template',
            'brands',
            'products',
            'productCatalogues',
            'attributeCatalogue',
        ));
    }
    public function store(StoreProductRequest $request)
    {
        // gọi tới service với phương thức create 
        $result = $this->productService->create($request);
        if ($result) {
            flash()->success('Thêm mới thành công');
            return redirect()->route('product.index');
        } else {
            flash()->error('Thất bại. Đã có lỗi xảy ra vui lòng thử lại!');
            // return redirect()->back();
        }
    }
    public function update($slug)
    {
        $product = $this->productRepository->getProductBySlug($slug);
        // lấy ra tất cả vs điều kiện (không lấy ra bản ghi đàn được find)
        $productCatalogues = $this->productCatalogueRepository->all();
        $attributeCatalogue = $this->attributeCatalogueRepository->all();
        $brands = $this->brandRepository->all();

        // dd($productCatalogues);
        $template = 'backend.product.product.update';
        return view('backend.dashboard.layout', compact(
            'template',
            'brands',
            'product',
            'productCatalogues',
            'attributeCatalogue',
        ));
    }
    public function edit($slug, UpdateProductRequest $request)
    {
        $result = $this->productService->update($slug, $request);
        if ($result) {
            flash()->success('cập nhật thành công');
            return redirect()->route('product.index');
        } else {
            flash()->error('Thất bại. Đã có lỗi xảy ra vui lòng thử lại!');
            return redirect()->back();
        }
    }
    public function delete($id = 0)
    {
        $product = $this->productRepository->findById($id);
        $template = 'backend.product.product.delete';
        return view('backend.dashboard.layout', compact(
            'template',
            'product',
        ));
    }
    public function destroy($id = 0)
    {
        if ($_POST['submit'] == 'cancel') {
            flash()->warning('Sản phẩm chưa được xóa!');
            return redirect()->route('product.index');
        } else {

            $result = $this->productService->destroy($id);
            if ($result) {
                flash()->success('Sản phẩm đã được xóa thành công!');
                return redirect()->route('product.index');
            } else {
                flash()->error('Có lỗi khi xóa, vui lòng thử lại!');
                return redirect()->back();
            }
        }
    }

    public function destroyMultiple(Request $request)
    {
        // Lấy giá trị từ input ẩn đã truyền mảng ID
        $listId = $request->input('array_id');

        // Kiểm tra nếu có ID, và tách chuỗi thành mảng
        if ($listId) {
            $arrayId = explode(',', $listId);
            dd($arrayId);
            $this->productService->destroyBulk($arrayId);
            flash()->success('Xóa thành công các bản ghi.');
        } else {
            flash()->warning('Không có bản ghi nào được chọn để xóa.');
        }

        return redirect()->route('product.index');
    }
}
