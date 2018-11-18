<?php

use Faker\Generator as Faker;

$factory->define(App\Instance::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'classification_id' => rand(1,22),
        'company_name' => $faker->company,
        'city_id' => rand(1,18),
        'percentage' => rand(1,100),
        'result' => $faker->realText($faker->numberBetween(30,50)),
        'long_description' => $faker->text,
        'year' => rand(2001,2018),
    ];
});
