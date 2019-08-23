<?php

$factory->define(App\Models\Client\Client::class, function () {

    $faker = Faker\Factory::create('de_DE');

    return [
        'name'        => $company = $faker->company,
        'short_name'  => $company,
        'street'      => $faker->streetName . ' ' . $faker->numberBetween(1, 250),
        'postal_code' => $faker->postcode,
        'city'        => $faker->city,
        'country'     => 'Deutschland',
        'location'    => $faker->randomElement(['Bonn', 'Köln', 'Düsseldorf']),

        'iban' => $faker->iban('de'),
        'bic'  => $faker->swiftBicNumber,
        'vat'  => $faker->numerify('######'),

        'active' => $faker->boolean(80),
    ];
});


$factory->define(App\Models\Client\ChargeRate::class, function (Faker\Generator $faker) {
    $data = [
        'amount'     => $faker->randomElement([20, 22, 24]),
        'valid_from' => carbon('2017-10-1')->format('d.m.Y'),
        'editor'     => 1
    ];

    return $data;
});

$factory->define(App\Models\Client\InvoiceData::class, function () {

    $faker = Faker\Factory::create('de_DE');

    $data = [
        'name'             => $faker->company,
        'street'           => $faker->streetName . ' ' . $faker->numberBetween(1, 250),
        'address_addition' => $faker->text(20),
        'postal_code'      => $faker->postcode,
        'city'             => $faker->city,
        'country'          => 'Deutschland',
        'intro'            => $faker->text(),
        'outro'            => $faker->text(),
        'payment_period'   => 14,
    ];

    return $data;
});
