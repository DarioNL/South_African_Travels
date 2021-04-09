<?php

namespace App\Models;

use App\Models\concerns\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Accommodation extends Authenticatable
{
    use HasFactory, UsesUuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'destination_id',
        'type',
        'chambers',
        'range',
        'code',
        'photo',
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

    public function Destination()
    {
        return $this->hasOne(Destination::class ,'id', 'destination_id');
    }

    public function Facilities(){
        return $this->hasMany(Facility::class, 'accommodation_id', 'id');
    }
}
