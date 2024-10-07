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
    public function getProductBySlug(string $slug = '')
    {
        return $this->model
        ->select(['*'])
            ->with(['productCatalogues', 'productVariant', 'productVariant.attributes'])
            ->where('slug', $slug)
            ->first();
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
