<?php

namespace App\Services;

use App\Models\PostCatalogue;
use App\Repositories\PostCatalogueRepository;
use App\Repositories\UserRepository;
use App\Services\Interfaces\PostCatalogueServiceInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * interface  UserService
 * @package App\Services
 */

class PostCatalogueService implements PostCatalogueServiceInterface
{
    protected $postCatalogueRepository;
    public function __construct(PostCatalogueRepository $postCatalogueRepository)
    {
        $this->postCatalogueRepository = $postCatalogueRepository;
    }

    public function all()
    {
        return $this->postCatalogueRepository->all(['parentReference']); // lay ra co qh tham chieu den parent_id
    }

    public function paginate($request)
    {
        $condition = [
            'keyword' => addslashes($request->input('keyword')),
            'publish' => $request->input('publish') !== null ? $request->integer('publish') : null,
        ];
        $perPage = $request->integer('perpage') ?? 5;
        $postCatalogues = $this->postCatalogueRepository->pagination(
            $this->selectColumn(),
            $condition,
            ['parentReference'],
            ['id', 'ASC'],
            $perPage,
        );
        return $postCatalogues;
    }
    public function create($request)
    {
        // mở lệnh tương tác vs db
        DB::beginTransaction();
        // dùng try-catch để bắt lỗi 
        try {
            $payload = $request->except(['_token', '_submit']);
            $payload['user_id'] = Auth::id();
            $payload['order'] = PostCatalogue::max('order') + 1;
            // thực hiện thêm mới -> gọi tới repository nhận vào một payload
            $this->postCatalogueRepository->create($payload);
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
            $postCatalogue = $this->postCatalogueRepository->findBySlug($slug);
            if (!$postCatalogue) {
                throw new \Exception("Không tìm thấy bản ghi!");
            }
            // Lấy giá trị order từ request
            $orderSelected = $request->input('order');
            // Tìm bản ghi có cùng vị trí order được chọn
            $orderSameSelected = $this->postCatalogueRepository->findByCondition([
                ['order', '=',  $orderSelected]
            ])->first();
            // Hoán đổi vị trí order
            if ($orderSameSelected) {
                $originalOrder = $postCatalogue->order;
                $postCatalogue->order = $orderSelected;
                $postCatalogue->save();

                $orderSameSelected->order = $originalOrder;
                $orderSameSelected->save();
            }
            $payload = $request->except(['_token', 'submit']);
            $this->postCatalogueRepository->update($slug, $payload);
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
            $this->postCatalogueRepository->forceDelete($id);
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
                    $postCatalogue = $this->postCatalogueRepository->findById($id);

                    // Kiểm tra nếu có liên kết trong bảng `Posts`
                    if ($postCatalogue->posts()->exists()) {
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
                $this->postCatalogueRepository->bulkDelete($arrayIdSatisfied);
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
            'parent_id',
            'image',
            'order',
            'description',
            'slug',
            'publish',
            'created_at',
        ];
    }
}
