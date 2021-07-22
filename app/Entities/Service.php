<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'service',
    ];
    
    public function images()
    {
        return $this->morphOne(Image::class,'imagetable');
    }
}
