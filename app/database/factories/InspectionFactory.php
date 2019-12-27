<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Inspection;
use Faker\Generator as Faker;

$factory->define(Inspection::class, function (Faker $faker) {
    $user_ids = DB::table('users')->select('id')->get();
    $report_ids = DB::table('reports')->select('id')->get();
    return [
        'room' => $faker->numberBetween(1,100),
        'status' => $faker->randomElement(['incomplete', 'complete']),
        'due_date' => $faker->date(),
        'user_id' => $faker->randomElement($user_ids)->id,
        'assigned_to' => $faker->randomElement($user_ids)->id,
        'report_id' => $faker->randomElement($report_ids)->id,
    ];
});
