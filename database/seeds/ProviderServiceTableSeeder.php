<?php

use Illuminate\Database\Seeder;
use App\Entities\ProviderService;

class ProviderServiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i <= 100; $i++){
            ProviderService::create([
                'provider_id' => rand(1,30),
                'service_id' => rand(1,4)
            ]);
        }
    }
}
