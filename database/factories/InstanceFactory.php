<?php

use Faker\Generator as Faker;

$factory->define(App\Instance::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'classification_id' => rand(1,22),
        'company_name' => $faker->company,
        'description' => "de aumento en la productividad...",
        'long_description' => $faker->text,
    ];
});
