<?php

namespace App\Repositories;

use App\Models\Post;
use App\Repositories\Interfaces\PostRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

/** class BaseRepository
 * @package App\Repositories
 */


class PostRepository extends BaseRepository implements PostRepositoryInterface
{

    protected $model;

    public function __construct(Post $model)
    {
        $this->model = $model;
    }

    public function create($payload = [])
    {
        $post = $this->model->create($payload);

        if (isset($payload['post_catalogue_id'])) {
            if (is_array($payload['post_catalogue_id'])) {
                // attach() thêm mới record vào bảng trung gian với qh n-n mà k xóa bản ghi đã có
                $post->postCatalogues()->attach($payload['post_catalogue_id']);
            } else {
                $post->postCatalogues()->attach($payload['post_catalogue_id']);
            }
        }
        return $post;
    }
}
