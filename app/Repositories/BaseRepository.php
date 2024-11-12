<?php

namespace App\Repositories;

use App\Repositories\Interfaces\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

/** class BaseRepository
 * @package App\Repositories
 */


class BaseRepository implements BaseRepositoryInterface
{

    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all(array $relation = [])
    {
        return $this->model->with($relation)->get();
    }

    public function allWhere(array $condition = [])
    {
        $query = $this->model;
        foreach ($condition as $val) {
            if (count($val) === 3) {
                $query = $query->where($val[0], $val[1], $val[2]);
            } else if (count($val) === 2) {
                $query = $query->where($val[0], '=', $val[1]);
            }
        }
        return $query->get();
    }

    public function getLimit(array $relations = [], array $conditions = [], $limit = 4)
    {
        $query = $this->model->with($relations);

        foreach ($conditions as $condition) {
            if (is_array($condition) && count($condition) === 3) {
                $query->where($condition[0], $condition[1], $condition[2]);
            } elseif (is_array($condition) && count($condition) === 2) {
                if (in_array(strtolower($condition[1]), ['asc', 'desc'])) {
                    $query->orderBy($condition[0], $condition[1]);
                } else {
                    $query->where($condition[0], $condition[1]);
                }
            }
        }

        return $query->limit($limit)->get();
    }

    public function pagination(
        array $column = ['*'],
        array $condition = [],
        array $relation = [],
        array $orderBy = ['id', 'ASC'],
        int $perPage = 5,
    ) {
        $query = $this->model->select($column);
        return $query
            ->keyword($condition['keyword'] ?? null)
            ->publish($condition['publish'] ?? null)
            ->customWhere($condition['where'] ?? null)
            ->relation($relation ?? null)
            ->customOrderBy($orderBy ?? null)
            ->paginate($perPage);
    }

    public function create(array $payload)
    {
        $model = $this->model->create($payload);
        return $model->fresh();
    }

    public function findById(int $id = 0, array $relation = [])
    {
        $model = $this->model;

        if (!empty($relation)) {
            $model = $model->with($relation);
        }
        return $model->findOrFail($id);
    }

    public function findBySlug(string $slug = '', array $relation = [])
    {
        $model = $this->model->where('slug', $slug);
        //neu co quan he can tai thi sudung with truyen vao quan he
        if (!empty($relation)) {
            $model = $model->with($relation);
        }
        return $model->first();
    }

    public function update(string $slug = '', array $payload = [])
    {
        // tim theo ban ghi k can quan he K truyen ralation
        $model = $this->findBySlug($slug);
        if ($model) {
            $model->update($payload);
            return $model->fresh();
        }
        return false;
    }

    // xoa mem
    public function delete(int $id = 0)
    {
        return $this->findById($id)->delete();
    }

    // xoa cung
    public function forceDelete(int $id = 0)
    {
        return $this->findById($id)->forceDelete();
    }

    // xóa nhiều phtu
    public function bulkDelete(array $arrayId = [])
    {
        // xóa theo các id có trong mảng arrayid 
        return $this->model->whereIn('id', $arrayId)->forceDelete();
    }

    public function findByCondition($condition = [], $excludeId = null)
    {
        $query = $this->model;
        foreach ($condition as $key => $val) {
            if (count($condition) == 3) {
                $query->where($val[0], $val[1], $val[2]);
            } else {
                $query->where($val[0], '=', $val[1]);
            }
        }
        if ($excludeId) {
            // Loại trừ bản ghi có id hiện tại
            $query->where('id', '<>', $excludeId);
        }
        return $query->get();
    }


    // hàm sử dụng để insert 1 lần nhiều bản ghi 
    public function createBatch($payload = [])
    {
        // dùng insert để insert mảng nhiều bảng ghi 
        return $this->model->insert($payload);
    }
}
