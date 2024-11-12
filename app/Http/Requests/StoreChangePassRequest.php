<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreChangePassRequest extends FormRequest
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
            'email' => 'required|string|email|max:255',
        ];
    }
    // custom thông báo lỗi 
    public function messages(): array
    {
        return [
            //
            'email.required' => 'Bạn chưa nhập email!',
            'email.email' => 'Email chưa đúng định dạng. VD: info@gmail.com',
            'email.string' => 'Email phải là các ký tự.',
            'email.max' => 'Email quá dài. Tối đa là 255 ký tự!',
        ];
    }
}
