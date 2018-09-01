<?php

use Faker\Generator as Faker;

$factory->define(App\Question::class, function (Faker $faker) {
    return [
        'question' => $faker->sentence(15),
        'question_type_id' => '1',
        'survey_id' => '1'
    ];
});
