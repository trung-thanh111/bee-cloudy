<?php

namespace App\Models;

use App\Traits\QueryScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banner extends Model
{
    use HasFactory, SoftDeletes, QueryScopes;
    protected $table = 'banners';
    protected $fillable =
    [
        'id',
        'name',
        'album',
        'location',
        'date_start',
        'date_end',
        'publish',
        'created_at',
    ];
}
