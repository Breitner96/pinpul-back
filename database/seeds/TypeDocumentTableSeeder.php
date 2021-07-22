<?php

use Illuminate\Database\Seeder;
use App\Entities\TypeDocument;

class TypeDocumentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $documents = ['Cédula de ciudadanía','Cédula de extranjería','Pasaporte'];

        for($i= 0; $i <= count($documents) - 1; $i++){
            TypeDocument::create([
                'document' => $documents[$i],
            ]);
        }
    }
}
