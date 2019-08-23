<?php

namespace App\Http\Requests\Client\Invoice;

use App\Http\Requests\Request;
use App\Models\Order\Order;

class InvoiceRequest extends Request
{
    public function rules()
    {
        return [
            'client'                     => 'required',

            // address
            'invoiceData.name'           => 'required',
            'invoiceData.street'         => 'required',
            'invoiceData.postal_code'    => 'required',
            'invoiceData.city'           => 'required',
            'invoiceData.country'        => 'required',

            // invoice related
            'contacts'                   => 'required',
            'invoiceData.intro'          => 'required',
            'invoiceData.outro'          => 'required',
            'invoiceData.payment_period' => 'required',

            // items
            'items'                      => 'required',
            'items.*.service'            => 'required',
            'items.*.start'              => 'required|date|date_format:"d.m.Y"',
            'items.*.tax_rate'           => 'integer',
            'items.*.discount'           => 'integer',
            'items.*.unit'               => 'required',
            'items.*.quantity'           => 'required|decimal',
            'items.*.price'              => 'required|decimal',
        ];
    }

    public function store($client)
    {
       if ($this->checkForBilledOrders())
            return false;

        $invoice = $this->createInvoice($client);

        $this->createInvoiceItems($invoice);

        if ($this->get('contacts')) {
            $invoice->contacts()->sync($this->get('contacts'), true);
        }

        return $invoice;
    }

    protected function createInvoice($client)
    {
        $invoiceData = $this->get('invoiceData');

        return $client->invoices()->create([
            'name'           => $invoiceData['name'],
            'street'         => $invoiceData['street'],
            'postal_code'    => $invoiceData['postal_code'],
            'city'           => $invoiceData['city'],
            'country'        => $invoiceData['country'],
            'invoice_date'   => now(),
            'payment_period' => $invoiceData['payment_period'],
            'intro'          => $invoiceData['intro'],
            'outro'          => $invoiceData['outro']
        ]);
    }

    protected function createInvoiceItems($invoice)
    {
        $total = 0;
        
        foreach ($this->get('items') as $item) {

            if ($item['deleted'] == 1) {
                continue;
            }

            $data = [
                'order_id'   => $item['id'],
                'type'       => $item['type'],
                'start_date' => toSql($item['start']),
                'end_date'   => $item['end'] ? toSql($item['end']) : toSql($item['start']),
                'service'    => $item['service'],
                'quantity'   => convert($item['quantity']),
                'unit'       => $item['unit'],
                'price'      => convert($item['price']),
                'tax_rate'   => $item['tax_rate'],
                'discount'   => $item['discount'],
                'sum'        => $this->calculateSum($item)
            ];

            $invoice->items()->create($data);

            $total += $data['sum'];
        }

        Order::whereIn('id', $invoice->items()->pluck('order_id'))->update([
            'billed' => 1
        ]);

        $invoice->update(['sum' => $total]);
    }

    /**
     * @param $data
     * @return mixed
     */
    protected function calculateSum($data)
    {
        $discount = (1 - $data['discount'] / 100);
        $taxRate  = (1 + $data['tax_rate'] / 100);

        return convert($data['quantity']) * convert($data['price']) * $discount * $taxRate;
    }

    protected function checkForBilledOrders()
    {
        $billedOrders = Order::whereIn('id', collect($this->get('items'))->pluck('id'))
                            ->where('billed', 1)
                            ->count();

        return $billedOrders;
    }
}
