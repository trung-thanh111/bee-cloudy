<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
            'full_name' => 'required|max:255',
            'note' => 'max:255',
            'email' => 'required|string|email',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'province_id' => 'required',
            'district_id' => 'required',
            'ward_id' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'full_name.required' => 'Bạn chưa nhập tên.',
            'full_name.max' => 'Tên không được quá 255 ký tự.',
            'note.max' => 'Mô tả không được quá 255 ký tự.',
            'email.required' => 'Bạn chưa nhập email!',
            'email.email' => 'Email không đúng định dạng. VD: info@gmail.com',
            'email.string' => 'Email Phải là chuỗi ký tự!',
            'phone.required' => 'Bạn chưa nhập số điện thoại.',
            'phone.regex' => 'Số điện thoại không hợp lệ.',
            'phone.min' => 'Số điện thoại phải có ít nhất 10 số.',
            'province.required' => 'Bạn chưa chọn tỉnh/thành phố.',
            'district.required' => 'Bạn chưa chọn quận/huyện.',
            'ward.required' => 'Bạn chưa chọn phường/xã.',
        ];
    }
}
