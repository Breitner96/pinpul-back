<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = ['document'];

    public function documentable()
    {
        return $this->morphTo();
    }
}
