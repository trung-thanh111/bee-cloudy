<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CartItem extends Model
{
    use HasFactory;
    protected $table = 'carts';
    protected $fillable = [
        'id',
        'cart_id',
        'product_variant_id',
        'quantity',
        'price',
        'total',
    ];

    // Khai báo quan hệ belongsTo với bảng carts
    public function cart(): BelongsTo {
        return $this->belongsTo(Cart::class, 'cart_id', 'id');
    }

    // Khai báo quan hệ belongsTo với bảng carts
    public function productVariant(): BelongsTo {
        return $this->belongsTo(ProductVariant::class, 'product_variant_id', 'id');
    }
    
    
}
