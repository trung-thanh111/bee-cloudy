<?php

namespace App\Services;

use App\Repositories\AttributeCatalogueRepository;
use App\Repositories\UserRepository;
use App\Services\Interfaces\AttributeCatalogueServiceInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * interface  UserService
 * @package App\Services
 */

class AttributeCatalogueService implements AttributeCatalogueServiceInterface
{
    protected $attributeCatalogueRepository;
    public function __construct(AttributeCatalogueRepository $attributeCatalogueRepository)
    {
        $this->attributeCatalogueRepository = $attributeCatalogueRepository;
    }

    public function all()
    {
        return $this->attributeCatalogueRepository->all();
    }

    public function paginate($request)
    {
        $condition = [
            'keyword' => addslashes($request->input('keyword')),
            'publish' => $request->input('publish') !== null ? $request->integer('publish') : null,
        ];
        $perPage = $request->integer('perpage') ?: 5; // mặc định mỗi trang 5 sp 

        $attributeCatalogues = $this->attributeCatalogueRepository->pagination(
            $this->selectColumn(),
            $condition,
            [],
            ['id', 'DESC'],
            $perPage,
        );
        return $attributeCatalogues;
    }
    public function create($request)
    {
        // mở lệnh tương tác vs db
        DB::beginTransaction();
        // dùng try-catch để bắt lỗi 
        try {
            $payload = $request->except(['_submit']);
            // thực hiện thêm mới -> gọi tới repository nhận vào một payload
            $attributeCatalogue = $this->attributeCatalogueRepository->create($payload);
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
            $attributeCatalogue = $this->attributeCatalogueRepository->findBySlug($slug);
            if (!$attributeCatalogue) {
                throw new \Exception("Không tìm thấy bản ghi!");
            }
            $payload = $request->except(['_token', 'submit']);
            // dd($payload);
            $data = $this->attributeCatalogueRepository->update($slug, $payload);
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
            // xóa cứng
            $this->attributeCatalogueRepository->forceDelete($id);
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
            if (Auth::user()->user_catalogue_id != 2) {
                flash()->warning('Bạn không đủ quyền thực hiện thao tác!');
                return redirect()->back();
            }
    
            $arrayIdNotSatisfied = []; // k thỏa mãn
            $arrayIdSatisfied = []; // thỏa mãn
    
            // Duyệt qua từng ID trong mảng
            if(count($arrayId)){

                foreach ($arrayId as $id) {
                    $attributeCatalogue = $this->attributeCatalogueRepository->findById($id);
        
                    // Kiểm tra nếu có liên kết trong bảng `attributes`
                    if ($attributeCatalogue->attributes()->exists()) {
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
                $this->attributeCatalogueRepository->bulkDelete($arrayIdSatisfied);
            }
            DB::commit();
            return true;
    
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            return false;
        }
    }
    private function selectColumn()
    {
        return [
            'id',
            'name',
            'image',
            'description',
            'slug',
            'publish',
        ];
    }
}
