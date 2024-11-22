<?php

namespace App\Models;

use App\Traits\QueryScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, QueryScopes;

    /**
     * Các thuộc tính có thể điền hàng loạt.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'birthday',
        'phone',
        'province_id',
        'district_id',
        'ward_id',
        'address',
        'phone',
        'phone',
        'description',
        'image',
        'google_id',
        'facebook_id',
        'user_catalogue_id',
        'email_verification_token',
    ];

    /**
     * Các thuộc tính bị ẩn khi hiển thị.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Các thuộc tính cần được ép kiểu.
     *
     * @return array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Quan hệ với bảng user_catalogues
    public function userCatalogue(): BelongsTo
    {
        return $this->belongsTo(UserCatalogue::class, 'user_catalogue_id');
    }

    // Quan hệ hasMany với bảng carts
    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class, 'user_id', 'id');
    }

    // Quan hệ hasMany với bảng wishlists
    public function wishLists(): HasMany
    {
        return $this->hasMany(Wishlist::class, 'user_id', 'id');
    }

    // Quan hệ hasMany với bảng user_vouchers
    public function userVouchers(): HasMany
    {
        return $this->hasMany(UserVoucher::class);
    }
}
