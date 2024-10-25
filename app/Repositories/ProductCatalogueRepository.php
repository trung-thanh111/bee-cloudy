<?php

namespace App\Repositories;

use App\Models\ProductCatalogue;
use App\Repositories\Interfaces\ProductCatalogueRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

/** class BaseRepository
 * @package App\Repositories
 */


class ProductCatalogueRepository extends BaseRepository implements ProductCatalogueRepositoryInterface
{

    protected $model;

    public function __construct(ProductCatalogue $model)
    {
        $this->model = $model;
    }
    public function getWithCondition(array $relations = [], array $conditions = [])
    {
        $query = $this->model->with($relations);

        foreach ($conditions as $condition) {
            if (count($condition) == 3) {
                if ($condition[2] === null) {
                    $query->whereNull($condition[0]);
                } else {
                    $query->where($condition[0], $condition[1], $condition[2]);
                }
            } else {
                $query->where($condition[0], '=', $condition[1]);
            }
        }
        return $query->get();
    }
}
