<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $u = factory(App\Models\User\User::class)->create([
            'name'     => 'servite24',
            'email'    => 'servite@servite.de',
            'cc_email' => 'pmonfared@servite.de',
            'password' => Hash::make('servite24'),
            'type'     => 'internal']);
        $u->roles()->attach(\App\Models\User\Role::find(1));

        /*$u = factory(App\Models\User\User::class)->create([
            'name'     => 'Georg Hüwel',
            'email'    => 'ghuewel@servite.de',
            'cc_email' => 'pmonfared@servite.de',
            'type'     => 'internal']);
        $u->roles()->attach(\App\Models\User\Role::find(1));*/
    }
}
