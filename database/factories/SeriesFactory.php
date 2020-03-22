<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Series;
use Faker\Generator as Faker;

$factory->define(Series::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
        'description' => $faker->paragraph(rand(2,5)),
        'air_time' => json_encode([
            'from_day' => $faker->date('l'),
            'to_day' => $faker->date('l'),
            'time' => $faker->time()
        ]),
    ];
});
