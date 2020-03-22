<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Episode;
use Faker\Generator as Faker;

$factory->define(Episode::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
        'description' => $faker->paragraph(rand(2,5)),
        'thumbnail' => $faker->imageUrl(),
        'duration' => $faker->numberBetween(600, 3600),
        'air_time' => $faker->date('Y-m-d G:i:s'),
        'asset' => $faker->imageUrl(),
        'series_id' => optional(\App\Series::inRandomOrder()->limit(1))->id ?? factory(\App\Series::class)->create()->id,
    ];
});
