<?php

use App\SectionTemplate;
use Illuminate\Database\Seeder;

class ReportSectionTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        SectionTemplate::truncate();
        $sections = factory('App\SectionTemplate', 10)->create();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
