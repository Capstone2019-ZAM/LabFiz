<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Report;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;

$factory->define(Report::class, function (Faker $faker) {
    $user_ids = DB::table('users')->select('id')->get();
    return [
        'title' => $faker->sentence,
        'user_id' => $faker->randomElement($user_ids)->id,
    ];
});
