<?php

use Illuminate\Database\Seeder;
use App\Entities\Image;
use Faker\Generator as Faker;

class ImageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run(Faker $faker)
    {
        for($i = 0; $i <= 300; $i++){
            Image::create([
                'image' => $faker->randomElement(['at_01.jpg','at_02.jpg','at_03.jpg','at_04.jpg','rm_01.jpg','rm_02.jpg','rm_03.jpg','rm_04.jpg']),
                'imagetable_id' => rand(1,30),
                'imagetable_type' => 'App\Entities\Provider'
            ]);
        }
    }
}
