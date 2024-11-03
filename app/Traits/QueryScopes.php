<?php

namespace App\Traits;

trait QueryScopes
{
    // Hàm phạm vi tìm kiếm
    public function scopeKeyword($query, $keyword)
    {
        if (!empty($keyword)) {
            $query->where(function ($q) use ($keyword) {
                $q->where('id', 'like', '%' . $keyword . '%')
                  ->orWhere('name', 'like', '%' . $keyword . '%')
                  ->orWhere('slug', 'like', '%' . $keyword . '%');
            });
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
}
