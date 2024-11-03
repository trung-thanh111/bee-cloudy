<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    // Khai báo bảng tương ứng với model
    protected $table = 'promotions';

    // Các cột có thể được fill từ dữ liệu đầu vào
    protected $fillable = [
        'name',
        'code',
        'start_date',
        'end_date',
        'discount_value',
        'minimum_amount',
        'usage_limit',
        'apply_for',
        'status',
        'quantity',
    ];

    // Định dạng các cột ngày tháng
    protected $dates = ['start_date', 'end_date'];

    // Định nghĩa kiểu dữ liệu cho các trường
    protected $casts = [
        'discount_value' => 'decimal:2',
        'minimum_amount' => 'decimal:2',
        'usage_limit' => 'integer',
        'quantity' => 'integer',
    ];
}
