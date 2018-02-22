<?php

use App\MetaData;
use Faker\Generator as Faker;

$factory->define(MetaData::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'description' => $faker->paragraph
    ];
});
