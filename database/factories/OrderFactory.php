<?php

$factory->define(App\Models\Order\Order::class, function () {

    $faker = Faker\Factory::create('de_DE');

    return [
        'title'           => $faker->text(10),
        'client_id'       => $faker->numberBetween(1, 20),
        'status'          => 'active',
        'start_date'      => $start = $faker->dateTimeBetween('-60 days', '+ 15 days')->format('d.m.Y'),
        'end_date'        => $start,
        'start_time'      => $faker->numberBetween(11, 18) . ':' . $faker->randomElement(['00', '15', '30', '45']),
        'work_location'   => $faker->city,
        'requirements'    => $faker->text(100),
        'client_location' => $faker->randomElement(['Bonn', 'Köln', 'Düsseldorf']),
        'meeting_point'   => $faker->streetName,
        'meeting_time'    => $faker->numberBetween(10, 16) . ':' . $faker->randomElement(['00', '15', '30', '45']),
        'staff_planned'   => 0,
        'staff_required'  => $faker->numberBetween(3, 5),

        'created_by' => $faker->randomElement([1, 2])
    ];
});