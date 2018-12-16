<?php

use Faker\Generator as Faker;

$factory->define(App\Provider::class, function (Faker $faker) {
    return [
        'rut' => $faker->numberBetween($min = 20000000, $max = 30000000),
        'dv_rut' => $faker->randomDigit,
        'city_id' => rand(1,18),
        'name' => $faker->company,
        'address' => $faker->address,
        'web' => $faker->domainName,
        'logo' => 'https://picsum.photos/280/280?image='.rand(0,1084),
        'phone' => $faker->e164PhoneNumber,
        'description' => $faker->sentence(10),
        'long_description' => $faker->text,
        'approved' => $faker->boolean,
    ];
});
