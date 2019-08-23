<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CountryTableSeeder::class);

        $this->call(UserRolesTableSeeder::class);
//        $this->call(UsersTableSeeder::class);

//        $this->call(ClientTableSeeder::class);
//        $this->call(ContactTableSeeder::class);
//        $this->call(EmployeeTableSeeder::class);
//        $this->call(OrderTableSeeder::class);
//        $this->call(EmployeeOrderTableSeeder::class);

        $this->call(LocationTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(TemplateTableSeeder::class);
        $this->call(TextBlocksSeeder::class);
        $this->call(SalaryTableSeeder::class);
        $this->call(LegalTextsTableSeeder::class);
    }
}
