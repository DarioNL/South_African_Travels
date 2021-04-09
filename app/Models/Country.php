<?php

namespace App\Models;

use App\Models\concerns\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory, UsesUuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'countries';

    protected $fillable = [
        'name',
        'code',
        'flag',
    ];


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function Provinces(){
        return $this->hasMany(Province::class, 'country_id', 'id');
    }

}
