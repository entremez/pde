<?php

use Faker\Generator as Faker;
use App\Company;

$factory->define(Company::class, function (Faker $faker) {
    return [
        'rut' => $faker->numberBetween($min = 20000000, $max = 30000000),
        'dv_rut' => $faker->randomDigit,
        'name' => $faker->company.' '.$faker->companySuffix,
        'address' => $faker->address,
        'phone' => $faker->e164PhoneNumber
    ];
});
