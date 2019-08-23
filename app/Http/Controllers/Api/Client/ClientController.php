<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Requests\Client\ClientRequest;
use App\Http\Requests\Client\InvoiceDataRequest;
use App\Models\Client\Client;
use App\Http\Controllers\Controller;
use App\Services\Helper\HasNotes;

class ClientController extends Controller
{
    use HasNotes;

    /**
     * Get data for list view.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getData()
    {
        return Client::search()->paginateAndOrder();
    }

    /**
     * Get all clients.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getAll()
    {
        return Client::orderBy('name')->get();
    }

    /**
     * Get single client with invoice related data.
     *
     * @param Client $client
     * @return Client $client
     */
    public function get(Client $client)
    {
        return $client->load(['invoiceData', 'user']);
    }

    /**
     * Store new client.
     *
     * @param ClientRequest $request
     */
    public function store(ClientRequest $request)
    {
        $request->store();
    }

    /**
     * Update client's data.
     *
     * @param ClientRequest $request
     * @param $client
     */
    public function update(ClientRequest $request, $client)
    {
        $client = $request->save($client);

        return $client;
    }

    /**
     * Update client's invoice data.
     *
     * @param InvoiceDataRequest $request
     * @param $client
     */
    public function updateInvoiceData(InvoiceDataRequest $request, Client $client)
    {
        $request->save($client);
    }

    /**
     * Delete an client.
     *
     * @param Client $client
     * @throws \Exception
     */
    public function delete(Client $client)
    {
        if ($client->orders()->exists())
            throw new \Exception();

        $client->delete();
    }

    /**
     * Upload client logo.
     *
     * @param ClientRequest $request
     * @param Client $client
     */
    public function uploadLogo(ClientRequest $request, Client $client)
    {
        $this->validate(request(), ['logo' => ['required', 'image', 'max:2000']]);

        $request->upload($client);
    }

    /**
     * Delete client logo.
     *
     * @param Client $client
     */
    public function deleteLogo(Client $client)
    {
        \File::delete('uploads/images/logos/' . $client->logo);

        $client->update([
            'logo' => null
        ]);
    }

    /**
     * Get info about the latest order.
     *
     * @param Client $client
     * @return mixed
     */
    public function latestOrder(Client $client)
    {
        return $client->orders()->latest()->first();
    }

}
