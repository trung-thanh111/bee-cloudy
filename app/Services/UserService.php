<?php

namespace App\Services;

use App\Models\User;
use App\Services\Interfaces\UserServiceInterface;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * @package 
 *
 */

class UserService implements UserServiceInterface
{
    protected $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function all()
    {
        return $this->userRepository->all();
    }
    public function paginate($request)
    {
        $condition = [
            'keyword' => addslashes($request->input('keyword')),
            'publish' => $request->input('publish') !== null ? $request->integer('publish') : null,
            'where' => [
                ['user_catalogue_id', '=',  $request->integer('user_catalogue_id')]
            ]
        ];
        $relation = ['userCatalogue'];
        $perPage = $request->integer('perpage') ?: 10;
        $users = $this->userRepository->pagination(
            $this->paginateSelect(),
            $condition,
            $relation,
            ['id', 'DESC'],
            $perPage,
        );

        return $users;
    }

    public function create($request)
    {
        DB::beginTransaction();
        try {
            $payload = $request->except(['_token', 'submit', 'password_confirmation']);
            // hash password
            // dd($payload);
            $payload['password'] = Hash::make($payload['password']);
            $user = $this->userRepository->create($payload);
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
            $user = $this->userRepository->findById($id);
            $payload = $request->except(['_token', 'submit', 'province_name', 'district_name', 'ward_name']);
            $payload['birthday'] = date('Y/m/d', strtotime($payload['birthday']));
            $this->userRepository->updateById($user->id, $payload);
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
            $user = $this->userRepository->findById($id);
            if($user->user_catalogue_id == 2){
                flash()->error('bạn không đủ quyền thực hiện chức năng.');
                return redirect()->back();
            }
            $user = $this->userRepository->forceDelete($id);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            die();
            return false;
        }
    }

    // DASHBOARD
    public function countUserNew(){
        $count = $this->userRepository->allWhere([
            [DB::raw('YEAR(created_at)'), '=', Carbon::now()->year],
            ['publish', '1'],
        ])->count();
        return $count;
    }
    public function countUserAll(){

        $count = $this->userRepository->allWhere([
            [DB::raw('YEAR(created_at)'), '=', Carbon::now()->year],
            ['publish', '1'],
        ])->count();
        return $count;
    }
    public function countUserNewMonth(){
        $count = $this->userRepository->allWhere([
            [DB::raw('MONTH(created_at)'), '=', Carbon::now()->month],
            ['publish', '1'],
        ])->count();
        return $count;
    }

    // các trường lấy trong phân trang
    private function paginateSelect()
    {
        return [
            'id',
            'name',
            'email',
            'phone',
            'address',
            'image',
            'birthday',
            'description',
            'province_id',
            'district_id',
            'ward_id',
            'password',
            'user_catalogue_id',
            'publish',
            'created_at',
        ];
    }
}
