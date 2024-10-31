<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Interfaces\ShopRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

/** class BaseRepository
 * @package App\Repositories
 */


class ShopRepository extends BaseRepository implements ShopRepositoryInterface
{

    protected $model;

    public function __construct(Product $model)
    {
        $this->model = $model;
    }
    public function getLimitOrder(array $relations = [], array $conditions = [],  array $orderBy = ['created_at', 'asc'], $limit = 4,)
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
        

        return $query->limit($limit)->get();
    }
    public function filter(
        array $column = ['*'],
        array $condition = [],
        array $relation = [],
        array $orderBy = ['id', 'ASC'],
        int $perPage = 5,
    ) {
        $query = $this->model->select($column);
        return $query
            ->keyword($condition['keyword'] ?? null)
            ->publish($condition['publish'] ?? null)
            ->customWhere($condition['where'] ?? null)
            ->relation($relation ?? null)
            ->customOrderBy($orderBy ?? null)
            ->paginate($perPage);
    }
}
