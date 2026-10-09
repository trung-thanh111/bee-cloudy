<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Repositories\UserRepository;
use App\Http\Controllers\Controller;
use App\Services\UserCatalogueService;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Order;
use App\Repositories\OrderRepository;
use App\Repositories\UserCatalogueRepository;

class UserController extends Controller
{
    protected $userService;
    protected $userRepository;
    protected $orderRepository;
    protected $provinceRepository;
    protected $userCatalogueService;
    protected $userCatalogueRepository;
    public function __construct(
        UserService $userService,
        UserRepository $userRepository,
        OrderRepository $orderRepository,
        UserCatalogueService $userCatalogueService,
        UserCatalogueRepository $userCatalogueRepository,
    ) {
        $this->userService = $userService;
        $this->userRepository = $userRepository;
        $this->orderRepository = $orderRepository;
        $this->userCatalogueService = $userCatalogueService;
        $this->userCatalogueRepository = $userCatalogueRepository;
    }
    public function index(Request $request){
        $users = $this->userService->paginate($request);
        $userCatalogue = $this->userCatalogueService->userCatalogueAll();
        $template = 'backend.user.user.index';
        return view('backend.dashboard.layout', compact('template', 'users', 'userCatalogue'));
    }

    public function create(){
        $userCatalogue = $this->userCatalogueService->userCatalogueAll();
        $template = 'backend.user.user.create';
        return view('backend.dashboard.layout', compact('template', 'userCatalogue'));
    }

    public function store(StoreUserRequest $request){
        $result = $this->userService->create($request);
        if ($result) {
            flash()->success('Thêm mới thành công');
            return redirect()->route('user.index');
        } else {
            flash()->error('Thêm mới không thành công!. Hãy thao tác lại.');
            return back();
        }
    }

    public function update($id = 0){
        $user = $this->userRepository->findById($id);
        // định dạng lại ngày tháng năm thành YYYY-MM-DD để đổ ra input type = date
        if (!empty($user->birthday)) {
            $user->birthday = date('Y-m-d', strtotime($user->birthday));
        }
        $userCatalogue = $this->userCatalogueService->userCatalogueAll();
        $template = 'backend.user.user.update';
        return view('backend.dashboard.layout', compact('template', 'user', 'userCatalogue'));
    }

    public function edit($id, UpdateUserRequest $request){
        $result = $this->userService->update($id, $request);
        if ($result) {
            flash()->success('Cập nhật thành công');
            return redirect()->route('user.index');
        } else {
            flash()->error('Cập nhật không thành công!. Hãy thao tác lại.');
            return back();
        }
    }

    public function detail($id = 0){
        $user = $this->userRepository->findById($id);
        //--//
        $orderUserTodays = Order::where('customer_id', $id)
        ->whereDate('created_at', '=', \Carbon\Carbon::now()->toDateString())
        ->get();
        $orderUserAllTimes = Order::where('customer_id', $id)
        ->paginate(10);

        $template = 'backend.user.user.detail';
        return view('backend.dashboard.layout', compact(
            'template', 
            'user',
            'orderUserTodays',
            'orderUserAllTimes',
        ));
    }

    // public function delete($id = 0){
    //     $user = $this->userRepository->findById($id);
    //     $template = 'backend.user.user.delete';
    //     return view('backend.dashboard.layout', compact('template', 'user'));
    // }

    // public function destroy($id = 0){
    //     if ($_POST['submit'] == 'cancel') {
    //         flash()->warning('Thành viên chưa được xóa!');
    //         return redirect()->route('user.index');
    //     } else {
    //         $result = $this->userService->destroy($id);
    //         if ($result) {
    //             flash()->success('Thành viên đã được xóa thành công!');
    //             return redirect()->route('user.index');
    //         } else {
    //             flash()->error('Có lỗi khi xóa vui lòng thử lại!');
    //             return back();
    //         }
    //     }
    // }
}
