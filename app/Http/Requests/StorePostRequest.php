<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            'description' => 'max:255',
            'content' => 'required',
            'slug' => 'required|unique:posts,slug', // Slug phải là duy nhất trong bảng posts
            'post_catalogue_id' => 'required', // bắt buộc chọn và giá trị > 0 
        ];
    }
    // custom thông báo lỗi 
    public function messages(): array
    {
        return [
            'name.required' => 'Bạn chưa nhập tiêu đề bài viết.',
            'name.max' => 'Tiêu đề bài viết không được quá 80 ký tự.',
            'description.max' => 'Mô tả quá dài. Tối đa 255 ký tự.',
            'content.required' => 'Bạn chưa nhập nội dung bài viết.',
            'slug.required' => 'Bạn chưa nhập slug.',
            'slug.unique' => 'Slug này đã tồn tại. Vui lòng nhập slug khác.',
            'post_catalogue_id.required' => 'Bạn chưa chọn danh mục cho bài viết',
            // 'post_catalogue_id.gt' => 'Vui lòng chọn một danh mục hợp lệ cho bài viết.',
        ];
    }
}
