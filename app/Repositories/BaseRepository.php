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
        // Duyệt qua các điều kiện, bao gồm cả toán tử so sánh
        foreach ($condition as $val) {
            if (count($val) === 3) {
                // Nếu điều kiện có 3 phần tử -> sử dụng toán tử (ví dụ: 'slug', '!=', 'value')
                $query = $query->where($val[0], $val[1], $val[2]);
            } else if (count($val) === 2) {
                // Nếu điều kiện chỉ có 2 phần tử -> sử dụng toán tử '=' mặc định
                $query = $query->where($val[0], '=', $val[1]);
            }
        }
        return $query->get();
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
            // ->toSql();
    }

    public function create(array $payload)
    {
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
    public function bulkDelete(array $arrayId = []){
        // xóa theo các id có trong mảng arrayid 
        return $this->model->whereIn('id', $arrayId)->forceDelete();
    }

    public function findByCondition($condition = []){
        $query = $this->model;
        foreach($condition as $key => $val){
            if(count($condition) == 3){
                $query->where($val[0], $val[1] , $val[2]);
            }else{
                $query->where($val[0], '=' , $val[1]);
            }
        }
        return $query->first();
    }

    // hàm sử dụng để insert 1 lần nhiều bản ghi 
    public function createBatch($payload = []){
        // dùng insert để insert mảng nhiều bảng ghi 
        return $this->model->insert($payload);
    }
}
