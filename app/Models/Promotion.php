<?php

namespace App\Models;

use App\Traits\QueryScopes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Promotion extends Model
{
    use QueryScopes;
    // Khai báo bảng tương ứng với model
    protected $table = 'promotions';

    // Các cột có thể được fill từ dữ liệu đầu vào
    protected $fillable = [
        'name',
        'image',
        'code',
        'start_date',
        'end_date',
        'discount',
        'minimum_amount',
        'usage_limit',
        'apply_for',
        'status',
        'description'
    ];

    // Định dạng các cột ngày tháng
    protected $dates = ['start_date', 'end_date'];

    // Định nghĩa kiểu dữ liệu cho các trường
    protected $casts = [
        'discount' => 'decimal:2',
        'minimum_amount' => 'decimal:2',
        'usage_limit' => 'integer',
        'quantity' => 'integer',
    ];
    public function products()
{
    return $this->belongsToMany(Product::class, 'promotion_product_variants')
                ->withPivot('discount')
                ->withTimestamps();
}
public function userVouchers()
{
    return $this->hasMany(UserVoucher::class, 'promotion_id');
}
public function getPromotionProducts()
{
    return PromotionProductVariant::where('promotion_id', $this->id)->pluck('product_id')->toArray();
}

}
