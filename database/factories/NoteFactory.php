<?php

$factory->define(App\Models\Note::class, function (Faker\Generator $faker) {

    return [
        'date'        => $faker->dateTimeBetween('-3 month', 'now'),
        'information' => $faker->text(),
        'editor'      => $faker->randomElement([1, 2])
    ];
});
