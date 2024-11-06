<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\QueryScopes; // include queryscope 
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AttributeCatalogue extends Model
{
    // sd queryscopes 
    use HasFactory, SoftDeletes, QueryScopes;
    protected $table = 'attribute_catalogues';
    protected $fillable = [
        'id',
        'name',
        'image',
        'description',
        'slug',
        'publish',
        'created_at',
    ];
    // khia báo quan hê vs bảng attributes
    public function attributes():HasMany{
        return $this->hasMany(Attribute::class, 'attribute_catalogue_id', 'id');
    }
    
}
