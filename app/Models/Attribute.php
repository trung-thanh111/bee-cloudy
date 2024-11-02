<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\QueryScopes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Attribute extends Model
{
    use HasFactory,SoftDeletes, QueryScopes;
    protected $table = 'attributes';
    protected $fillable = [
        'id',
        'name',
        'image',
        'description',
        'slug',
        'attribute_catalogue_id',
        'publish',
        'created_at',
    ];
    // khia báo quan hê vs bảng attributeCatalogues
    public function attributeCatalogues():BelongsTo{
        return $this->belongsTo(AttributeCatalogue::class, 'attribute_catalogue_id', 'id');
    }

    // khai báo quan hệ với bảng product_variant thông qua bảng pivot
    public function productVariants ():BelongsToMany {
        return $this->belongsToMany(ProductVariant::class, 'product_variant_attribute', 'attribute_id', 'product_variant_id');
    }
}
