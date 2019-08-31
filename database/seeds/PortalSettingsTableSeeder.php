<?php

use Illuminate\Database\Seeder;

class PortalSettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('portal_settings')->insert([
            ['expired_at' => null, 'last_renew' => null, 'status' => 'deactive']
        ]);
    }
}
