<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class TypeCompany extends Model
{
    protected $fillable = [
        'type_company',
    ];

    public function providers()
    {
        return $this->belongsToMany(Provider::class,'companies_providers');
    }
}
