<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class CompaniesProviders extends Model
{
    protected $fillable = [
        'type_company_id',
        'provider_id'
        
    ];
}
