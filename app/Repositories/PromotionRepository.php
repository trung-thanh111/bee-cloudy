<?php

namespace App\Repositories;

use App\Models\Promotion;
use App\Repositories\Interfaces\PromotionRepositoryInterface;

/** class BaseRepository
 * @package App\Repositories
 */


class PromotionRepository extends BaseRepository implements PromotionRepositoryInterface {
    
    protected $model;

    public function __construct(Promotion $model) {
        $this->model = $model;
    }

    
}

