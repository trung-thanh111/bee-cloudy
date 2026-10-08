<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $fillable = [
        'id',
        'name',
        'start_date',
        'end_date',
        'discount_value',
        'minimum_amount',
        'usage_limit',
        'apply_for',
        'status',
        'code',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'voucher_products');
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_voucher');
    }

}
