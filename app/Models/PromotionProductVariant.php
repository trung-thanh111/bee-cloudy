<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PromotionProductVariant extends Model
{
    // Đảm bảo tên bảng đúng
    protected $table = 'promotion_product_variants';

    // Các thuộc tính có thể được gán vào
    protected $fillable = [
        'promotion_id',
        'product_id',
        'discount',
    ];

    // Định nghĩa quan hệ với Promotion (nếu bạn có bảng promotions)
    public function promotion()
    {
        return $this->belongsTo(Promotion::class, 'promotion_id');
    }

    // Định nghĩa quan hệ với Product (nếu bạn có bảng products)
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function products()
{
    return $this->belongsToMany(Product::class, 'promotion_product_variants', 'promotion_id', 'product_id')
                ->withPivot('discount'); // Lấy cả thông tin giảm giá từ bảng liên kết nếu cần
}

}
