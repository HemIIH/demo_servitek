<?php

namespace App\Http\Requests\Textblock;

use App\Http\Requests\Request;

class GeneralRequest extends Request
{

    public function rules()
    {
        return [
            'company_name' => 'required',

            // address
            'street'       => 'required',
            'postal_code'  => 'required|numeric',
            'city'         => 'required',

            // contacts
            'email'        => 'required|email',
            'phone'        => 'required|phone',
            'fax'          => 'required',
            'website'      => 'required',

            // bank account
            'iban'         => 'required|alpha_num',
            'bic'          => 'required',
            'institute'    => 'required',
        ];
    }


    /**
     * Persist data.
     */
    public function save()
    {
        $data = $this->only([
            'company_name',

            // address
            'street',
            'postal_code',
            'city',

            // contacts
            'email',
            'phone',
            'fax',
            'website',

            // bank account
            'iban',
            'bic',
            'institute'
        ]);

        collect($data)->each(function($value, $key) {
            \DB::table('textblocks')
                ->where('name', $key)
                ->update([
                    'value' => $value
                ]);
        });
    }
}
