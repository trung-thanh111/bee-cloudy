<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBrandRequest extends FormRequest
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
            'slug' => 'required|string|max:255|unique:brands,slug',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Bạn chưa nhập tên thương hiệu.',
            'name.max' => 'Tên thương hiệu không được vượt quá 255 ký tự.',
            'slug.required' => 'Đường dẫn slug là bắt buộc.',
            'slug.string' => 'Đường dẫn slug phải là chuỗi ký tự.',
            'slug.max' => 'Đường dẫn slug không được vượt quá 255 ký tự.',
            'slug.unique' => 'Đường dẫn đã tồn tại. Vui lòng chon đường dẫn khác'
        ];
    }
}
