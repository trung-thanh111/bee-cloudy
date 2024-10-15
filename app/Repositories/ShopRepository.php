<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Interfaces\ShopRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

/** class BaseRepository
 * @package App\Repositories
 */


class ShopRepository extends BaseRepository implements ShopRepositoryInterface
{

    protected $model;

    public function __construct(Product $model)
    {
        $this->model = $model;
    }
}
