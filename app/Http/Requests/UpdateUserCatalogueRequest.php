<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserCatalogueRequest extends FormRequest
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
            'name' => 'max:255',
            'slug' => 'string|max:255|regex:/^[a-zA-Z0-9_\-]+$/',
            'acronym' => 'string|max:255|regex:/^[a-zA-Z]+$/',
        ];
    }
    public function messages()
    {
        return [
            'name.max' => 'Tên nhóm quá dài so với cho phép',
            'slug.string' => 'Slug phải là một chuỗi!',
            'slug.max' => 'Slug quá mức cho phép',
            'slug.regex' => 'Slug dài quá mức cho phép',
            'acronym.regex' => 'Bạn nên nhập các ký tự A - Z',
            'acronym.string' => 'Tên gọi tắt phải là một chuỗi!',
            'acronym.max' => 'Tên gọi dài quá mức cho phép',
        ];
    }
}
