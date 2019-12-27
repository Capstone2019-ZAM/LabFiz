<?php

use App\Issue;
use Illuminate\Database\Seeder;

class IssuesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Issue::truncate();
        $reports = factory('App\Issue', 10)->create();
    }
}
