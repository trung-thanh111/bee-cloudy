<?php

namespace App\Repositories;

use App\Models\AttributeCatalogue;
use App\Repositories\Interfaces\AttributeCatalogueRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

/** class BaseRepository
 * @package App\Repositories
 */


class AttributeCatalogueRepository extends BaseRepository implements AttributeCatalogueRepositoryInterface {
    
    protected $model;

    public function __construct(AttributeCatalogue $model) {
        $this->model = $model;
    }

    
}

