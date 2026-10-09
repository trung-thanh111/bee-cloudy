<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBannerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:255',
            'album' => 'required',
            'location' => 'required',
            'date_start' => 'date',
            'date_end' => 'date|after:start_date',
        ];
    }
    // custom thông báo lỗi 
    public function messages(): array
    {
        return [
            'name.required' => 'Bạn chưa nhập tiêu đề banner.',
            'album.required' => 'Bạn chưa chọn ảnh banner.',
            'location.required' => 'Bạn chưa chọn vị trí ảnh banner.',
            'date_start.date' => 'Ngày bắt đầu không hợp lệ.',
            'date_end.date' => 'Ngày kết thúc không hợp lệ.',
            'date_end.after' => 'Ngày kết thúc phải sau ngày bắt đầu.',
        ];
    }
}
