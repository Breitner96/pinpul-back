<?php

use Illuminate\Database\Seeder;
use App\Entities\Country;

class CountryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Country::create([
            'indicator' => '+54',
            'country' => 'Argentina',
        ]);

        Country::create([
            'indicator' => '+56',
            'country' => 'Chile',
        ]);

        Country::create([
            'indicator' => '+57',
            'country' => 'Colombia',
        ]);

        Country::create([
            'indicator' => '+593',
            'country' => 'Ecuador',
        ]);
    }
}
