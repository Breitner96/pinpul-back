<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CountryTableSeeder::class);
        // $this->call(CityTableSeeder::class);
        $this->call(CategoryTableSeeder::class); 
        $this->call(PlanTableSeeder::class); 
        $this->call(TypeClientTableSeeder::class);
        $this->call(TypeCompanyTableSeeder::class); 
        $this->call(TypeDocumentTableSeeder::class); 
        $this->call(UsersTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        // $this->call(ProviderTableSeeder::class);
        // $this->call(ServiceTableSeeder::class);
        // $this->call(CategoryProviderTableSeeder::class);
        // $this->call(ProviderServiceTableSeeder::class);
        // $this->call(ImageTableSeeder::class);
        // $this->call(DocumentTableSeeder::class);
        $this->call(RatingTableSeeder::class);
        // $this->call(CityProviderTableSeeder::class);
        // $this->call(ClientProviderTableSeeder::class);
        // $this->call(CompanyProviderTableSeeder::class);
        // $this->call(CountryProviderTableSeeder::class);
        $this->call(ModelHasRolesTableSeeder::class);
        $this->call(ModelHasPermissionsTableSeeder::class);
        $this->call(FillPermissionsModelTableSeeder::class);
    }
}