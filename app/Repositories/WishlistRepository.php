<?php

namespace App\Repositories;

use App\Repositories\Interfaces\WishlistRepositoryInterface;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

/** class BaseRepository
 * @package App\Repositories
 */


class WishlistRepository extends BaseRepository implements WishlistRepositoryInterface
{

    protected $model;

    public function __construct(WishList $model)
    {
        $this->model = $model;
    }
    public function all(array $relations = [], array $conditions = [])
    {
        $query = $this->model->with($relations);

        foreach ($conditions as $condition) {
            if (is_array($condition) && count($condition) === 3) {
                $query->where($condition[0], $condition[1], $condition[2]);
            } elseif (is_array($condition) && count($condition) === 2) {
                $query->where($condition[0], $condition[1]);
            }
        }

        return $query->get();
    }
    // tìm bản ghi đã tồn tại hay chưa
    public function findByUserProductVariant($userId, $productId = null, $variantId = null)
    {
        return $this->model->where('user_id', $userId)
            ->when($productId, function ($query) use ($productId) {
                $query->where('product_id', $productId);
            }, function ($query) {
                $query->whereNull('product_id');
            })
            ->when($variantId, function ($query) use ($variantId) {
                $query->where('product_variant_id', $variantId);
            }, function ($query) {
                $query->whereNull('product_variant_id');
            })
            ->first();
    }
}
