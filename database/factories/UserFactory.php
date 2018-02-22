<?php

use Faker\Generator as Faker;

$factory->define(App\User::class, function (Faker $faker) {
    $password = bcrypt('secret');
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password,
        'cell_phone' => $faker->phoneNumber,
        'office_phone' => $faker->phoneNumber,
        'primary_phone' => $faker->phoneNumber,
        'company' => $faker->company,
        'mls_id' => $faker->randomNumber(4),
        'is_realtor' => 1,
        'address' => $faker->address,
        'remember_token' => str_random(10),
    ];
});
