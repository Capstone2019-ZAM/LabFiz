<?php

use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(!Schema::hasTable('permissions')){
            throw new Exception('Permissions table does not exisit.');
        }

        $admin_permissions = ['view all users', 'delete user', 'create user',
            'create report', 'view local report', 'view all reports', 'delete report',
            'create inspection', 'view local inspections', 'view all inspections', 'delete inspection',
            'create issue', 'view local issues', 'view all issues'
        ];

        $inspector_permissions = [
            'create report', 'view local report', 'delete report',
            'create inspection', 'view local inspections', 'delete inspection',
            'create issue', 'view local issues',
        ];

        $student_permissions = [
            'create report', 'view local report',
            'create inspection', 'view local inspections',
            'create issue', 'view local issues',
        ];

        $admin_role = Role::where('name', 'admin')->first();
        $inspector_role = Role::where('name', 'inspector')->first();
        $student_role = Role::where('name', 'student')->first();

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        Permission::truncate();

        foreach ($admin_permissions as $p) {
            $perm = new Permission();
            $perm->name = $p;
            $perm->save();
        }

        foreach ($inspector_permissions as $p) {
            $perm = new Permission();
            $perm->name = $p;
            $perm->save();
        }

        foreach ($student_permissions as $p) {
            $perm = new Permission();
            $perm->name = $p;
            $perm->save();
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
