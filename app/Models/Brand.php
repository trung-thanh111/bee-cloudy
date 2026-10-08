<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\QueryScopes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Brand extends Model
{
    use HasFactory, SoftDeletes, QueryScopes;
    protected $table = 'brands';
    protected $fillable = [
        'id',
        'name',
        'image',
        'description',
        'slug',
        'made_in',
        'establish',
        'publish',
        'created_at',
    ];

    // khia báo quán hệ vs bảng product (n)
    public function products():HasMany{
        return $this->hasMany(Product::class, 'brand_id');
    }
}
