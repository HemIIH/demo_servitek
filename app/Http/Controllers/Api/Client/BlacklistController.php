<?php

namespace App\Http\Controllers\Api\Client;

use App\Models\Client\Client;
use App\Models\Employee\Employee;
use App\Http\Controllers\Controller;

class BlacklistController extends Controller
{

    /**
     * Get (un)blocked employees.
     *
     * @param Client $client
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAll(Client $client)
    {
        $blocked_employees = $client->blockedEmployees;
        $employees = Employee::whereNotIn('id', $blocked_employees->pluck('id'))
            ->orderBy('last_name', 'asc')
            ->get(['id', 'first_name', 'last_name']);

        return response()
            ->json([
                'employees' => $employees,
                'blocked'   => $blocked_employees
            ]);
    }

    /**
     * Attach employee to client's blacklist.
     *
     * @param Client $client
     */
    public function addTo(Client $client)
    {
        if ($client->blockedEmployees->contains(request('employee'))) {
            return;
        }

        $client->blockedEmployees()->attach(request('employee'));
    }

    /**
     * Remove employee from client's blacklist.
     *
     * @param Client $client
     */
    public function removeFrom(Client $client)
    {
        $client->blockedEmployees()->detach(request('employee'));
    }
}
