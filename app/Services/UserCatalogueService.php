<?php

namespace App\Services;

use App\Models\UserCatalogue;
use App\Services\Interfaces\UserCatalogueServiceInterface;
use App\Repositories\UserCatalogueRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * @package 
 *
 */

class UserCatalogueService implements UserCatalogueServiceInterface
{
    protected $userCatalogueRepository;
    public function __construct(
        UserCatalogueRepository $userCatalogueRepository
    ) {
        $this->userCatalogueRepository = $userCatalogueRepository;
    }
    public function paginate($request)
    {
        $condition = [
            'keyword' => addslashes($request->input('keyword')),
            'publish' => $request->input('publish') !== null ? $request->integer('publish') : null,
        ];
        $relation = [];
        $perPage = $request->integer('perpage') ?: 5;
        $userCatalogues = $this->userCatalogueRepository->pagination(
            $this->paginateSelect(),
            $condition,
            $relation,
            ['id', 'DESC'],
            $perPage,
        );

        return $userCatalogues;
    }


    public function create($request)
    {
        DB::beginTransaction();
        try {
            $payload = $request->except(['_token', 'submit']);
            $userCatalogue = $this->userCatalogueRepository->create($payload);
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
            $this->userCatalogueRepository->update($slug, $payload);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            // nếu muốn xóa mềm thì thay hàm forceDelete = delete
            $userCatalogue = $this->userCatalogueRepository->forceDelete($id);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            die();
            return false;
        }
    }

    public function userCatalogueAll()
    {
        $userCatalogue = $this->userCatalogueRepository->userCatalogueAll();
        return $userCatalogue;
    }
    // các trường lấy trong phân trang
    private function paginateSelect()
    {
        return [
            'id',
            'name',
            'image',
            'description',
            'slug',
            'acronym',
            'publish',
        ];
    }
}
