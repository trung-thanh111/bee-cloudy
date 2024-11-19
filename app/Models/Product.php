<?php

namespace App\Models;

use App\Traits\QueryScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes, QueryScopes;
    protected $table = 'products';
    protected $fillable = [
        'id',
        'name',
        'image',
        'album',
        'slug',
        'short_desc',
        'description',
        'info',
        'brand_id',
        'sku',
        'user_id',
        'attributeCatalogue', // json
        'attribute', // json
        'variant',  // json
        'price',
        'del',
        'publish',
        'created_at',
        'like_count'

    ];
    
    // casts chuyển json thành mảng khi lấy ra và thành json khi insert vào 
    protected $casts = [
        'attribute' => 'json'
    ];

    //khai báo quan hệ n-n vs bảng product_catalogues thông qua bảng pivot 
    public function productCatalogues(): BelongsToMany
    {
        return $this->belongsToMany(ProductCatalogue::class, 'product_catalogue_product', 'product_id', 'product_catalogue_id');
    }
    // khia báo quán hệ vs bảng brand (n)
    public function brands(): BelongsTo
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }
    //khia báo quan hệ với bảng product variant (1pro - nhiều phiên bản)
    public function productVariant(): HasMany
    {
        return $this->hasMany(ProductVariant::class, 'product_id', 'id');
    }
    
    public function wishlists(): HasMany
    {
        return $this->hasMany(WishList::class, 'product_id', 'id');
    }
    public function vouchers()
    {
        return $this->belongsToMany(Voucher::class, 'voucher_products');
    }
}
