<?php

namespace App\Models;

use App\Traits\QueryScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserCatalogue extends Model
{
    use HasFactory, SoftDeletes, QueryScopes;
    protected $table = 'user_catalogues';
    protected $fillable = [
        'id',
        'name',
        'slug',
        'image',
        'description',
        'keyword',
        'acronym',
        'publish',
        'created_at',
        'updated_at',
    ];

    //khai bao quan he vs bang users (1)
    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'user_catalogue_id');
    }
}
