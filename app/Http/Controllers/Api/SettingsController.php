<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    /**
     * Get data from config/settings.
     *
     * @return mixed
     */
    public function get()
    {
        return config('settings.' . request('name'));
    }

    /**
     * Get data from the locations table.
     *
     * @return mixed
     */
    public function locations()
    {
        return \DB::table('locations')->get();
    }
}
