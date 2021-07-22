<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class TypeClient extends Model
{
    protected $fillable = [
        'type_client',
    ];

    public function providers()
    {
        return $this->belongsToMany(Provider::class,'clients_providers');
    }
}
