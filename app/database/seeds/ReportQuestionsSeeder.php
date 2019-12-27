<?php

use App\ReportQuestion;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReportQuestionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ReportQuestion::truncate();
        $report_questions = factory('App\ReportQuestion', 10)->create();
    }
}
