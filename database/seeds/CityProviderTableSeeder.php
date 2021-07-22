<?php

use Illuminate\Database\Seeder;
use App\Entities\CitiesProviders;

class CityProviderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i <= 100; $i++){
            CitiesProviders::create([
                'city_id' => rand(1,5),
                'provider_id' => rand(1,30)
                
            ]);
        }
    }
}
