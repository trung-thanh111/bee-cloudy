<?php

namespace App\Repositories\Interfaces;

/**
 * UserRepository interface
 * @package App\Repositories\Interfaces
 */

/**
 * note: interface se dat ra cac quy tac ma class implement no phai bat buoc tuan  theo 
 * (co the no nhu la mot ban do chi dan)
 */

interface PromotionRepositoryInterface
{
    // phuong thuc lay tat ca
    public function all(array $realtion);
    // lấy ra có điều kiện 
    public function allWhere(array $condition);
    // lay va phan trang, ...
    public function pagination (
        array $column = ['*'], // nhan vao mot mang field mac dinh la lay tat ca
        array $condition = [], // nhan vao mot mang dieu kien 
        array $relation = [], // nhan vao mang moi quan he 
        array $orderBy = ['id', 'DESC'], // sort id tang dan 
        int $perPage = 10, // perPage là moi trang có bnhiu record -> mặc định 10 record
    );

    //  phthuc them moi -> nhan mot mang du lieu 
    public function create(array $payload);

    //tim doi tuong theo id
    public function findById(int $id = 0);

    //tim doi tuong theo slug
    public function findBySlug(string $slug = '');

    // phtuc chinh sua 
    public function update(string $slug = '', array $payload);
    
    // pthuc xoa mem
    public function delete(int $id = 0);

    // pthuc xoa cung
    public function forceDelete(int $id = 0);

    // xóa nhiều
    public function bulkDelete(array $id = []);
}
