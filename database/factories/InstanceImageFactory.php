<?php

use Faker\Generator as Faker;

$factory->define(App\InstanceImage::class, function (Faker $faker) {
    return [
        'image' => 'http://via.placeholder.com/350x350'
    ];
});
