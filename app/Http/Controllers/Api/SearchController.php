<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Client\Client;
use App\Models\Employee\Employee;

class SearchController extends Controller
{
    /**
     * Search in employees and clients.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function perform()
    {
        $term = request('term');

        $employees = Employee::where('last_name', 'like', '%' . $term . '%')
                             ->orWhere('first_name', 'like', '%' . $term . '%')
                             ->get(['id', \DB::raw('CONCAT(first_name, " ", last_name) AS name, 1 as employee')]);

        $clients   = Client::where('name', 'like', '%' . $term . '%')
                            ->get(['id', 'name', \DB::raw('1 as client')]);

        return $employees->merge($clients);
    }
}
