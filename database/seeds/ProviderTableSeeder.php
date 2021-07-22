<?php

use Illuminate\Database\Seeder;
use App\Entities\Provider;

class ProviderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Provider::class, 30)->create();
    }
}
