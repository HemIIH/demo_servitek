<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Requests\Client\ChargeRate\CreateChargeRateRequest;
use App\Http\Requests\Client\ChargeRate\UpdateChargeRateRequest;
use App\Models\Client\ChargeRate;
use App\Models\Client\Client;
use App\Http\Controllers\Controller;

class RateController extends Controller
{

    /**
     * Get all entries from the rates table for a client.
     *
     * @param Client $client
     * @return mixed
     */
    public function all(Client $client)
    {
        return $client->rates()->get();
    }

    /**
     * Get specific rate for a client.
     *
     * @param Client $client
     * @param ChargeRate $rate
     * @return mixed
     */
    public function get(Client $client, $rate)
    {
        return $rate;
    }

    /**
     * Add an entry in the extra business table.
     *
     * @param CreateChargeRateRequest $request
     * @param Client $client
     */
    public function add(CreateChargeRateRequest $request, Client $client)
    {
        $request->store($client);
    }

    /**
     * Update an entry in the charge rates table.
     *
     * @param UpdateChargeRateRequest $request
     * @param Client $client
     * @param ChargeRate $rate
     */
    public function update(UpdateChargeRateRequest $request, Client $client, ChargeRate $rate)
    {
        $request->save($client, $rate);
    }

    /**
     * Delete an entry in the charge rates table.
     *
     * @param Client $client
     * @param ChargeRate $rate
     */
    public function delete(Client $client, ChargeRate $rate)
    {
        $latestRate = $client->rates()->latest('valid_from')->first();

        if ($latestRate->id != $rate->id) {
            return;
        }

        $rate->delete();

        if ($client->rates()->count()) {
            $client->rates()->latest('valid_from')->first()->update([
                'valid_to' => null
            ]);
        }
    }
}
