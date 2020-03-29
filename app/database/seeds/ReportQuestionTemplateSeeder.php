<?php

use App\QuestionTemplate;
use Illuminate\Database\Seeder;

class ReportQuestionTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        QuestionTemplate::truncate();
        $sections = factory('App\QuestionTemplate', 10)->create();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
