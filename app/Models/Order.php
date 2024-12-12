<?php

namespace App\Models;

use App\Traits\QueryScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory, QueryScopes;
    protected $table = 'orders';
    protected $fillable = [
        'id',
        'code',
        'customer_id',
        'email',
        'full_name',
        'phone',
        'province_id',
        'district_id',
        'ward_id',
        'address',
        'note',
        'cart',
        'total_amount',
        'total_items',
        'status',
        'payment_method',
        'payment',
        'paid_at',
        'cancellation_reason',
        'canceled_by',
        'created_at',
    ];

    // Khai báo quan hệ belongsTo với bảng users
    public function user(): BelongsTo {
        return $this->belongsTo(User::class, 'customer_id', 'id');
    }

    //khai báo quan hệ với bảng cart_items
    public function cartItems():HasMany{
        return $this->hasMany(CartItem::class, 'cart_id', 'id');
    }
    public function orderItems():HasMany{
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }
  
}
