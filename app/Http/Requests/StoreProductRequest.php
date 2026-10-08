<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:255',
            'slug' => 'required|string|max:255|unique:products,slug',
            'product_catalogue_id' => 'required|gt:0', // gia tri lớn hơn 0
            'brand_id' => 'gt:0', // gia tri lớn hơn 0
            'sku'=> 'required|string|max:255|unique:products,slug',
            'price' => 'required|numeric|min:0'

        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Bạn chưa nhập tên sản phẩm.',
            'name.max' => 'Tên thuộc tính không được vượt quá 255 ký tự.',
            'slug.required' => 'Đường dẫn slug là bắt buộc.',
            'slug.string' => 'Đường dẫn slug phải là chuỗi ký tự.',
            'slug.max' => 'Đường dẫn slug không được vượt quá 255 ký tự.',
            'slug.unique' => 'Đường dẫn đã tồn tại. Vui lòng chon đường dẫn khác',
            'sku.required' => 'Sku chung cho sản phẩm là bắt buộc.',
            'sku.string' => 'Sku phải là chuỗi ký tự.',
            'sku.max' => 'Sku không được vượt quá 255 ký tự.',
            'sku.unique' => 'Sku đã tồn tại. Vui lòng chon Sku khác',
            'product_catalogue_id.required' => 'Vui lòng chọn nhóm sản phẩm.',
            'product_catalogue_id.gt' => 'Vui lòng chọn nhóm sản phẩm phải lớn hơn 0.',
            'brand_id.gt' => 'Vui lòng chọn thương hiệu.',
            'price.required' => 'Bạn chưa nhập giá sản phẩm.',
            'price.numeric' => 'Giá tiền phải là số.',
            'price.min' => 'Giá tiền phải lớn hơn 0.',
        ];
    }
}
