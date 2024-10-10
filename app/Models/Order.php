<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = [
        'id',
        'user_id',
        'status',
        'note',
        'create_at',
    ];

    // Khai báo quan hệ belongsTo với bảng users
    public function user(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    //khai báo quan hệ với bảng cart_items
    public function orderItems():HasMany{
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }
}
