<?php

use Faker\Generator as Faker;

$factory->define(App\QuestionType::class, function (Faker $faker) {
    return [
        'type' => $faker->sentence(5),
        'description' => $faker->sentence(15)
    ];
});
