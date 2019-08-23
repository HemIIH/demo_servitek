<?php

namespace App\Http\Requests\Client\ChargeRate;

use App\Http\Requests\Request;

class UpdateChargeRateRequest extends Request
{
    public function rules()
    {
        return [
            'amount'     => 'required|decimal',
            'valid_from' => 'required|date|date_format:"d.m.Y"',
            'valid_to'   => 'date|date_format:"d.m.Y"|after:valid_from'
        ];
    }

    public function conditionalRules()
    {
        $client = $this->route('client');
        $rate   = $this->route('rate');

        $rates = $client->rates()->latest('valid_from')->get();

        if ($rates->first()->id != $rate->id) {
            $nextRate = $this->getNextRate($rates, $rate);

            $this->conditionalRules[] = [
                'fields'   => 'valid_to',
                'rules'    => '|before:' . \Date::format($nextRate->valid_from),
                'callback' => evaluate($nextRate->valid_to)
            ];
        }

        if ($rates->last()->id != $rate->id) {
            $prevRate = $this->getPrevRate($rates, $rate);

            $this->conditionalRules[] = [
                'fields'   => 'valid_from',
                'rules'    => '|after:' . \Date::format($prevRate->valid_from),
            ];
        }

        return $this->conditionalRules;
    }

    public function save($client, $rate)
    {
        $this->updateRates($client);

        $rate->update($this->only([
            'valid_from',
            'valid_to',
            'amount'
        ]));
    }

    /**
     * Update 'valid_to' from previous rate.
     *
     * @param $client
     */
    protected function updateRates($client)
    {
        $rate = $this->route('rate');

        $rates = $client->rates()->latest('valid_from')->get();

        if ($rates->first()->id != $rate->id) {
            $nextRate = $this->getNextRate($rates, $rate);

            $nextRate->update([
                'valid_from' => carbon($this->get('valid_to'))->addDay()->format('d.m.Y')
            ]);
        }

        if ($rates->last()->id != $rate->id) {
            $prevRate = $this->getPrevRate($rates, $rate);

            $prevRate->update([
                'valid_to' => carbon($this->get('valid_from'))->subDay()->format('d.m.Y')
            ]);
        }
    }

    /**
     * @param $rates
     * @param $rate
     * @return mixed
     */
    protected function getNextRate($rates, $rate)
    {
        return $rates->where('valid_from', '=', carbon($rate->valid_to)->addDay()->format('Y-m-d'))->first();
    }

    /**
     * @param $rates
     * @param $rate
     * @return mixed
     */
    protected function getPrevRate($rates, $rate)
    {
        return $rates->where('valid_to', '=', carbon($rate->valid_from)->subDay()->format('Y-m-d'))->first();
    }
}
