<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required||min:3|max:255', 
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:8',
            'password_confirmation' => 'required|min:8|same:password',
            // 'accept_clause' => 'accepted',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Bạn chưa nhập họ tên!',
            'name.min' => 'Họ tên quá ngắn!',
            'name.max' => 'Họ tên quá dài!',
            'email.required' => 'Bạn chưa nhập email!',
            'email.email' => 'Email không đúng định dạng. VD: info@gmail.com',
            'email.string' => 'Email phải là chuỗi ký tự!',
            'email.unique' => 'Email đã tồn tại. hãy thử lại email khác!',
            'password.required' => 'Bạn chưa nhập mật khẩu!',
            'password.string' => 'Mật khẩu phải là chuỗi ký tự!',
            'password.min' => 'Mật khẩu phải lớn hơn 8 ký tự!',
            'password_confirmation.required' => 'Bạn chưa xác nhận mật khẩu.',
            'password_confirmation.min' => 'Mật khẩu phải lớn hơn 8 ký tự!',
            'password_confirmation.same' => 'Mật khẩu xác nhận không khớp.',
            // 'accept_clause.accepted' => 'Bạn phải chấp nhận điều khoản để đăng ký!',
        ];
    }
}
