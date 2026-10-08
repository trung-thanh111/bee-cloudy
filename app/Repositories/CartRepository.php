<?php

namespace App\Repositories;

use App\Repositories\Interfaces\CartRepositoryInterface;
use App\Models\Cart;

/** class BaseRepository
 * @package App\Repositories
 */


class CartRepository extends BaseRepository implements CartRepositoryInterface
{

    protected $model;

    public function __construct(Cart $model)
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
        
        return $query->first();
    }
}
