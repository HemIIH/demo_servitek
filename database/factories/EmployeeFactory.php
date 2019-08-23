<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Employee\Employee::class, function () {

    $faker = \Faker\Factory::create('de_DE');

    $data = [
        'last_name' => $faker->lastName,

        'date_of_birth' => \Carbon\Carbon::instance($faker->dateTimeBetween('-50 years', '-20 years'))->format('d.m.Y'),
        'nationality'   => 'Deutschland',

        // address
        'street'      => $faker->streetAddress,
        'postal_code' => $faker->postcode,
        'city'        => $faker->city,

        'locations'   => json_encode($faker->randomElements(['Bonn', 'Köln', 'Düsseldorf'], 2)),

        // contacts
        'email'  => $faker->safeEmail,
        'phone'  => $faker->randomElement(['0221', '0211', '0228']) . $faker->numerify('######'),
        'mobile' => $faker->randomElement(['0176', '0151', '0170']) . $faker->numerify('#######'),

        'type_of_health_insurance' => $faker->randomElement(['Gesetzlich', 'Privat']),
        'social_security_number'   => $faker->numerify('DE#########'),
        'tax_id'                   => $faker->numerify('######/####'),
        'tax_class'                => $faker->randomDigit,

        'iban' => $faker->iban('DE'),
        'bic'  => $faker->swiftBicNumber,

        'active'                    => $faker->boolean(80),
        'occupation_type'           => $faker->randomElement(['part_time', 'temporary']),
        'entry_date'                => carbon('2017-07-' . $faker->randomElement([1, 10]))->format('d.m.Y'),
        'contractual_working_hours' => $faker->randomElement([20, 40, 60, 80, 100]),

        'car'                   => $faker->boolean(40),
        'driving_license'       => $faker->boolean(80),
        'public_transportation' => $faker->boolean(70),
    ];

    if ($faker->randomElement(['m', 'f']) == 'm') {
        $data['sex'] = 'm';
        $data['first_name'] = $faker->firstNameMale;
    } else {
        $data['sex'] = 'f';
        $data['first_name'] = $faker->firstNameFemale;
    };

    return $data;
});

$factory->define(App\Models\Employee\Wage::class, function (Faker $faker) {

    $data = [
        'amount'     => $faker->randomElement([10, 11, 12]),
        'valid_from' => carbon('2017-10-1')->format('d.m.Y'),
        'editor'     => 1
    ];

    return $data;
});

$factory->define(App\Models\Employee\WorkingHours::class, function (Faker $faker) {

    $data = [
        'hours'      => $faker->randomElement([20, 40, 60, 80, 100]),
        'valid_from' => carbon('2017-10-1')->format('d.m.Y'),
        'editor'     => 1
    ];

    return $data;
});