<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Issue;
use Faker\Generator as Faker;

$factory->define(Issue::class, function (Faker $faker) {
    $user_ids = DB::table('users')->select('id')->get();
    return [
        'room' => $faker->numberBetween(1,100),
        'status' => $faker->randomElement(['incomplete', 'complete']),
        'title' => $faker->sentence,
        'severity' => $faker->randomElement(['mild', 'neutral','extreme']),
        'description' => $faker->sentence,
        'comments' => $faker->sentence,
        'user_id' => $faker->randomElement($user_ids)->id,
    ];
});
