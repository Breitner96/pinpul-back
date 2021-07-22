<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = ['gerencia','admin','financiero','atención al cliente', 'proveedor', 'cliente'];

        for($i= 0; $i <= count($roles) - 1; $i++){
            Role::create([
                'name' => $roles[$i],
                'guard_name' => 'api',
            ]);
        }
    }
}
