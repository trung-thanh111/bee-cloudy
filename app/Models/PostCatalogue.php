<?php

namespace App\Models;

use App\Traits\QueryScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostCatalogue extends Model
{
    use HasFactory, SoftDeletes, QueryScopes;
    protected $table = 'post_catalogues';
    protected $fillable =
    [
        'id',
        'name',
        'parent_id',
        'image',
        'description',
        'slug',
        'publish',
        'created_at',
    ];

    //khai báo quan hệ n-n với bảng post thông qua bảng pivot post_catalogue_post
    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'post_catalogue_post', 'post_catalogue_id', 'post_id');
    }
    // khai báo quan hệ đến danh mục con thông qua parent_id
    public function childrenReference(): HasMany
    {
        return $this->hasMany(PostCatalogue::class, 'parent_id');
    }
    // khai báo quan hệ tới trường parent_id trong bảng lấy tham chiếu 
    public function parentReference(): BelongsTo
    {
        return $this->belongsTo(PostCatalogue::class, 'parent_id');
    }
}
