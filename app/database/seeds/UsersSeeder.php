<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        DB::table('model_has_premissions')->truncate();

        $users = factory('App\User', 10)->create();
        $roles = ['admin','inspector','student'];
        foreach($users as $user){
            $role = Role::where('name', array_rand($roles,1))->first();
            $user->assignRole($role->id);
        }
    }
}
