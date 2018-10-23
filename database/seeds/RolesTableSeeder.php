<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Role::create([
            'role' => "admin"
          ]);
        App\Role::create([
            'role' => "provider"
          ]);
        App\Role::create([
            'role' => "company"
          ]);
    }
}
