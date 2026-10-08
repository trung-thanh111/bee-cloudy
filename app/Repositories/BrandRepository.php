<?php

namespace App\Repositories;

use App\Models\Brand;
use App\Repositories\Interfaces\BrandRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

/** class BaseRepository
 * @package App\Repositories
 */


class BrandRepository extends BaseRepository implements BrandRepositoryInterface {
    
    protected $model;

    public function __construct(Brand $model) {
        $this->model = $model;
    }

    
}

