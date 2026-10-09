<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\UserCatalogueService;
use App\Repositories\UserCatalogueRepository;
use App\Http\Requests\StoreUserCatalogueRequest;
use App\Http\Requests\UpdateUserCatalogueRequest;


class UserCatalogueController extends Controller
{
    protected $userCatalogueService;
    protected $userCatalogueRepository;
    public function __construct(
        UserCatalogueService $userCatalogueService,
        UserCatalogueRepository $userCatalogueRepository
    ) {
        $this->userCatalogueService = $userCatalogueService;
        $this->userCatalogueRepository = $userCatalogueRepository;
    }
    public function index(Request $request){
        $userCatalogues = $this->userCatalogueService->paginate($request);
        $template = 'backend.user.catalogue.index';
        return view('backend.dashboard.layout', compact('template', 'userCatalogues'));
    }

    public function create(){
        $template = 'backend.user.catalogue.create';
        return view('backend.dashboard.layout', compact('template'));
    }

    public function store(StoreUserCatalogueRequest $request){
        $result = $this->userCatalogueService->create($request);
        if ($result) {
            flash()->success('Thêm mới thành công');
            return redirect()->route('user.catalogue.index');
        } else {
            flash()->error('Thêm mới không thành công!. Hãy thao tác lại.');
            // return back();
        }
    }

    public function update($slug){
        $userCatalogue = $this->userCatalogueRepository->findBySlug($slug);
        $template = 'backend.user.catalogue.update';
        return view('backend.dashboard.layout', compact('template', 'userCatalogue'));
    }

    public function edit($slug, UpdateUserCatalogueRequest $request){
        $result = $this->userCatalogueService->update($slug, $request);
        if ($result) {
            flash()->success('Cập nhật thành công');
            return redirect()->route('user.catalogue.index');
        } else {
            flash()->error('Cập nhật không thành công!. Hãy thao tác lại.');
            return back();
        }
    }

    public function delete($id = 0){
        $userCatalogue = $this->userCatalogueRepository->findById($id);
        $template = 'backend.user.catalogue.delete';
        return view('backend.dashboard.layout', compact('template', 'userCatalogue'));
    }

    public function destroy($id = 0){
        if ($_POST['submit'] == 'cancel') {
            flash()->warning('Nhóm thành viên chưa được xóa!');
            return redirect()->route('user.catalogue.index');
        } else {
            $result = $this->userCatalogueService->destroy($id);
            if ($result) {
                flash()->success('Nhóm thành viên đã được xóa thành công!');
                return redirect()->route('user.catalogue.index');
            } else {
                flash()->error('Có lỗi khi xóa vui lòng thử lại!');
                return back();
            }
        }
    }
}
