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
            'desc' => "Create or manage inpsections",
            'img' =>    "mdi-clipboard-list",
            'link' => "/assignments",
            'accessible_to'=> 1, 
        ]);

        
        DB::table('dashboards')->insert([
            'title' => "My Pending Inspections",
            'desc' => "View outstanding inpsections",
            'img' =>    "mdi-clipboard-alert",
            'link' => "/assignments",
            'accessible_to'=> 1, 
        ]);

        
        DB::table('dashboards')->insert([
            'title' => "Issue Tracker",
            'desc' => "View and manage issues in workplace",
            'img' =>    "mdi-bug",
            'link' => "/issues",
            'accessible_to'=> 1, 
        ]);

        DB::table('dashboards')->insert([
            'title' => "Templates",
            'desc' => "View and manage inspection templates",
            'img' =>    "mdi-clipboard-text",
            'link' => "/templates",
            'accessible_to'=> 1, 
        ]);


    }
}