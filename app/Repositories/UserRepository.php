<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

/** class BaseRepository
 * @package App\Repositories
 */


class UserRepository extends BaseRepository implements UserRepositoryInterface {
    
    protected $model;

    public function __construct(User $model) {
        $this->model = $model;
    }

    public function all(array $relation = []){
        return $this->model->with($relation)->get(); 
    }

    public function pagination (
        array $column = ['*'],
        array $condition = [],
        array $relation = [],
        array $orderBy = ['id', 'DESC'],
        int $perPage = 10,
    ){
        $query = $this->model->select($column);
        return $query
        ->keyword($condition['keyword'] ?? null)
        ->publish($condition['publish'] ?? null)
        ->customWhere($condition['where'] ?? null)
        ->relation($relation ?? null)
        ->customOrderBy($orderBy ?? null)
        ->paginate($perPage);
    }

    public function create(array $payload){
        $model = $this->model->create($payload);
        // fresh() se tai lai ban ghi vua dc tao vs du lieu moi nhat
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
    public function delete(int $id = 0){
        return $this->findById($id)->delete();
    }

    // xoa cung
    public function forceDelete(int $id = 0){
        return $this->findById($id)->forceDelete();
    }
}

