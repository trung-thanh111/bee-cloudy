<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreResetPassRequest extends FormRequest
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
            'password' => 'required|string|min:8',
            'password_confirmation' => 'required|string|same:password', // re_password phải giống password trên 
        ];
    }
    // custom thông báo lỗi 
    public function messages(): array
    {
        return [
            'password.required' => 'Bạn chưa nhập mật khẩu!',
            'password.min' => 'Bạn nhập không đủ ký tự cho mật khẩu.',
            'password.string' => 'Mật khẩu phải là chuỗi.',
            'password_confirmation.string' => 'Mật khẩu xác nhận phải là chuỗi.',
            'password_confirmation.required' => 'Vui lòng Xác minh mật khẩu.',
            'password_confirmation.same' => 'Mật khẩu không khớp.',
        ];
    }
}
