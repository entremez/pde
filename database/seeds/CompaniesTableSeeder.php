<?php

use Illuminate\Database\Seeder;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $users = factory(App\User::class, 3)->create();

        $users->each(function($user){
                $user->role_id = 3;
                $user->save();
                $company = factory(App\Company::Class)->create();
                $company->user_id = $user->id;
                $company->save();
                $user->type_id = $company->id;
                $user->save();
            });

    }
}
