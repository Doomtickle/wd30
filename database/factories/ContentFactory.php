<?php

use Faker\Generator as Faker;

$factory->define(App\Content::class, function (Faker $faker) {
    return [
        'title' => 'Panama City Beach Real Estate Experts, Ron & Karen Branham',
        'body' => 'Ron and Karen Branham have a simple philosophy – provide “EXCEPTIONAL SERVICE TO EVERYONE THAT WALKS THROUGH THE FRONT DOOR!” They know the market well and have over 20 years experience. Karen and Ron also work closely with numerous local builders to help you find or build that perfect beach home! Whether you are ready to make the move, or just need some great advice, give Ron and Karen a call today!',
        'header_photo_path' => 'http://via.placeholder.com/1920x750',
        'broker_logo_path' => 'http://via.placeholder.com/250x150'
    ];
});
