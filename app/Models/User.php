<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

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
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */


    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id',
        'email_verification_token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    //khai bao quan he vs bang user_catalogues (N)
    public function userCatalogues(): BelongsTo
    {
        return $this->belongsTo(UserCatalogue::class, 'user_catalogue_id');
    }

    // Khai báo quan hệ hasMany với bảng carts
    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class, 'user_id', 'id');
    }
    public function wishLists(): HasMany
    {
        return $this->hasMany(Wishlist::class, 'user_id', 'id');
    }
    public function userVouchers()
    {
        return $this->hasMany(UserVoucher::class);
    }
}
