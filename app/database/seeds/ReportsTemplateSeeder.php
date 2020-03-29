<?php

use App\Report;
use App\ReportTemplate;
use Illuminate\Database\Seeder;

class ReportsTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Report::truncate();
        $reports = factory('App\ReportTemplate', 10)->create();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
