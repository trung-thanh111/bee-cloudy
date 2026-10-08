<?php

namespace App\Traits;

use Illuminate\Support\Facades\Schema;

trait QueryScopes
{
    // Hàm phạm vi tìm kiếm
    public function scopeKeyword($query, $keyword, $fieldSearch = [])
    {
        if (!empty($keyword)) {
            if (count($fieldSearch) > 0) {
                foreach ($fieldSearch as $key => $val) {
                    $query->orWhere($val, 'like', '%' . $keyword . '%');
                }
            } else {
                $query->where(function ($q) use ($keyword) {
                    $q->where('id', 'like', '%' . $keyword . '%')
                        ->orWhere('name', 'like', '%' . $keyword . '%');
                        // nếu bảng nào k có slug thì kiểm tra như này 
                        if (Schema::hasColumn('users', 'slug')) {
                            $q->orWhere('slug', 'like', '%' . $keyword . '%');
                        }else{
                            $q->orWhere('id', 'like', '%' . $keyword . '%');

                        }
                });
            }
        }
        return $query;
    }



    // Hàm phạm vi câu điều kiện
    public function scopeCustomWhere($query, $where = [])
    {
        if (!empty($where)) {
            foreach ($where as $val) {
                if (isset($val[0], $val[1], $val[2]) && $val[2] != 0) {
                    $query->where($val[0], $val[1], $val[2]);
                }
            }
        }
        return $query;
    }

    // Hàm phạm vi trạng thái
    public function scopePublish($query, $publish)
    {
        if ($publish !== null) { // Nếu publish có giá trị (1 hoặc 0)
            $query->where('publish', $publish);
        }
        return $query;
    }


    // Phạm vi về mỗi quan hệ
    public function scopeRelationCount($query, $relations)
    {
        if (!empty($relations)) {
            foreach ($relations as $relation) {
                $query->withCount($relation);
            }
        }
        return $query;
    }

    // Phạm vi quan hệ
    public function scopeRelation($query, $relations)
    {
        if (!empty($relations)) {
            foreach ($relations as $relation) {
                $query->with($relation);
            }
        }
        return $query;
    }

    // Phạm vi về orderby
    public function scopeCustomOrderBy($query, $orderBy)
    {
        if (!empty($orderBy) && isset($orderBy[0], $orderBy[1])) {
            $query->orderBy($orderBy[0], $orderBy[1]);
        }
        return $query;
    }

    public function scopeCustomCreated($query, $condition)
    {
        if (!empty($condition)) {
            $explode = explode(' - ', $condition);
            $explode = array_map('trim', $explode); //loiaj bỏ khoảng trống
            $startDate = date('Y-m-d 00:00:00', strtotime($explode[0]));
            $endDate = date('Y-m-d 23:59:59', strtotime($explode[1]));

            $query->whereBetween('created_at', [$startDate, $endDate]);
        }
        return $query;
    }
}
