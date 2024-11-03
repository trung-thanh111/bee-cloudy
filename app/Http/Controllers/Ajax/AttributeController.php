<?php
namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\AttributeRepository;

class AttributeController extends Controller
{
    protected $attributeRepository;

    public function __construct(
        AttributeRepository $attributeRepository,
    ) {
        $this->attributeRepository = $attributeRepository;
    }

    public function getAttribute(Request $request)
    {
        // bắt payload
        $payload = $request->input();
        // lấy ra các thông tin attribute bằng phương thức searchAttributes
        $attributes = $this->attributeRepository->searchAttributes($payload['search'], $payload['option']);
        // Nếu không có attribute_language, lấy tên trực tiếp từ thuộc tính
        $attributeMapped = $attributes->map(function ($attribute) {
            return [
                'id' => $attribute->id,
                'text' => $attribute->name, // Lấy trực tiếp tên từ thuộc tính
            ];
        })->all();

        return response()->json(array('items' => $attributeMapped));
    }
    public function loadAttribute(Request $request)
    {
        /*
        thực hiện một loạt các thao tác để giải mã và chuyển đổi dữ liệu 
        được nhận từ yêu cầu HTTP (request) thành một mảng PHP
        */
        $payload['attribute'] = json_decode(base64_decode($request->input('attribute')), true);
        $payload['attributeCatalogueId'] = $request->input('attributeCatalogueId');
        $attributeArray = $payload['attribute'][$payload['attributeCatalogueId']];

        if (count($attributeArray)) {
            $attributes = $this->attributeRepository->findAttributeByIdArray($attributeArray);
        }
        $temp = [];
        if (count($attributes)) {
            foreach ($attributes as $key => $val) {
                $temp[] = [
                    'id' => $val->id,
                    'text' => $val->name
                ];
            }
        }
        return response()->json(array('items' => $temp));
    }
}
