<?php

namespace App\Models;

use App\Traits\QueryScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Wishlist extends Model
{
    use HasFactory, SoftDeletes, QueryScopes;

    protected $table = 'wishlists';
    protected $fillable = [
        'id',
        'user_id',
        'product_id',
        'product_variant_id',
        'created_at',
        'updated_at',
    ];

    //khai bao quan he vs bang users (1)
    public function users():BelongsTo{
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function productVariants():BelongsTo{
        return $this->belongsTo(ProductVariant::class, 'product_variant_id', 'id');
    }
    public function products():BelongsTo{
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
