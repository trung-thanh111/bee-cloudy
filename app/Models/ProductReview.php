<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{
    use HasFactory;
    protected $table = 'product_reviews';
    protected $fillable = [
        'content',
        'image',
        'user_id',
        'slug_products',
        'id_products',
        'publish',
        'edit_count',

    ];
}
