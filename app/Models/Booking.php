<?php

namespace App\Models;

use App\Models\concerns\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Booking extends Authenticatable
{
    use HasFactory, UsesUuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date',
        'user_id',
        'travel_id',
        'price',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function travel(){
        return $this->hasOne(Travel::class, 'id', 'travel_id');
    }

    public function travelers(){
        return $this->hasMany(traveler::class, 'booking_id', 'id');
    }
}
