<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCancelOrderRequest extends FormRequest
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
            'cancellation_reason' => 'required|max:255',
        ];
    }
    public function messages(): array
    {
        return [
            'cancellation_reason.required' => 'Bạn chưa chọn lý do hủy đơn hàng của người dùng.',
            'cancellation_reason.max' => 'Lý do hủy không được vượt quá 255 ký tự.',
        ];
    }
}
