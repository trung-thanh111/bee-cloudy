<?php

namespace App\Repositories;

use App\Models\ProductCatalogue;
use App\Repositories\Interfaces\ProductCatalogueRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

/** class BaseRepository
 * @package App\Repositories
 */


class ProductCatalogueRepository extends BaseRepository implements ProductCatalogueRepositoryInterface {
    
    protected $model;

    public function __construct(ProductCatalogue $model) {
        $this->model = $model;
    }
    
    
}

