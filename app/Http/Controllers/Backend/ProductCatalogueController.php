<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ProductCatalogueService;
use App\Repositories\ProductCatalogueRepository;
use App\Http\Requests\StoreProductCatalogueRequest;
use App\Http\Requests\UpdateProductCatalogueRequest;

class ProductCatalogueController extends Controller
{
    protected $productCatalogueService;
    protected $productCatalogueRepository;
    public function __construct(
        ProductCatalogueService $productCatalogueService,
        ProductCatalogueRepository $productCatalogueRepository,
    ) {
        $this->productCatalogueService = $productCatalogueService;
        $this->productCatalogueRepository = $productCatalogueRepository;
    }

    public function index(Request $request)
    {
        $productCatalogues = $this->productCatalogueService->paginate($request);
        $template = 'backend.product.catalogue.index';
        return view('backend.dashboard.layout', compact(
            'template',
            'productCatalogues',
        ));
    }
    public function create()
    {
        $productCatalogues = $this->productCatalogueService->all();
        $template = 'backend.product.catalogue.create';
        return view('backend.dashboard.layout', compact(
            'template',
            'productCatalogues',
        ));
    }
    public function store(StoreProductCatalogueRequest $request)
    {
        // gọi tới service với phương thức create 
        $result = $this->productCatalogueService->create($request);
        if ($result) {
            flash()->success('Thêm mới thành công');
            return redirect()->route('product.catalogue.index');
        } else {
            flash()->error('Thất bại. Đã có lỗi xảy ra vui lòng thử lại!');
            return redirect()->back();
        }
    }
    public function update($slug)
    {
        $productCatalogue = $this->productCatalogueRepository->findBySlug($slug);
        $orders = $this->productCatalogueRepository->all();
        // lấy ra tất cả vs điều kiện (không lấy ra bản ghi đàn được find)
        $productCatalogues = $this->productCatalogueRepository->allWhere([
            ['slug', '!=', $productCatalogue->slug]
        ]);


        $template = 'backend.product.catalogue.update';
        return view('backend.dashboard.layout', compact(
            'template',
            'productCatalogue',
            'productCatalogues',
            'orders',
        ));
    }
    public function edit($slug, UpdateProductCatalogueRequest $request)
    {
        $result = $this->productCatalogueService->update($slug, $request);
        if ($result) {
            flash()->success('cập nhật thành công');
            return redirect()->route('product.catalogue.index');
        } else {
            flash()->error('Thất bại. Đã có lỗi xảy ra vui lòng thử lại!');
            return redirect()->back();
        }
    }
    public function delete($id = 0)
    {
        $productCatalogue = $this->productCatalogueRepository->findById($id);
        $template = 'backend.product.catalogue.delete';
        return view('backend.dashboard.layout', compact(
            'template',
            'productCatalogue',
        ));
    }
    public function destroy($id = 0)
    {
        if ($_POST['submit'] == 'cancel') {
            flash()->warning('Nhóm sản phẩm chưa được xóa!');
            return redirect()->route('product.catalogue.index');
        } else {
            $result = $this->productCatalogueService->destroy($id);
            if ($result) {
                flash()->success('Nhóm sản phẩm đã được xóa thành công!');
                return redirect()->route('product.catalogue.index');
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
            $this->productCatalogueService->destroyBulk($arrayId);
            flash()->success('Xóa thành công các bản ghi.');
        } else {
            flash()->warning('Không có bản ghi nào được chọn để xóa.');
        }

        return redirect()->route('product.catalogue.index');
    }
    
}
