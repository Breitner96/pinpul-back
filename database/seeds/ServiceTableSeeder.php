<?php

use Illuminate\Database\Seeder;
use App\Entities\Service;

class ServiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = ['asesoría','conferencia','lavandería','entrega'];

        for($i= 0; $i <= count($services) - 1; $i++){
            Service::create([
                'service' => $services[$i]
            ]);
        }
    }
}
