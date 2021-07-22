<?php

use Illuminate\Database\Seeder;
use App\Entities\TypeClient;

class TypeClientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $typeClient = ['Empresa','Particulares','Profesionales','Emprendedores'];

        for($i= 0; $i <= count($typeClient) - 1; $i++){
            TypeClient::create([
                'type_client' => $typeClient[$i],
            ]);
        }
    }
}
