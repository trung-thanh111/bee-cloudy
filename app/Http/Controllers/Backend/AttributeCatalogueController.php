<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\AttributeCatalogueService;
use App\Repositories\AttributeCatalogueRepository;
use App\Http\Requests\StoreAttributeCatalogueRequest;
use App\Http\Requests\UpdateAttributeCatalogueRequest;

class AttributeCatalogueController extends Controller
{
    protected $attributeCatalogueService;
    protected $attributeCatalogueRepository;
    public function __construct(
        AttributeCatalogueService $attributeCatalogueService,
        AttributeCatalogueRepository $attributeCatalogueRepository,
    ) {
        $this->attributeCatalogueService = $attributeCatalogueService;
        $this->attributeCatalogueRepository = $attributeCatalogueRepository;
    }

    public function index(Request $request)
    {
        $attributeCatalogues = $this->attributeCatalogueService->paginate($request);
        $template = 'backend.attribute.catalogue.index';
        return view('backend.dashboard.layout', compact(
            'template',
            'attributeCatalogues',
        ));
    }
    public function create()
    {
        $attributeCatalogues = $this->attributeCatalogueService->all();
        $template = 'backend.attribute.catalogue.create';
        return view('backend.dashboard.layout', compact(
            'template',
            'attributeCatalogues',
        ));
    }
    public function store(StoreAttributeCatalogueRequest $request)
    {
        // gọi tới service với phương thức create 
        $result = $this->attributeCatalogueService->create($request);
        if ($result) {
            flash()->success('Thêm mới thành công');
            return redirect()->route('attribute.catalogue.index');
        } else {
            flash()->error('Thất bại. Đã có lỗi xảy ra vui lòng thử lại!');
            return redirect()->back();
        }
    }
    public function update($slug)
    {
        $attributeCatalogue = $this->attributeCatalogueRepository->findBySlug($slug);
        // lấy ra tất cả vs điều kiện (không lấy ra bản ghi đàn được find)
        $attributeCatalogues = $this->attributeCatalogueRepository->allWhere([
            ['slug', '!=', $attributeCatalogue->slug]
        ]);
        $template = 'backend.attribute.catalogue.update';
        return view('backend.dashboard.layout', compact(
            'template',
            'attributeCatalogue',
            'attributeCatalogues',
        ));
    }
    public function edit($slug, UpdateAttributeCatalogueRequest $request)
    {
        $result = $this->attributeCatalogueService->update($slug, $request);
        if ($result) {
            flash()->success('cập nhật thành công');
            return redirect()->route('attribute.catalogue.index');
        } else {
            flash()->error('Thất bại. Đã có lỗi xảy ra vui lòng thử lại!');
            return redirect()->back();
        }
    }
    public function delete($id = 0)
    {
        $attributeCatalogue = $this->attributeCatalogueRepository->findById($id);
        $template = 'backend.attribute.catalogue.delete';
        return view('backend.dashboard.layout', compact(
            'template',
            'attributeCatalogue',
        ));
    }
    public function destroy($id = 0)
    {
        if ($_POST['submit'] == 'cancel') {
            flash()->warning('Nhóm thuộc tính chưa được xóa!');
            return redirect()->route('attribute.catalogue.index');
        } else {
            $attributeCatalogue = $this->attributeCatalogueRepository->findById($id);
            //kiểm tra xem bản ghi đó có các bản ghi liên quan trong bảng attributes kh
            if ($attributeCatalogue->attributes()->exists()) {
                flash()->warning('Nhóm thuộc tính có các record bên trong không thể xóa!');
                return redirect()->back();
            }
            $result = $this->attributeCatalogueService->destroy($id);
            if ($result) {
                flash()->success('Nhóm thuộc tính đã được xóa thành công!');
                return redirect()->route('attribute.catalogue.index');
            } else {
                flash()->error('Có lỗi khi xóa, vui lòng thử lại!');
                return redirect()->back();
            }
        }
    }

    public function destroyMultiple(Request $request)
    {
        // Lấy giá trị từ input ẩn đã truyền mảng ID
        $listId = $request->input('array_id');

        // Kiểm tra nếu có ID, và tách chuỗi thành mảng
        if ($listId) {
            $arrayId = explode(',', $listId);
            dd($arrayId);
            $this->attributeCatalogueService->destroyBulk($arrayId);
            flash()->success('Xóa thành công các bản ghi.');
        } else {
            flash()->warning('Không có bản ghi nào được chọn để xóa.');
        }

        return redirect()->route('attribute.catalogue.index');
    }
}
