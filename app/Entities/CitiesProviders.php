<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class CitiesProviders extends Model
{
    protected $fillable = [
        'city_id',
        'provider_id'
    ];
}
