<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        'file_name',
        'file_url',
        'price',
        'is_hot',
        'rating',
        'sold_count',
        'favorite_count',
        'album',
        'publish',
    ];

    // khai báo quan hệ với bảng product 
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    // khai báo quan hệ với bảng attribute thông qua bảng pivot
    public function attributes ():BelongsToMany {
        return $this->belongsToMany(Attribute::class, 'product_variant_attribute', 'product_variant_id', 'attribute_id');
    }

    public function wishlists(): HasMany
    {
        return $this->hasMany(WishList::class, 'product_vairant_id', 'id');
    }
    
}
