<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = [
        'indicator',
        'country'
    ];

    public function providers()
    {
        return $this->belongsToMany(Provider::class,'countries_providers');
    }
}
