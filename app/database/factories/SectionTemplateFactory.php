<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\SectionTemplate;
use Faker\Generator as Faker;

$factory->define(SectionTemplate::class, function (Faker $faker) {
    $report_ids = DB::table('report_templates')->select('id')->get();
    return [
        'title' => $faker->sentence,
        'report_id' => $faker->randomElement($report_ids)->id,
    ];
});
