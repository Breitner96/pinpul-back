<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class CategoryProvider extends Model
{
    protected $fillable = [
        'category_id',
        'provider_id'
    ];

    public function provider(){
        return $this->belongsToMany('App\Entities\Provider');
    }

    public function category(){
        return $this->belongsToMany('App\Entities\Category')->withPivot('category_id');
    }
}
