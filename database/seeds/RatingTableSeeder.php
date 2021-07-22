<?php

use Illuminate\Database\Seeder;
use App\Entities\Rating;

class RatingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ratings = ['1','2','3','4','5'];

        for($i= 0; $i <= count($ratings) - 1; $i++){
            Rating::create([
                'rating' => $ratings[$i],
            ]);
        }  
    }
}
