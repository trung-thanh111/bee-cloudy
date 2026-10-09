<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Services\BannerService;
use App\Http\Controllers\Controller;
use App\Repositories\BannerRepository;
use App\Http\Requests\StoreBannerRequest;
use App\Http\Requests\UpdateBannerRequest;

class BannerController extends Controller
{
    protected $bannerService;
    protected $bannerRepository;
    protected $bannerCatalogueRepository;
    public function __construct(
        BannerService $bannerService,
        BannerRepository $bannerRepository,

    ) {
        $this->bannerService = $bannerService;
        $this->bannerRepository = $bannerRepository;
    }

    public function index(Request $request)
    {
        $banners = $this->bannerService->paginate($request);
        //  dd($banners);
        $template = 'backend.banner.index';
        return view('backend.dashboard.layout', compact(
            'template',
            'banners',
        ));
    }
    public function create()
    {
        $banners = $this->bannerService->all();
        $template = 'backend.banner.create';
        return view('backend.dashboard.layout', compact(
            'template',
            'banners',
        ));
    }
    public function store(StoreBannerRequest $request)
    {
        // gọi tới service với phương thức create 
        $result = $this->bannerService->create($request);
        if ($result) {
            flash()->success('Thêm mới thành công');
            return redirect()->route('banner.index');
        } else {
            flash()->error('Thất bại. Đã có lỗi xảy ra vui lòng thử lại!');
            return redirect()->back();
        }
    }
    public function update($id)
    {
        $banner = $this->bannerRepository->findById($id);
        $template = 'backend.banner.update';
        return view('backend.dashboard.layout', compact(
            'template',
            'banner',
        ));
    }
    public function edit($id, UpdateBannerRequest $request)
    {
        $result = $this->bannerService->update($id, $request);
        if ($result) {
            flash()->success('cập nhật thành công');
            return redirect()->route('banner.index');
        } else {
            flash()->error('Thất bại. Đã có lỗi xảy ra vui lòng thử lại!');
            return redirect()->back();
        }
    }
    public function delete($id = 0)
    {
        $banner = $this->bannerRepository->findById($id);
        $template = 'backend.banner.delete';
        return view('backend.dashboard.layout', compact(
            'template',
            'banner',
        ));
    }
    public function destroy($id = 0)
    {
        if ($_POST['submit'] == 'cancel') {
            flash()->warning('Banner chưa được xóa!');
            return redirect()->route('banner.index');
        } else {
            $result = $this->bannerService->destroy($id);
            if ($result) {
                flash()->success('Banner đã được xóa thành công!');
                return redirect()->route('banner.index');
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
            $this->bannerService->destroyBulk($arrayId);
            flash()->success('Xóa thành công các bản ghi.');
        } else {
            flash()->warning('Không có bản ghi nào được chọn để xóa.');
        }
        return redirect()->route('banner.index');
    }
}
