<?php

use Illuminate\Database\Seeder;

class DashboardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('dashboards')->insert([
            'title' => "Acccount Management",
            'desc' => "Create or manage new users accounts",
            'img' =>    "mdi-folder-account",
            'link' => "/accounts",
            'accessible_to'=> 1, 
        ]);

        DB::table('dashboards')->insert([
            'title' => "Assign Inspection",
            'desc' => "Create or manage inspections",
            'img' =>    "mdi-clipboard-list",
            'link' => "/assignments",
            'accessible_to'=> 1, 
        ]);

        
        DB::table('dashboards')->insert([
            'title' => "My Inspections",
            'desc' => "View outstanding inspections",
            'img' =>    "mdi-clipboard-alert",
            'link' => "/myassignments",
            'accessible_to'=> 2, 
        ]);

        
        DB::table('dashboards')->insert([
            'title' => "Issue Tracker",
            'desc' => "View and manage issues in workplace",
            'img' =>    "mdi-bug",
            'link' => "/issues",
            'accessible_to'=> 2 , 
        ]);

        DB::table('dashboards')->insert([
            'title' => "Templates",
            'desc' => "View and manage inspection templates",
            'img' =>    "mdi-clipboard-text",
            'link' => "/templates",
            'accessible_to'=> 1, 
        ]);

        DB::table('dashboards')->insert([
            'title' => "Recycle",
            'desc' => "Restore or permanently delete items",
            'img' =>    "mdi-delete-restore",
            'link' => "/restore",
            'accessible_to'=> 1, 
        ]);

        DB::table('dashboards')->insert([
            'title' => "Laboratory",
            'desc' => "View and manage Laboratory",
            'img' =>    "mdi-domain",
            'link' => "/labs",
            'accessible_to'=> 1, 
        ]);



    }
}
