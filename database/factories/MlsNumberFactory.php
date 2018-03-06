<?php

use Faker\Generator as Faker;

$factory->define(App\MlsNumber::class, function (Faker $faker) {
    return [
        'mls_id' => 'B' . $faker->randomNumber(4)
    ];
});
