<?php

namespace App\Repositories;

use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Models\Order;

/** class BaseRepository
 * @package App\Repositories
 */


class OrderRepository extends BaseRepository implements OrderRepositoryInterface
{

    protected $model;

    public function __construct(Order $model)
    {
        $this->model = $model;
    }
    public function all(array $relations = [], array $conditions = []) {
        $query = $this->model->with($relations);
        
        foreach ($conditions as $condition) {
            if (is_array($condition) && count($condition) === 3) {
                $query->where($condition[0], $condition[1], $condition[2]);
            } elseif (is_array($condition) && count($condition) === 2) {
                $query->where($condition[0], $condition[1]);
            }
        }
        
        return $query->orderBy('created_at', 'DESC')->first();
    }

    public function pagination(
        array $column = ['*'],
        array $condition = [],
        array $relation = [],
        array $orderBy = ['id', 'ASC'],
        int $perPage = 5,
    ) {
        $query = $this->model->select($column);
        return $query
            ->keyword($condition['keyword'] ?? null, ['full_name', 'code', 'phone', 'email', 'status','address', 'payment_method'])
            ->publish($condition['publish'] ?? null)
            ->customWhere($condition['where'] ?? null)
            ->customCreated($condition['created_at'] ?? null)
            ->relation($relation ?? null)
            ->customOrderBy($orderBy ?? null)
            ->paginate($perPage);
    }

    public function updateById($id = 0, array $payload = [])
    {
        // tim theo ban ghi k can quan he K truyen ralation
        $model = $this->findById($id);
        if ($model) {
            $model->update($payload);
            return $model->fresh();
        }
        return false;
    }

    public function getLimitOrder(array $relations = [], array $conditions = [],  array $orderBy = ['created_at', 'desc'], $limit = 5,)
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
        foreach ($orderBy as $order) {
            $query->orderBy($order[0], $order[1]);
        }

        return $query->limit($limit)->get();
    }

    public function findOrderFirst($condition = [], $relation = [], array $orderBy = ['created_at', 'desc']) {
        $query = $this->model->with($relation);
        foreach($condition as $key => $val) {
            if(count($val) == 3) {
                $query->where($val[0], $val[1], $val[2]);
            } else {
                $query->where($val[0], '=', $val[1]);
            }
        }
        foreach ($orderBy as $order) {
            $query->orderBy($order[0], $order[1]);
        }
        return $query->first();
    }
}
