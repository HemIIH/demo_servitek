<?php

namespace App\Http\Controllers\Client\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\ContactRequest;
use App\Models\Client\Contact;

class ContactController extends Controller
{
    protected $client;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->client = auth()->user()->client;

            return $next($request);
        });
    }

    public function get()
    {
        return $this->client->contacts()->get();
    }

    /**
     * Store a contact to a client.
     *
     * @param ContactRequest $request
     */
    public function store(ContactRequest $request)
    {
        return $request->store($this->client);
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
}