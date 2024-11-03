<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\PostCatalogueService;
use App\Repositories\PostCatalogueRepository;
use App\Http\Requests\StorePostCatalogueRequest;
use App\Http\Requests\UpdatePostCatalogueRequest;

class PostCatalogueController extends Controller
{
    protected $postCatalogueService;
    protected $postCatalogueRepository;
    public function __construct(
        PostCatalogueService $postCatalogueService,
        PostCatalogueRepository $postCatalogueRepository,
    ) {
        $this->postCatalogueService = $postCatalogueService;
        $this->postCatalogueRepository = $postCatalogueRepository;
    }

    public function index(Request $request)
    {
        $postCatalogues = $this->postCatalogueService->paginate($request);
        $template = 'backend.post.catalogue.index';
        return view('backend.dashboard.layout', compact(
            'template',
            'postCatalogues',
        ));
    }
    public function create()
    {
        $postCatalogues = $this->postCatalogueService->all();
        $template = 'backend.post.catalogue.create';
        return view('backend.dashboard.layout', compact(
            'template',
            'postCatalogues',
        ));
    }
    public function store(StorePostCatalogueRequest $request)
    {
        // gọi tới service với phương thức create 
        $result = $this->postCatalogueService->create($request);
        if ($result) {
            flash()->success('Thêm mới thành công');
            return redirect()->route('post.catalogue.index');
        } else {
            flash()->error('Thất bại. Đã có lỗi xảy ra vui lòng thử lại!');
            return redirect()->back();
        }
    }
    public function update($slug)
    {
        $postCatalogue = $this->postCatalogueRepository->findBySlug($slug);
        // lấy ra tất cả vs điều kiện (không lấy ra bản ghi đàn được find)
        $postCatalogues = $this->postCatalogueRepository->allWhere([
            ['slug', '!=', $postCatalogue->slug]
        ]);

        $template = 'backend.post.catalogue.update';
        return view('backend.dashboard.layout', compact(
            'template',
            'postCatalogue',
            'postCatalogues',
        ));
    }
    public function edit($slug, UpdatePostCatalogueRequest $request)
    {
        $result = $this->postCatalogueService->update($slug, $request);
        if ($result) {
            flash()->success('cập nhật thành công');
            return redirect()->route('post.catalogue.index');
        } else {
            flash()->error('Thất bại. Đã có lỗi xảy ra vui lòng thử lại!');
            return redirect()->back();
        }
    }
    public function delete($id = 0)
    {
        $postCatalogue = $this->postCatalogueRepository->findById($id);
        $template = 'backend.post.catalogue.delete';
        return view('backend.dashboard.layout', compact(
            'template',
            'postCatalogue',
        ));
    }
    public function destroy($id = 0)
    {
        if ($_POST['submit'] == 'cancel') {
            flash()->warning('Nhóm bài viết chưa được xóa!');
            return redirect()->route('post.catalogue.index');
        } else {
            $result = $this->postCatalogueService->destroy($id);
            if ($result) {
                flash()->success('Nhóm bài viết đã được xóa thành công!');
                return redirect()->route('post.catalogue.index');
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
            $this->postCatalogueService->destroyBulk($arrayId);
            flash()->success('Xóa thành công các bản ghi.');
        } else {
            flash()->warning('Không có bản ghi nào được chọn để xóa.');
        }

        return redirect()->route('post.catalogue.index');
    }
    
}
