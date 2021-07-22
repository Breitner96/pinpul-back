<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entities\Provider;
use Faker\Generator as Faker;

// $defaultImage = ['at_01.jpg','at_02.jpg','at_03.jpg','at_04.jpg','rm_01.jpg','rm_02.jpg','rm_03.jpg','rm_04.jpg','default.jpg'];

$factory->define(Provider::class, function (Faker $faker) {
    return [
        'plan_id' => rand(1,3),
        'country_id' => 3,
        'city_id' => rand(1,5),
        'user_id' => rand(2,30),
        'type_document_id' => rand(1,3),
        'logo' => $faker->randomElement(['at_01.jpg','at_02.jpg','at_03.jpg','at_04.jpg','rm_01.jpg','rm_02.jpg','rm_03.jpg','rm_04.jpg']),
        'provider' => $faker->name,
        'slug' => $faker->slug,
        'description' => $faker->text($maxNbChars = 350),
        'product'=>$faker->text($maxNbChars=20),
        'num_document' => rand(0,1999999999),
        'phone' => rand(0,3999999999),
        'email' => $faker->email,
        'nempleados' => rand(0,100),
        'details' => $faker->name,
        'garantia' => $faker->name,
        'facebook_url' => $faker->url,
        'twitter_url' => $faker->url,
        'instagram_url' => $faker->url,
        'linkedin_url' => $faker->url,
        'web_site' => $faker->url,
        'views' => 0,
        'views_tel' => 0,
        'state' => "en revisión"
    ];
});
