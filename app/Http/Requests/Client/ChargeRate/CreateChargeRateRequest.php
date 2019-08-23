<?php

namespace App\Http\Requests\Client\ChargeRate;

use App\Http\Requests\Request;

class CreateChargeRateRequest extends Request
{
    public function rules()
    {
        return [
            'amount'     => 'required|decimal',
            'valid_from' => 'required|date|date_format:"d.m.Y"',
        ];
    }

    public function conditionalRules()
    {
        $client = $this->route('client');

        $latestRate = $client->rates()->latest('valid_from')->first();

        if ($latestRate) {

            $this->conditionalRules[] = [
                'fields'   => 'valid_from',
                'rules'    => '|after:' . \Date::format($latestRate->valid_from),
            ];
        }

        return $this->conditionalRules;
    }

    public function store($client)
    {
        $this->updatePreviousRate($client);

        $client->rates()->create($this->only([
            'valid_from',
            'amount'
        ]));
    }

    /**
     * Update 'valid_to' from previous rate.
     *
     * @param $client
     */
    protected function updatePreviousRate($client)
    {
        if ($client->rates()->exists()) {
            $latestRate = $client->rates()->latest('valid_from')->first();

            $latestRate->update([
                'valid_to' => carbon($this->get('valid_from'))->subDay()->format('d.m.Y')
            ]);
        }
    }

}
