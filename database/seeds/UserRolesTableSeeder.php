<?php

use Illuminate\Database\Seeder;

class UserRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'master_admin',
                'display_name' => 'Master Admin'
            ],
            [
                'name' => 'dispomanager',
                'display_name' => 'Dispo-Manager'
            ],
            [
                'name' => 'local_manager',
                'display_name' => 'Filialleiter'
            ],
            [
                'name' => 'accountant',
                'display_name' => 'Lohnbuchhalter'
            ]
        ];

        \App\Models\User\Role::insert($data);
    }
}
