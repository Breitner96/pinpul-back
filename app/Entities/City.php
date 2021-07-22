<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = [
        'country_id',
        'city'
    ];

    public function country(){
        return $this->belongsTo('App\Entities\Country');
    }

    public function providers()
    {
        return $this->belongsToMany(Provider::class,'cities_providers');
    }

}
