<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CartItem extends Model
{
    use HasFactory;
    protected $table = 'cart_items';
    protected $fillable = [
        'id',
        'cart_id',
        'product_id',
        'product_variant_id',
        'product_name',
        'quantity',
        'price',
        'total',
        'options',
    ];


    //khai báo quan hệ với bảng order_items
    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class, 'cart_id', 'id');
    }

    // Khai báo quan hệ belongsTo với bảng products
    public function products(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    // Khai báo quan hệ belongsTo với bảng productVariants
    public function productVariants():BelongsTo
    {
        return $this->belongsTo(ProductVariant::class, 'product_variant_id', 'id');
    }
}
