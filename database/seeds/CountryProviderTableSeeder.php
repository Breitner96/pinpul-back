<?php

use Illuminate\Database\Seeder;
use App\Entities\CountriesProvider;

class CountryProviderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i <= 100; $i++){
            CountriesProvider::create([
                'country_id' => rand(1,4),
                'provider_id' => rand(1,30)
                
            ]);
        }
    }
}
