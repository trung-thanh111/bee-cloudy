<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

/** class BaseRepository
 * @package App\Repositories
 */


class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{

    protected $model;

    public function __construct(Product $model)
    {
        $this->model = $model;
    }
    public function getLimit(array $relations = [], array $conditions = [], $limit = 4)
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

        return $query->limit($limit)->get();
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
    public function getProductBySlug(string $slug = '')
    {
        return $this->model
            ->select(['*'])
            ->with(['productCatalogues',
             'productVariant' => function ($query) {
                $query->where('quantity', '>', 0); 
            }, 
             'productVariant.attributes'])
            ->with('brands')
            ->where('slug', $slug)
            ->first();
    }

    public function getVariantFindBySlug(array $relations = [], array $conditions = [])
    {
        $query = $this->model->with($relations);

        foreach($conditions as $key => $val) {
            if(count($conditions) == 3) {
                $query->where($val[0], $val[1], $val[2]);
            } else {
                $query->where($val[0], '=', $val[1]);
            }
        }

        return $query->first();
    }

    public function create($payload = [])
    {
        $product = $this->model->create($payload);

        if (isset($payload['product_catalogue_id'])) {
            if (is_array($payload['product_catalogue_id'])) {
                // attach() thêm mới record vào bảng trung gian với qh n-n mà k xóa bản ghi đã có
                $product->productCatalogues()->attach($payload['product_catalogue_id']);
            } else {
                $product->productCatalogues()->attach($payload['product_catalogue_id']);
            }
        }
        return $product;
    }
}
