<?php

use Illuminate\Database\Seeder;
use App\Entities\CompaniesProviders;

class CompanyProviderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i <= 100; $i++){
            CompaniesProviders::create([
                'type_company_id' => rand(1,3),
                'provider_id' => rand(1,30)
                
            ]);
        }
    }
}
