<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class ContadorMes extends Model
{
    protected $fillable = [
        'provider_id',
        'mes',
        'vistas'
    ];
}
