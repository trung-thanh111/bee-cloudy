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

    public function getLimitOrder(array $relations = [], array $conditions = [],  array $orderBy = ['created_at', 'asc'], array $postCatalogueId = [], $limit = 4,)
    {
        $query = $this->model->with($relations);

        foreach ($conditions as $condition) {
            if (is_array($condition) && count($condition) === 3) {
                $query->where($condition[0], $condition[1], $condition[2]);
            } elseif (is_array($condition) && count($condition) === 2) {
                if (in_array(strtolower($condition[1]), ['asc', 'desc'])) {
                    $query->orderBy($condition[0], $condition[1]);
                } else {
                    $query->where($condition[0], $condition[1]);
                }
            }
        }
        // orderBy
        foreach ($orderBy as $order) {
            $query->orderBy($order[0], $order[1]);
        }
        // relation pivot 
        if (!empty($postCatalogueId)) {
            $query->whereHas('postCatalogues', function ($q) use ($postCatalogueId) {
                $q->whereIn('post_catalogue_id', $postCatalogueId);
            });
        }

        return $query->limit($limit)->get();
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
