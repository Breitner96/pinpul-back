<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class CountriesProvider extends Model
{
    protected $fillable = [
        'country_id',
        'provider_id'
        
    ];
}
