<?php

use Faker\Generator as Faker;

$factory->define(App\Result::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->realText(500),
    ];
});
