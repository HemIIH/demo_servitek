<?php

namespace App\Http\Requests\Client;

use App\Http\Requests\Request;
use App\Models\Client\Client;

class InvoiceDataRequest extends Request
{

    public function rules()
    {
        return [
            'name'              => 'sometimes|required',

            // address
            'street'            => 'sometimes|required',
            'address_addition'  => '',
            'postal_code'       => 'sometimes|required|numeric',
            'city'              => 'sometimes|required',
            'country'           => 'sometimes|required',

            // invoice related
            'intro'             => 'sometimes|required',
            'outro'             => 'sometimes|required',
            'default_tax_rate'  => 'sometimes|required',
            'payment_period'    => 'sometimes|required|integer'
        ];
    }

    public function save(Client $client)
    {
        $client->invoiceData()->updateOrCreate(['client_id' => $client->id], $this->getData());
    }

    protected function getData()
    {
        $data = $this->only(
            'name',

            // address
            'street',
            'address_addition',
            'postal_code',
            'city',
            'country',

            // invoice related
            'intro',
            'outro',
            'default_tax_rate',
            'payment_period'
        );

        return $this->sanitizeData($data);
    }
}
