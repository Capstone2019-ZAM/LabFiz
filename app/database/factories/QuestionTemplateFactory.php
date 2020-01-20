<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\QuestionTemplate;
use Faker\Generator as Faker;

$factory->define(QuestionTemplate::class, function (Faker $faker) {
    $section_ids = DB::table('section_templates')->select('id')->get();
    return [
        'question' => $faker->sentence,
        'section_id' => $faker->randomElement($section_ids)->id,
    ];
});
