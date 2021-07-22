<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Punctuation extends Model
{
    
    protected $fillable = [
        'rating_id',
        'user_id',
        'provider_id',
        'comment'
    ];

    public function rating(){
        return $this->belongsTo('App\Entities\Rating');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function provider(){
        return $this->belongsTo('App\Entities\Provider');
    }
}
