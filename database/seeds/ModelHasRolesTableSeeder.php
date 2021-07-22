<?php

use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class ModelHasRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::find(1);
        $user->assignRole('gerencia');

        $user = User::find(2);
        $user->assignRole('admin');
        
        $user = User::find(3);
        $user->assignRole('financiero');
        
        $user = User::find(4);
        $user->assignRole('atención al cliente');
        
        $user = User::find(5);
        $user->assignRole('proveedor');
        
        $user = User::find(6);
        $user->assignRole('cliente');
    }
}
