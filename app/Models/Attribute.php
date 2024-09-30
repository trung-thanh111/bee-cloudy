<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\QueryScopes;

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
        'user_id',
        'attribute_catalogue_id',
        'publish',
        'created_at',
    ];
    // khia báo quan hê vs bảng attributeCatalogues
    public function attributeCatalogues():BelongsTo{
        return $this->belongsTo(AttributeCatalogue::class, 'attribute_catalogue_id', 'id');
    }
}
