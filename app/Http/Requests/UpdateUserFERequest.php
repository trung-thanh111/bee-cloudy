<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserFERequest extends FormRequest
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'phone' => 'regex:/^(0[35789])[0-9]{8}$/',
            'birthday' => 'date|before:today',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Bạn chưa nhập tên',
            'name.max' => 'Tên nhóm quá dài so với cho phép 255 ký tự',
            'image.mimes' => 'chỉ chấp nhận định dạng sau: jpeg,png,jpg,gif',
            'phone.regex' => 'Số điện thoại không đúng.',
            'birthday.date' => 'Không hợp lệ',
        ];
    }
}
