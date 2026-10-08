<?php

namespace App\Repositories;

use App\Models\PostCatalogue;
use App\Repositories\Interfaces\PostCatalogueRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

/** class BaseRepository
 * @package App\Repositories
 */


class PostCatalogueRepository extends BaseRepository implements PostCatalogueRepositoryInterface {
    
    protected $model;

    public function __construct(PostCatalogue $model) {
        $this->model = $model;
    }
    
    
}

