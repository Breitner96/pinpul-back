<?php

use Illuminate\Database\Seeder;
use App\Entities\Plan;

class PlanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plans = ['Gratuíto','Premium'];

        for($i= 0; $i <= count($plans) - 1; $i++){
            Plan::create([
                'plan' => $plans[$i],
                'price' => rand(100000, 1000000)
            ]);
        }
    }
}
