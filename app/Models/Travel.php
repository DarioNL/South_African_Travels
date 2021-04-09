<?php

namespace App\Models;

use App\Models\concerns\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Travel extends Authenticatable
{
    use HasFactory, UsesUuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'travels';

    protected $fillable = [
        'start_date',
        'end_date',
        'user_id',
        'type',
        'destination_id',
        'price',
        'code'
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

    public function Bookings(){
        return $this->hasMany(Booking::class, 'travel_id', 'id');
    }

    public function Destination(){
        return $this->hasOne(Destination::class, 'id', 'destination_id');
    }
}
