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
            'email' => 'admin@admin.com',
            'password' => bcrypt('123456'),
            'type' => 'Admin'
        ]);

        $admin = App\Admin::create([
            'name' => 'Admin',
            'user_id' => $user->id
        ]);

        $user->type_id = $admin->id;
        $user->save();
    }
}
