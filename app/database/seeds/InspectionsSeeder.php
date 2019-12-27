<?php

use App\Inspection;
use Illuminate\Database\Seeder;

class InspectionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Inspection::truncate();
        $reports = factory('App\Inspection', 10)->create();
    }
}
