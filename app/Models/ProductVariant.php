<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductVariant extends Model
{
    use HasFactory;
    public $table = 'product_variants';
    protected $fillable = [
        'product_id',
        'code',
        'name',
        'quantity',
        'sku',
        'price',
        'barcode',
        'file_name',
        'file_url',
        'price',
        'is_hot',
        'rating',
        'sold_count',
        'favorite_count',
        'album',
        'user_id',
        'publish',
    ];

    // khai báo quan hệ với bảng product 
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
