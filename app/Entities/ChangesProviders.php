<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class ChangesProviders extends Model
{
    protected $fillable = [
        'provider_id',
        'info',
        'state'
    ];

    // public function categories()
    // {
    //     return $this->belongsToMany(Category::class,'category_providers');
    // }

    // public function services()
    // {
    //     return $this->belongsToMany(Service::class,'provider_services');
    // }

    // public function companies()
    // {
    //     return $this->belongsToMany(TypeCompany::class,'companies_providers');
    // }

    // public function clients()
    // {
    //     return $this->belongsToMany(TypeClient::class,'clients_providers');
    // }

    // public function countries()
    // {
    //     return $this->belongsToMany(Country::class,'countries_providers');
    // }

    // public function cities()
    // {
    //     return $this->belongsToMany(City::class,'cities_providers');
    // }

    // public function country()
    // {
    //     return $this->belongsTo(Country::class,'country_id');
    // }

    // public function city()
    // {
    //     return $this->belongsTo(City::class,'city_id');
    // }

    // public function user()
    // {
    //     return $this->belongsTo(User::class,'user_id');
    // }

    // public function typeDocument()
    // {
    //     return $this->belongsTo(TypeDocument::class,'type_document_id');
    // }

    // public function plan()
    // {
    //     return $this->belongsTo(Plan::class,'plan_id');
    // }

    // public function images()
    // {
    //     return $this->morphMany(Image::class,'imagetable');
    // }

    // public function documents()
    // {
    //     return $this->morphMany(Document::class,'documentable');
    // }
}
