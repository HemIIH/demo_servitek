<?php

namespace App\Http\Requests\Client;

use App\Http\Requests\Request;

class ContactRequest extends Request
{

    public function rules()
    {
        return [
            // basics
            'first_name'         => 'required',
            'last_name'          => 'required',
            'sex'                => 'required|in:m,f',

            // responsibility
            'function'           => '',
            'personnel_planning' => 'in:1,0',
            'accounting'         => 'in:1,0',
            'other'              => 'in:1,0',

            // contacts
            'email'              => 'required|email',
            'phone'              => 'phone',
            'mobile'             => 'phone',
            'fax'                => 'phone',

            'information' => ''
        ];
    }

    public function store($client)
    {
        $client->contacts()->create($this->getData());
    }

    public function save($contact)
    {
        $contact->update($this->getData());
    }

    protected function getData()
    {
        $data = $this->only([
            // basics
            'sex',
            'first_name',
            'last_name',

            // responsibility
            'function',

            // contacts
            'email',
            'phone',
            'mobile',
            'fax',

            'information'
        ]);

        $data['personnel_planning'] = $this->get('personnel_planning', false);
        $data['accounting']         = $this->get('accounting', false);
        $data['other']              = $this->get('other', false);

        return $data;
    }
}
