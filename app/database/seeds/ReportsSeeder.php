<?php

use App\Report;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReportsSeeder extends Seeder
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
        $reports = factory('App\Report', 10)->create();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
