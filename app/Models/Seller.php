<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Seller extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'store_name',
        'store_description',
        'pic_name',
        'pic_phone',
        'email',
        'street_address',
        'rt_rw',
        'village',
        'city',
        'province',
        'id_card_number',
        'id_card_file',
        'pic_photo',
        'password',
        'status',
        'verified_at'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'verified_at' => 'datetime',
    ];

    /**
     * Relationship dengan products
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Scope untuk seller yang approved
     */
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }
}