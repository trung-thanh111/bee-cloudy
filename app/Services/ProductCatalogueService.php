<?php

namespace App\Services;

use App\Models\ProductCatalogue;
use App\Repositories\ProductCatalogueRepository;
use App\Repositories\UserRepository;
use App\Services\Interfaces\ProductCatalogueServiceInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * interface  UserService
 * @package App\Services
 */

class ProductCatalogueService implements ProductCatalogueServiceInterface
{
    protected $productCatalogueRepository;
    public function __construct(ProductCatalogueRepository $productCatalogueRepository)
    {
        $this->productCatalogueRepository = $productCatalogueRepository;
    }

    public function all()
    {
        return $this->productCatalogueRepository->all(['parentReference']); // lay ra co qh tham chieu den parent_id
    }

    public function paginate($request)
    {
        $condition = [
            'keyword' => addslashes($request->input('keyword')),
            'publish' => $request->input('publish') !== null ? $request->integer('publish') : null,
        ];
        $perPage = $request->integer('perpage') ?: 5;
        $productCatalogues = $this->productCatalogueRepository->pagination(
            $this->selectColumn(),
            $condition,
            ['parentReference'],
            ['id', 'desc'],
            $perPage,
        );
        return $productCatalogues;
    }
    public function create($request)
    {
        // mở lệnh tương tác vs db
        DB::beginTransaction();
        // dùng try-catch để bắt lỗi 
        try {
            $payload = $request->except(['_token', '_submit']);
            $payload['slug'] = Str::slug($payload['slug'],'-').'-'.rand(10000, 99999);
            // thực hiện thêm mới -> gọi tới repository nhận vào một payload
            $this->productCatalogueRepository->create($payload);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            return false;
        }
    }
    public function update($slug, $request)
    {
        DB::beginTransaction();
        try {
            $payload = $request->except(['_token', 'submit']);
            $payload['slug'] = Str::slug($payload['slug'],'-');
            $productCatalogue = $this->productCatalogueRepository->findBySlug($slug);
            $this->productCatalogueRepository->update($slug, $payload);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception("Cập nhật thất bại: " . $e->getMessage());
        }
    }

    public function destroy($id = 0)
    {
        DB::beginTransaction();
        try {
            // xóa cứng
            $this->productCatalogueRepository->forceDelete($id);
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
            if (count($arrayId)) {

                foreach ($arrayId as $id) {
                    $productCatalogue = $this->productCatalogueRepository->findById($id);

                    // Kiểm tra nếu có liên kết trong bảng `Products`
                    if ($productCatalogue->products()->exists()) {
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
                $this->productCatalogueRepository->bulkDelete($arrayIdSatisfied);
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
            'parent_id',
            'slug',
            'name',
            'image',
            'description',
            'publish',
        ];
    }
}
