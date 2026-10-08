<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Services\BrandService;
use App\Http\Controllers\Controller;
use App\Repositories\BrandRepository;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;

class BrandController extends Controller
{
    protected $brandService;
    protected $brandRepository;
    public function __construct(
        BrandService $brandService,
        BrandRepository $brandRepository,
    ) {
        $this->brandService = $brandService;
        $this->brandRepository = $brandRepository;
    }

    public function index(Request $request)
    {
        $brands = $this->brandService->paginate($request);
        $template = 'backend.brand.index';
        return view('backend.dashboard.layout', compact(
            'template',
            'brands',
        ));
    }
    public function create()
    {
        $brands = $this->brandService->all();
        $template = 'backend.brand.create';
        return view('backend.dashboard.layout', compact(
            'template',
            'brands',
        ));
    }
    public function store(StoreBrandRequest $request)
    {
        // gọi tới service với phương thức create 
        $result = $this->brandService->create($request);
        if ($result) {
            flash()->success('Thêm mới thành công');
            return redirect()->route('brand.index');
        } else {
            flash()->error('Thất bại. Đã có lỗi xảy ra vui lòng thử lại!');
            return redirect()->back();
        }
    }
    public function update($slug)
    {
        $brand = $this->brandRepository->findBySlug($slug);
        $template = 'backend.brand.update';
        return view('backend.dashboard.layout', compact(
            'template',
            'brand',
        ));
    }
    public function edit($slug, UpdateBrandRequest $request)
    {
        $result = $this->brandService->update($slug, $request);
        if ($result) {
            flash()->success('cập nhật thành công');
            return redirect()->route('brand.index');
        } else {
            flash()->error('Thất bại. Đã có lỗi xảy ra vui lòng thử lại!');
            return redirect()->back();
        }
    }
    public function delete($id = 0)
    {
        $brand = $this->brandRepository->findById($id);
        $template = 'backend.brand.delete';
        return view('backend.dashboard.layout', compact(
            'template',
            'brand',
        ));
    }
    public function destroy($id = 0)
    {
        if ($_POST['submit'] == 'cancel') {
            flash()->warning('Nhóm thuộc tính chưa được xóa!');
            return redirect()->route('brand.index');
        } else {
            $brand = $this->brandRepository->findById($id);
            //kiểm tra xem bản ghi đó có các bản ghi liên quan trong bảng attributes kh
            if ($brand->attributes()->exists()) {
                flash()->warning('Nhóm thuộc tính có các record bên trong không thể xóa!');
                return redirect()->back();
            }
            $result = $this->brandService->destroy($id);
            if ($result) {
                flash()->success('Nhóm thuộc tính đã được xóa thành công!');
                return redirect()->route('brand.index');
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
            $this->brandService->destroyBulk($arrayId);
            flash()->success('Xóa thành công các bản ghi.');
        } else {
            flash()->warning('Không có bản ghi nào được chọn để xóa.');
        }

        return redirect()->route('brand.index');
    }
}
