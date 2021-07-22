<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    protected $fillable = [
        'provider_id',
        'user_id',
        'full_name',
        'company',
        'email',
        'phone',
        'asunto',
        'estado'
    ];

    public function provider(){
        return $this->belongsTo(Provider::class,'provider_id');
    }

    public function user(){
        return $this->belongsTo('App\User','user_id');
    }

}
