<?php

namespace App\Http\Requests\Client;

use App\Http\Requests\HandleImage;

use App\Http\Requests\Request;
use App\Models\Client\Client;

class ClientRequest extends Request
{
    use HandleImage;

    public function rules()
    {
        return [
            // basics
            'name'             => 'sometimes|required',
            'short_name'       => 'sometimes|required',

            'logo'             => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2000',

            // work related
            'location'         => 'sometimes|required',
            'active'           => 'sometimes|required|boolean',
            'type_of_contract' => 'sometimes|required',

            // address
            'street'           => 'sometimes|required',
            'postal_code'      => 'sometimes|required|numeric',
            'city'             => 'sometimes|required',

            // bank account
            'iban'             => 'alpha_num',
            'bic'              => 'alpha_num',
            'vat'              => 'alpha_num',
            'rate'             => 'sometimes|required|decimal'
        ];
    }

    public function conditionalRules()
    {
        $client = $this->route('client');

        return [
            [
                'fields' => 'name',
                'rules'  => '|unique:clients,name,' . ($client ? $client->id : '')
            ],
            [
                'fields' => 'short_name',
                'rules'  => '|unique:clients,short_name,' . ($client ? $client->id : '')
            ]
        ];
    }

    public function store()
    {
        $data = $this->getData();

        if ($this->hasFile('logo')) {
            $filename = $this->processImage($this->file('logo'));

            $data['logo'] = $filename;
        }

        $client = Client::create($data);

        $this->addChargeRate($client);

        return $client;
    }

    public function save($client)
    {
        $data = $this->getData();

        $client->update($data);

        return $client;
    }

    public function upload($client)
    {
        if (! $this->hasFile('logo'))
            return;

        $filename = $this->processImage($this->file('logo'));

        $client->update([
            'logo' => $filename
        ]);

        return $filename;
    }

    protected function processImage($image)
    {
        $filename = $this->createFilename($image);

        $this->uploadImage($image, 120, 120, 'uploads/images/logos/' . $filename);

        return $filename;
    }

    protected function addChargeRate($client)
    {
        $client->rates()->create([
            'valid_from' => now()->startOfMonth()->format('d.m.Y'),
            'amount'     => $this->get('rate')
        ]);
    }

    /**
     * @return array
     */
    protected function getData()
    {
        $data = $this->only([
            // basics
            'name',
            'short_name',

            // work related
            'type_of_contract',
            'active',
            'location',

            // address
            'street',
            'postal_code',
            'city',

            // bank account
            'iban',
            'bic',
            'vat'
        ]);

        return $this->sanitizeData($data);
    }
}
