<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Requests\Client\ContactRequest;
use App\Models\Client\Client;
use App\Http\Controllers\Controller;
use App\Models\Client\Contact;

class ContactController extends Controller
{
    /**
     * Get all contacts for a client.
     *
     * @param Client $client
     * @return mixed
     */
    public function getAll(Client $client)
    {
        return $client->contacts()
            ->when(request()->filled('type'), function ($query) {
                $query->where(request('type'), 1);
            })
            ->get();
    }

    /**
     * Store a contact to a client.
     *
     * @param ContactRequest $request
     * @param Client $client
     */
    public function store(ContactRequest $request, Client $client)
    {
        return $request->store($client);
    }

    /**
     * Update a contact.
     *
     * @param ContactRequest $request
     * @param Contact $contact
     */
    public function update(ContactRequest $request, Contact $contact)
    {
        return $request->save($contact);
    }


    /**
     * Update responsibilites for passed contacts.
     *
     * @param Client $client
     */
    public function updateResponsibilities(Client $client)
    {
        foreach (request('contacts') as $contact) {
            $data = [
                'personnel_planning' => (bool)$contact['personnel_planning'],
                'accounting'         => (bool)$contact['accounting'],
                'other'              => (bool)$contact['other']
            ];

            $client->contacts()->where('id', $contact['id'])->update($data);
        }
    }

    /**
     * Delete a contact.
     *
     * @param Contact $contact
     */
    public function delete(Contact $contact)
    {
        $contact->delete();
    }
}
