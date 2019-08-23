<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Client\Invoice\InvoiceRequest;
use App\Models\Client\Client;
use App\Models\Client\Invoice;
use App\Http\Controllers\Controller;
use App\Models\Client\InvoiceItem;
use App\Models\Order\Order;

class InvoiceController extends Controller
{

    /**
     * Get data for list view.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getData()
    {
        return Invoice::with('client')
            ->search()
            ->paginateAndOrder();
    }

    /**
     * Create Invoice
     *
     * @param InvoiceRequest $request
     * @param Client $client
     * @throws \Exception
     */
    public function create(InvoiceRequest $request, Client $client)
    {
        if (! $request->store($client)) {
            throw new \Exception;
        }
    }

    /**
     * Get all clients with billable orders.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getClients()
    {
        return $clients = Client::whereHas('orders', function ($query) {
            $query->where('time_recorded', 1)
                  ->where('billed', '!=', 1)
                  ->active();
        })->orderBy('name', 'asc')->get(['id', 'name']);
    }

    /**
     * Get all billable orders for a single client.
     *
     * @param Client $client
     * @return mixed
     */
    public function getOrders(Client $client)
    {
        return $client->orders()
            ->where('time_recorded', 1)
            ->where('billed', '!=', 1)
            ->active()
            ->get();
    }

    /**
     * Mark invoice as paid.
     *
     * @param Invoice $invoice
     */
    public function markAsPaid(Invoice $invoice)
    {
        $invoice->update([
            'pay_date' => toSql(request('pay_date'))
        ]);
    }

    /**
     * Mark invoice as unpaid.
     *
     * @param Invoice $invoice
     */
    public function markAsUnpaid(Invoice $invoice)
    {
        $invoice->update([
            'pay_date' => null
        ]);
    }

    /**
     * Archive invoice.
     *
     * @param Invoice $invoice
     */
    public function archive(Invoice $invoice)
    {
        $invoice->update([
            'archived' => 1
        ]);
    }

    /**
     * Archive invoice.
     *
     * @param Invoice $invoice
     */
    public function unArchive(Invoice $invoice)
    {
        $invoice->update([
            'archived' => null
        ]);
    }

    /**
     * Delete invoice.
     *
     * @param Invoice $invoice
     */
    public function delete(Invoice $invoice)
    {
        Order::whereIn('id', $invoice->items->pluck('order_id'))
            ->update(['billed' => 0]);

        $invoice->items()->delete();
        $invoice->delete();
    }

    /**
     * @param Invoice $invoice
     * @param InvoiceItem $item
     * @return bool|string
     */
    public function deleteItem(Invoice $invoice, InvoiceItem $item)
    {
        if (! $invoice->contains($item))
            return false;

        $item->delete();

        if ($item->type == 'order') {
            $item->order->update(['billed' => 0]);
        }

        if (count($invoice->items) == 1) {
            $invoice->delete();

            return;
        }

        $invoice->update([
            'sum' => $invoice->items()->where('id', '!=', $item->id)->pluck('sum')->sum()
        ]);
    }
}
