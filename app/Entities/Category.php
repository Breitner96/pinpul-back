<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'category',
        'slug',
        'imagen',
        'views'
    ];

    public function providers()
    {
        return $this->belongsToMany(Provider::class,'category_providers');
    }

 

}