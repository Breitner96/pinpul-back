<?php

use Illuminate\Database\Seeder;
use App\Entities\TypeCompany;

class TypeCompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $typeCompany = ['Fabricante','Distribuidor','Servicio'];

        for($i= 0; $i <= count($typeCompany) - 1; $i++){
            TypeCompany::create([
                'type_company' => $typeCompany[$i],
            ]);
        }
    }
}
