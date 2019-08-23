<?php

use Illuminate\Database\Seeder;

class CountryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries = json_decode(file_get_contents('resources/data/countries.json'), true);

        foreach ($countries as $code => $name) {
            DB::table('countries')->insert([
                'code' => $code,
                'name' => $name,
            ]);
        }
    }
}
