<?php

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(!Schema::hasTable('roles')){
            throw new Exception('Roles table does not exisit.');
        }

        $admin_permissions = ['view all users', 'delete user', 'create user',
            'create report', 'view local report', 'view all reports', 'delete report',
            'create inspection', 'view local inspections', 'view all inspections', 'delete inspection',
            'create issue', 'view local issues', 'view all issues'
        ];

        $inspector_permissions = [ 'view all users',
            'create report', 'view local report', 'delete report',
            'create inspection', 'view local inspections', 'delete inspection',
            'create issue', 'view local issues',
        ];

        $student_permissions = [
            'create report', 'view local report',
            'create inspection', 'view local inspections',
            'create issue', 'view local issues',
        ];

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Role::truncate();
        DB::table('role_has_permissions')->truncate();

        $admin_role = new Role();
        $admin_role->name = "admin";
        $admin_role->save();
        foreach($admin_permissions as $p){
            $perm = Permission::where('name', $p)->first();
            $admin_role->permissions()->attach($perm->id);
        }

        $inspector_role = new Role();
        $inspector_role->name = "inspector";
        $inspector_role->save();
        foreach($inspector_permissions as $p){
            $perm = Permission::where('name', $p)->first();
            $inspector_role->permissions()->attach($perm->id);
        }

        $student_role = new Role();
        $student_role->name = "student";
        $student_role->save();
        foreach($student_permissions as $p){
            $perm = Permission::where('name', $p)->first();
            $student_role->permissions()->attach($perm->id);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
