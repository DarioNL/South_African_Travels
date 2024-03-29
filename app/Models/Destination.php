<?php

namespace App\Models;

use App\Models\concerns\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Destination extends Authenticatable
{
    use HasFactory, UsesUuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'location',
        'province_id',
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

    public function accommodations()
    {
        return $this->hasMany(Accommodation::class, 'destination_id', 'id');
    }

    public function Travels(){
        return $this->hasMany(Travel::class, 'destination_id', 'id');
    }

    Public function Province(){
        return $this->hasOne(Province::class, 'id', 'province_id');
    }
}
