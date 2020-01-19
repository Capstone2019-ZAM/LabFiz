<?php

use App\User;
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
        if(App::Environment() === 'local'){
            // seed permissions
            $this->call(PermissionsSeeder::class);

            // seed roles
            $this->call(RolesSeeder::class);

            // seed users using factory
            $this->call(UsersSeeder::class);
        }
    }
}