<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = App\User::create([
            'email' => 'administrador@puentedisenoempresa.cl',
            'password' => bcrypt('@Bienpublico2017'),
            'role_id' => 1
        ]);

        $admin = App\Admin::create([
            'name' => 'Admin',
            'user_id' => $user->id
        ]);

        $user->type_id = $admin->id;
        $user->save();
    }
}
