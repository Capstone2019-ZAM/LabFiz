<?php

use App\ReportSection;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReportSectionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        ReportSection::truncate();
        $report_sections = factory('App\ReportSection', 10)->create();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
