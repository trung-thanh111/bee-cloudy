<?php

namespace App\Repositories;

use App\Models\ProductVariant;
use App\Repositories\Interfaces\ProductVariantRepositoryInterface;
use App\Repositories\BaseRepository;


/**
 * @package 
 *
 */

class ProductVariantRepository extends BaseRepository implements ProductVariantRepositoryInterface {
    protected $model;

    public function __construct(ProductVariant $model) {
        $this->model = $model;
    }

    public function findVariant($code, $productId){
        // echo $code; die();
        return $this->model->where([
            ['code', $code],
            ['product_id', $productId],
        ])->first();
    }
}
