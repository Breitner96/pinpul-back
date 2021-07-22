<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class ClientsProvider extends Model
{
    protected $fillable = [
        'type_client_id',
        'provider_id'
        
    ];
}
