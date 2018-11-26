<?php

use Faker\Generator as Faker;

$factory->define(App\Instance::class, function (Faker $faker) {

    $units = ['MM', '%', 'X', '+', ''];
    return [
        'name' => $faker->word,
        'classification_id' => rand(1,22),
        'company_name' => $faker->company,
        'city_id' => rand(1,18),
        'quantity' => rand(1,999),
        'unit' => $units[rand(0,4)],
        'sentence' => $faker->realText($faker->numberBetween(30,50)),
        'long_description' => $faker->text,
        'year' => rand(2001,2018),
        'approved' => rand(0,1),
        'employees_range' => rand(1,4),
    ];
});
