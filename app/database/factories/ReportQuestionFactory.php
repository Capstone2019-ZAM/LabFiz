<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\ReportQuestion;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;

$factory->define(ReportQuestion::class, function (Faker $faker) {
    $report_section_ids = DB::table('report_sections')->select('id')->get();
    return [
        'question' => $faker->sentence,
        'report_section_id' => $faker->randomElement($report_section_ids)->id,
    ];
});
