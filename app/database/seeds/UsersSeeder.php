<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Spatie\Permission\Models\Role;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        User::truncate();
        DB::table('model_has_permissions')->truncate();

        $users = factory('App\User', 10)->create();
        $roles = ['admin', 'inspector', 'student'];
        foreach ($users as $user) {
            $role = Role::where('name', Arr::random($roles))->first();
            $this->command->info($role);
            $user->assignRole($role->id);
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
