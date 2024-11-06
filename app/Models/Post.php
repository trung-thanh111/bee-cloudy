<?php

namespace App\Models;

use App\Traits\QueryScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes, QueryScopes;
    protected $table = 'posts';
    protected $fillable =
    [
        'id',
        'name',
        'content',
        'image',
        'album',
        'description',
        'like',
        'slug',
        'user_id',
        'cre',
        'publish',
        'created_at',
    ];

    
    //khai báo quan hệ n-n với bảng post thông qua bảng pivot post_catalogue_post
    public function postCatalogues():BelongsToMany{
        return $this->belongsToMany(PostCatalogue::class, 'post_catalogue_post', 'post_id', 'post_catalogue_id');
    }

    public function users () :BelongsTo{
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
