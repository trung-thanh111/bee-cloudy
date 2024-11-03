<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Services\AttributeService;
use App\Http\Controllers\Controller;
use App\Repositories\AttributeRepository;
use App\Http\Requests\StoreAttributeRequest;
use App\Http\Requests\UpdateAttributeRequest;
use App\Repositories\AttributeCatalogueRepository;

class AttributeController extends Controller
{
    protected $attributeService;
    protected $attributeRepository;
    protected $attributeCatalogueRepository;
    public function __construct(
        AttributeService $attributeService,
        AttributeRepository $attributeRepository,
        AttributeCatalogueRepository $attributeCatalogueRepository,
    ) {
        $this->attributeService = $attributeService;
        $this->attributeRepository = $attributeRepository;
        $this->attributeCatalogueRepository = $attributeCatalogueRepository;
    }

    public function index(Request $request)
    {
        $attributes = $this->attributeService->paginate($request);
        $attributeCatalogues = $this->attributeCatalogueRepository->all();
         // dd($attributes);
        $template = 'backend.attribute.attribute.index';
        return view('backend.dashboard.layout', compact(
            'template',
            'attributes',
            'attributeCatalogues',
        ));
    }
    public function create()
    {
        $attributes = $this->attributeService->all();
        $attributeCatalogues = $this->attributeCatalogueRepository->all();
        $template = 'backend.attribute.attribute.create';
        return view('backend.dashboard.layout', compact(
            'template',
            'attributes',
            'attributeCatalogues',
        ));
    }
    public function store(StoreAttributeRequest $request)
    {
        // gọi tới service với phương thức create 
        $result = $this->attributeService->create($request);
        if ($result) {
            flash()->success('Thêm mới thành công');
            return redirect()->route('attribute.index');
        } else {
            flash()->error('Thất bại. Đã có lỗi xảy ra vui lòng thử lại!');
            return redirect()->back();
        }
    }
    public function update($slug)
    {
        $attribute = $this->attributeRepository->findBySlug($slug);
        // lấy ra tất cả vs điều kiện (không lấy ra bản ghi đàn được find)
        $attributeCatalogues = $this->attributeCatalogueRepository->all();
        $template = 'backend.attribute.attribute.update';
        return view('backend.dashboard.layout', compact(
            'template',
            'attribute',
            'attributeCatalogues',
        ));
    }
    public function edit($slug, UpdateAttributeRequest $request)
    {
        $result = $this->attributeService->update($slug, $request);
        if ($result) {
            flash()->success('cập nhật thành công');
            return redirect()->route('attribute.index');
        } else {
            flash()->error('Thất bại. Đã có lỗi xảy ra vui lòng thử lại!');
            return redirect()->back();
        }
    }
    public function delete($id = 0)
    {
        $attribute = $this->attributeRepository->findById($id);
        $template = 'backend.attribute.attribute.delete';
        return view('backend.dashboard.layout', compact(
            'template',
            'attribute',
        ));
    }
    public function destroy($id = 0)
    {
        if ($_POST['submit'] == 'cancel') {
            flash()->warning('Thuộc tính chưa được xóa!');
            return redirect()->route('attribute.index');
        } else {
            $result = $this->attributeService->destroy($id);
            if ($result) {
                flash()->success('Thuộc tính đã được xóa thành công!');
                return redirect()->route('attribute.index');
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
            $this->attributeService->destroyBulk($arrayId);
            flash()->success('Xóa thành công các bản ghi.');
        } else {
            flash()->warning('Không có bản ghi nào được chọn để xóa.');
        }

        return redirect()->route('attribute.index');
    }
}
