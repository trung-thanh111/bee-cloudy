<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'email' => 'required|string|email|unique:users|max:191',
            'name' => 'required|string|max:255',
            'user_catalogue_id' => 'gt:0',// bắt buộc chọn và giá trị > 0
            'password' => 'required|string|min:6',  
            'password_confirmation' => 'required|string|same:password', // re_password phải giống password trên 
        ];
    }
    // custom thông báo lỗi 
    public function messages(): array
    {
        return [
            //
            'email.required' => 'Bạn chưa nhập email!',
            'email.email' => 'Email chưa đúng định dạng. VD: info@gmail.com',
            'email.unique' => 'Email đã tồn tại. Vui lòng thử lại email Khác!',
            'email.string' => 'Email phải là các ký tự.',
            'email.max' => 'Email quá dài. Tối đa là 191 ký tự!',
            'name.required' => 'Bạn chưa nhập họ tên',
            'name.string' => 'Họ tên phải là ký tự.',
            'user_catalogue_id.gt' => 'Bạn chưa chọn nhóm thành viên.',
            'password.required' => 'Bạn chưa nhập mật khẩu!',
            'password_confirmation.required' => 'Vui lòng Xác minh mật khẩu.',
            'password_confirmation.same' => 'Mật khẩu không khớp.',
        ];
    }
}
