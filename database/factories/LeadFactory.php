<?php

use Faker\Generator as Faker;

$factory->define(App\Lead::class, function (Faker $faker) {
    return [
        'name'    => $faker->name,
        'phone'   => $faker->phoneNumber,
        'email'   => $faker->email,
        'message' => $faker->paragraph,
    ];
});
