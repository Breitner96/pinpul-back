<?php

use Illuminate\Database\Seeder;
use App\Entities\City;

class CityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities = ['Bogotá','Cali','Pereira','Tuluá','Medellín'];

        for($i= 0; $i <= count($cities) - 1; $i++){
            City::create([
                // 'country_id' => rand(1,4),
                'country_id' => 3,
                'city' => $cities[$i],
            ]);
        }
    }
}
