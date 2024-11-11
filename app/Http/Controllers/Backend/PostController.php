<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Repositories\PostRepository;
use App\Repositories\PostCatalogueRepository;
use App\Services\PostService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $postService;
    protected $postRepository;
    protected $postCatalogueRepository;
    public function __construct(
        PostService $postService,
        PostRepository $postRepository,
        PostCatalogueRepository $postCatalogueRepository,

    ) {
        $this->postService = $postService;
        $this->postRepository = $postRepository;
        $this->postCatalogueRepository = $postCatalogueRepository;
    }

    public function datahome()
    {
        $data = Post::take(1)->get();
        return response()->json([
            'data'    => $data,
        ]);
    }

    public function dataPOST()
    {
        $data = Post::orderBy('name')
            ->take(2)->get();
        return response()->json([
            'data'    => $data,
        ]);
    }


    public function index(Request $request)
    {
        $posts = $this->postService->paginate($request);
        //  dd($posts);
        $template = 'backend.post.post.index';
        return view('backend.dashboard.layout', compact(
            'template',
            'posts',
        ));
    }
    public function create()
    {
        $posts = $this->postService->all();
        $postCatalogues = $this->postCatalogueRepository->all();
        $template = 'backend.post.post.create';
        return view('backend.dashboard.layout', compact(
            'template',
            'posts',
            'postCatalogues',
        ));
    }
    public function store(StorePostRequest $request)
    {
        // gọi tới service với phương thức create
        $result = $this->postService->create($request);
        if ($result) {
            flash()->success('Thêm mới thành công');
            return redirect()->route('post.index');
        } else {
            flash()->error('Thất bại. Đã có lỗi xảy ra vui lòng thử lại!');
            return redirect()->back();
        }
    }
    public function update($slug)
    {
        $post = $this->postRepository->findBySlug($slug);
        // lấy ra tất cả vs điều kiện (không lấy ra bản ghi đàn được find)
        $postCatalogues = $this->postCatalogueRepository->all();

        // dd($postCatalogues);
        $template = 'backend.post.post.update';
        return view('backend.dashboard.layout', compact(
            'template',
            'post',
            'postCatalogues',
        ));
    }
    public function edit($slug, UpdatePostRequest $request)
    {
        $result = $this->postService->update($slug, $request);
        if ($result) {
            flash()->success('cập nhật thành công');
            return redirect()->route('post.index');
        } else {
            flash()->error('Thất bại. Đã có lỗi xảy ra vui lòng thử lại!');
            return redirect()->back();
        }
    }
    public function delete($id = 0)
    {
        $post = $this->postRepository->findById($id);
        $template = 'backend.post.post.delete';
        return view('backend.dashboard.layout', compact(
            'template',
            'post',
        ));
    }
    public function destroy($id = 0)
    {
        if ($_POST['submit'] == 'cancel') {
            flash()->warning('Bài viết chưa được xóa!');
            return redirect()->route('post.index');
        } else {
            $result = $this->postService->destroy($id);
            if ($result) {
                flash()->success('Bài viết đã được xóa thành công!');
                return redirect()->route('post.index');
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
            $this->postService->destroyBulk($arrayId);
            flash()->success('Xóa thành công các bản ghi.');
        } else {
            flash()->warning('Không có bản ghi nào được chọn để xóa.');
        }
        return redirect()->route('post.index');
    }
}
