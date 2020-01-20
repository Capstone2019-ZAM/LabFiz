<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\ReportTemplate;
use Faker\Generator as Faker;

$factory->define(ReportTemplate::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
    ];
});
