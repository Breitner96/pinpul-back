<?php

use Illuminate\Database\Seeder;
use App\Entities\CategoryProvider;

class CategoryProviderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i <= 100; $i++){
            CategoryProvider::create([
                'category_id' => rand(1,7),
                'provider_id' => rand(1,30)
            ]);
        }
    }
}
