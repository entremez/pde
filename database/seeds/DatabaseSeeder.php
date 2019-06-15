<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(UsersTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(ClassificationsTableSeeder::class);
        $this->call(CitiesTableSeeder::class);
        $this->call(CompaniesTableSeeder::class);
        $this->call(AdminsTableSeeder::class);
        $this->call(ServicesTableSeeder::class);
        $this->call(ProvidersTableSeeder::class);
        $this->call(SurveysSeeder::class);
    }
}
