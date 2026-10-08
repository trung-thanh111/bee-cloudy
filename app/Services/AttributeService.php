<?php

namespace App\Services;

use App\Repositories\AttributeRepository;
use App\Repositories\UserRepository;
use App\Services\Interfaces\AttributeServiceInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * interface  UserService
 * @package App\Services
 */

class AttributeService implements AttributeServiceInterface
{
    protected $attributeRepository;
    public function __construct(AttributeRepository $attributeRepository)
    {
        $this->attributeRepository = $attributeRepository;
    }

    public function all()
    {
        return $this->attributeRepository->all();
    }

    public function paginate($request)
    {
        $condition = [
            'keyword' => addslashes($request->input('keyword')),
            'publish' => $request->input('publish') !== null ? $request->integer('publish') : null,
            'where' => [
                ['attribute_catalogue_id', '=',  $request->integer('attribute_catalogue_id')]
            ]
        ];
        $relation = ['attributeCatalogues'];
        $perPage = $request->integer('perpage') ?: 5;
        $attributes = $this->attributeRepository->pagination(
            $this->paginateSelect(),
            $condition,
            $relation,
            ['id', 'DESC'],
            $perPage,
        );

        // dd($attributes);
        return $attributes;
    }
    
    public function create($request)
    {
        // mở lệnh tương tác vs db
        DB::beginTransaction();
        // dùng try-catch để bắt lỗi 
        try {
            $payload = $request->except(['_token', '_submit']);
            $payload['user_id'] = Auth::id();
            // thực hiện thêm mới -> gọi tới repository nhận vào một payload
            $attribute = $this->attributeRepository->create($payload);
            DB::commit(); // nếu k có lỗi -> commit lên đb
            return true;
        } catch (\Exception $e) {
            DB::rollBack(); // có lỗi -> rollback lại k commit 
            echo $e->getMessage(); // hiển thị lỗi 
            return false;
        }
    }
    public function update($slug, $request)
    {
        DB::beginTransaction();
        try {
            $attribute = $this->attributeRepository->findBySlug($slug);
            if (!$attribute) {
                throw new \Exception("Không tìm thấy bản ghi!");
            }
            $payload = $request->except(['_token', 'submit']);
            // dd($payload);
            $data = $this->attributeRepository->update($slug, $payload);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            die();
            return false;
        }
    }
    public function destroy($id = 0)
    {
        DB::beginTransaction();
        try {
            // xóa cứng -> forceDelete()
            $this->attributeRepository->forceDelete($id);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            return false;
        }
    }
    public function destroyBulk($arrayId = [])
    {
        DB::beginTransaction();
        try {
            // Kiểm tra quyền trước khi xóa (phải là admin)
            if (Auth::user()->user__id != 2) {
                flash()->warning('Bạn không đủ quyền thực hiện thao tác!');
                return redirect()->back();
            }

            $arrayIdNotSatisfied = []; // k thỏa mãn
            $arrayIdSatisfied = []; // thỏa mãn

            // Duyệt qua từng ID trong mảng
            if (count($arrayId)) {

                foreach ($arrayId as $id) {
                    $attribute = $this->attributeRepository->findById($id);

                    // Kiểm tra nếu có liên kết trong bảng `attributes`
                    if ($attribute->attributes()->exists()) {
                        // Thêm vào danh sách bản ghi không thỏa mãn điều kiện xóa
                        $arrayIdNotSatisfied[] = $id;
                    } else {
                        // Thêm vào danh sách thỏa mãn để xóa
                        $arrayIdSatisfied[] = $id;
                    }
                }
            }
            // Kiểm tra nếu có bản ghi không thỏa mãn
            if (!empty($arrayIdNotSatisfied)) {
                flash()->warning('Không thể xóa các bản ghi sau vì có liên kết: ' . implode(', ', $arrayIdNotSatisfied));
                return redirect()->back();
            }
            // Nếu tất cả các bản ghi đều thỏa mãn, thực hiện xóa
            if (!empty($arrayIdSatisfied)) {
                $this->attributeRepository->bulkDelete($arrayIdSatisfied);
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            return false;
        }
    }
    private function paginateSelect()
    {
        return [
            'id',
            'name',
            'image',
            'slug',
            'attribute_catalogue_id',
            'publish',
        ];
    }
}
