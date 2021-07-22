<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $fillable = [
        'provider_id',
        'image',
        'title',
        'description',
        'discount',
        'start_promotion',
        'end_promotion',
        'status'
    ];

}
