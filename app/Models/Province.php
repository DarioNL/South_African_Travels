<?php

namespace App\Models;

use App\Models\Concerns\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory, UsesUuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'provinces';

    protected $fillable = [
        'name',
        'country_id',
    ];



    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function Country(){
        return $this->Hasone(Country::class, 'id', 'country_id');
    }

    public function Destinations(){
        return $this->Hasmany(Destination::class, 'province_id', 'id');
    }
}
