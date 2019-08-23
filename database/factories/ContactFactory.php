<?php

$factory->define(App\Models\Client\Contact::class, function () {

    $faker = Faker\Factory::create('de_DE');

    $data = [
        'last_name'          => $faker->lastName,
        'phone'              => $faker->randomElement(['0221', '0211', '0228']) . $faker->numerify('######'),
        'email'              => $faker->companyEmail,
        'personnel_planning' => $faker->boolean(90),
        'accounting'         => $faker->boolean(50),
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