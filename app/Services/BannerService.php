<?php

namespace App\Services;

use App\Models\Banner;
use App\Repositories\BannerRepository;
use App\Services\Interfaces\BannerServiceInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * interface  UserService
 * @package App\Services
 */

class BannerService implements BannerServiceInterface
{
    protected $bannerRepository;
    public function __construct(
        BannerRepository $bannerRepository

    ) {
        $this->bannerRepository = $bannerRepository;
    }

    public function all()
    {
        return $this->bannerRepository->all();
    }

    public function paginateFontend($request)
    {
        $condition = [
            ['publish', 1]
        ];
        $relation = [];
        $perPage = 5;
        $banners = $this->bannerRepository->pagination(
            $this->paginateSelect(),
            $condition,
            $relation,
            ['created_at', 'asc'],
            $perPage,
        );

        return $banners;
    }

    public function paginate($request)
    {
        $condition = [
            'keyword' => addslashes($request->input('keyword')),
            'publish' => $request->input('publish') !== null ? $request->integer('publish') : null,
        ];
        $relation = [];
        $perPage = $request->integer('perpage') ?: 10;
        $banners = $this->bannerRepository->pagination(
            $this->paginateSelect(),
            $condition,
            $relation,
            ['id', 'DESC'],
            $perPage,
        );

        // dd($banners);
        return $banners;
    }

    public function create($request)
    {
        DB::beginTransaction();
        try {
            $payload = $request->except(['_token', 'submit']);
            $payload['album'] = json_encode($payload['variantAlbum']);
            unset($payload['variantAlbum']);
            $banner = $this->bannerRepository->create($payload);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            return false;
        }
    }

    public function update($id, $request)
    {
        DB::beginTransaction();
        try {
            $banner = $this->bannerRepository->findById($id);
            if (!$banner) {
                flash()->error('Không tìm thấy bản ghi.');
            }
            $payload = $request->except(['_token', 'submit']);
            if(isset($payload['variantAlbum']) && $banner->album != $payload['variantAlbum']){
                $payload['album'] = json_encode($payload['variantAlbum']);
                unset($payload['variantAlbum']);
            }
            $this->bannerRepository->update($banner->id, $payload);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }
    public function destroy($id = 0)
    {
        DB::beginTransaction();
        try {
            // xóa cứng -> forceDelete()
            $this->bannerRepository->forceDelete($id);
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
                    $banner = $this->bannerRepository->findById($id);

                    // Kiểm tra nếu có liên kết trong bảng `Banners`
                    if ($banner->banners()->exists()) {
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
                $this->bannerRepository->bulkDelete($arrayIdSatisfied);
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
            'album',
            'location',
            'date_start',
            'date_end',
            'publish',
            'created_at',
        ];
    }
}
