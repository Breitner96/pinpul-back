<?php

use Illuminate\Database\Seeder;
use App\Entities\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'category' => 'Confección',
            'imagen' => 'at_01.jpg',
            'slug' => 'confeccion',
            'views' => 0
        ]);

        Category::create([
            'category' => 'Cortes',
            'imagen' => 'at_02.jpg',
            'slug' => 'cortes',
            'views' => 0
        ]);

        Category::create([
            'category' => 'Desarrollo',
            'imagen' => 'at_03.jpg',
            'slug' => 'desarrollo',
            'views' => 0
        ]);

        Category::create([
            'category' => 'Ropa',
            'imagen' => 'at_04.jpg',
            'slug' => 'ropa',
            'views' => 0
        ]);

        Category::create([
            'category' => 'Uniforme',
            'imagen' => 'rm_01.jpg',
            'slug' => 'uniforme',
            'views' => 0
        ]);

        Category::create([
            'category' => 'Diseño',
            'imagen' => 'rm_02.jpg',
            'slug' => 'diseno',
            'views' => 0
        ]);

        Category::create([
            'category' => 'Marketing',
            'imagen' => 'rm_03.jpg',
            'slug' => 'marketing',
            'views' => 0
        ]);
    }
}
