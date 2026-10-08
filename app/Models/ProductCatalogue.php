<?php

namespace App\Models;

use App\Traits\QueryScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCatalogue extends Model
{
    use HasFactory, SoftDeletes, QueryScopes;
    protected $table = 'product_catalogues';
    protected $fillable = [
        'id',
        'parent_id',
        'slug',
        'name',
        'image',
        'description',
        'publish',
        'created_at',
    ];


    // tham chiếu đến danh mục con
    public function childrenReference(): HasMany
    {
        return $this->hasMany(ProductCatalogue::class, 'parent_id');
    }
    // khia bao quan he tham chieu den parent_id
    public function parentReference(): BelongsTo
    {
        return $this->belongsTo(ProductCatalogue::class, 'parent_id');
    }

    //khai báo quan hệ n-n vs bảng products thông qua bảng pivot 
    public function products():BelongsToMany {
        return $this->belongsToMany(ProductCatalogue::class, 'product_catalogue_product', 'product_catalogue_id', 'product_id');
    }
    
}
