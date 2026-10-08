<?php

namespace App\Repositories;

use App\Models\UserCatalogue;
use App\Repositories\Interfaces\UserCatalogueRepositoryInterface;
use App\Repositories\BaseRepository;


/**
 * @package 
 *
 */

class UserCatalogueRepository extends BaseRepository implements UserCatalogueRepositoryInterface
{

    protected $model;

    public function __construct(UserCatalogue $model)
    {
        $this->model = $model;
    }
    
    public function create($payload = [])
    {
        return $this->model->create($payload);
    }
    public function update($slug = '', $payload = [])
    {
        $model = $this->findBySlug($slug);
        if ($model) {
            $model->update($payload);
            return $model->fresh();
        }
        return false;
    }
    public function userCatalogueAll(){
        // Trả về các giá trị khác nhau từ cột name và lấy cả id 
        return $this->model->select('id', 'name')->distinct()->get();
    }
    
}
