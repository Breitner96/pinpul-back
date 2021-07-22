<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $user = User::create([
        //     'name' => 'Gerencia',
        //     'email' => 'gerencia@gmail.com',
        //     'email_verified_at' => now(),
        //     'password' => bcrypt('secret'),
        //     'remember_token' => Str::random(10),
        // ]);
        // factory(User::class, 49)->create();

        User::create([
            'name' => 'Gerencia',
            'email' => 'gerencia@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('secret'),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => 'Administrador',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('secret'),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => 'Financiero',
            'email' => 'financiero@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('secret'),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => 'Atención al cliente',
            'email' => 'atencion@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('secret'),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => 'Proveedor',
            'email' => 'proveedor@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('secret'),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => 'Cliente',
            'email' => 'cliente@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('secret'),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => 'Anonimo',
            'email' => 'anonimo@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('secret'),
            'remember_token' => Str::random(10),
        ]);

        

    }
}
