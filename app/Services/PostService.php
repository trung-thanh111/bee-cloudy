<?php

namespace App\Services;

use App\Models\Post;
use App\Repositories\PostRepository;
use App\Services\Interfaces\PostServiceInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * interface  UserService
 * @package App\Services
 */

class PostService implements PostServiceInterface
{
    protected $postRepository;
    public function __construct(
        PostRepository $postRepository

    ) {
        $this->postRepository = $postRepository;
    }

    public function all()
    {
        return $this->postRepository->all();
    }

    public function paginateFontend($request)
    {
        $condition = [
            ['publish', 1]
        ];
        $relation = ['users'];
        $perPage = 5;
        $posts = $this->postRepository->pagination(
            $this->paginateSelect(),
            $condition,
            $relation,
            ['created_at', 'asc'],
            $perPage,
        );

        return $posts;
    }

    public function paginate($request)
    {
        $condition = [
            'keyword' => addslashes($request->input('keyword')),
            'publish' => $request->input('publish') !== null ? $request->integer('publish') : null,
        ];
        $relation = ['postCatalogues','users'];
        $perPage = $request->integer('perpage') ?: 10;
        $posts = $this->postRepository->pagination(
            $this->paginateSelect(),
            $condition,
            $relation,
            ['id', 'DESC'],
            $perPage,
        );

        // dd($posts);
        return $posts;
    }

    public function create($request)
    {
        DB::beginTransaction();
        try {
            $payload = $request->except(['_token', 'submit']);
            $payload['slug'] = Str::slug($payload['slug'],'-').'-'.rand(10000, 99999);
            $payload['user_id'] = Auth::id();
            $post = $this->postRepository->create($payload);
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
            // Lấy bài viết
            $post = $this->postRepository->findBySlug($slug);
            if (!$post) {
                flash()->error('Không tìm thấy bản ghi.');
            }
            $payload = $request->except(['_token', 'submit']);
            $payload['slug'] = Str::slug($payload['slug'],'-');
            $this->postRepository->update($post->slug, $payload);
            // Cập nhật mối quan hệ nhiều-nhiều
            if (isset($request->post_catalogue_id)) {
                $post->postCatalogues()->sync($request->post_catalogue_id);
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }
    public function destroy($id = 0)
    {
        DB::beginTransaction();
        try {
            // xóa cứng -> forceDelete()
            $this->postRepository->forceDelete($id);
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
                    $post = $this->postRepository->findById($id);

                    // Kiểm tra nếu có liên kết trong bảng `Posts`
                    if ($post->posts()->exists()) {
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
                $this->postRepository->bulkDelete($arrayIdSatisfied);
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            return false;
        }
    }
    private function paginateSelect()
    {
        return [
            'id',
            'name',
            'content',
            'image',
            'description',            
            'outstanding',
            'like',
            'slug',
            'user_id',
            'cre',
            'publish',
            'created_at',
        ];
    }
}
