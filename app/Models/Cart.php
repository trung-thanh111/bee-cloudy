<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'carts';
    protected $fillable = [
        'id',
        'user_id',
        'create_at',
    ];

    // Khai báo quan hệ belongsTo với bảng users
    public function user(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    //khai báo quan hệ với bảng cart_items
    public function cartItems():HasMany{
        return $this->hasMany(CartItem::class, 'cart_id', 'id');
    }
}
