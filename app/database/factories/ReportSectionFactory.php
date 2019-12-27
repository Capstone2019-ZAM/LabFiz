<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\ReportSection;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;

$factory->define(ReportSection::class, function (Faker $faker) {
    $report_ids = DB::table('reports')->select('id')->get();
    return [
        'title' => $faker->sentence,
        'report_id' => $faker->randomElement($report_ids)->id,
    ];
});
