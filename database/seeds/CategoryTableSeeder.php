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
            'category' => 'Bares y restaurantes',
            'imagen' => '1627335628.jpg',
            'slug' => 'bares-y-restaurantes',
            'views' => 0
        ]);

        Category::create([
            'category' => 'Cuero',
            'imagen' => '1627335640.jpg',
            'slug' => 'cuero',
            'views' => 0
        ]);

        Category::create([
            'category' => 'Tecnología',
            'imagen' => '1627335653.jpg',
            'slug' => 'tecnologia',
            'views' => 0
        ]);

        Category::create([
            'category' => 'Ropa y textil',
            'imagen' => '1627335665.jpg',
            'slug' => 'ropa-y-textil',
            'views' => 0
        ]);

    }
}
