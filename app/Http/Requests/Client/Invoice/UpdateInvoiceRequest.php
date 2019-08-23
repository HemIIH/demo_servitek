<?php

namespace App\Http\Requests\Client\Invoice;

use App\Http\Requests\Request;

class UpdateInvoiceRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

            // address
            'name'          => 'required',
            'street'        => 'required',
            'postal_code'   => 'required',
            'city'          => 'required',
            'country'       => 'required',

            'intro'         => 'required',
            'outro'         => 'required',

            // invoice items
            'service.*'     => 'required',
            'start_date.*'  => 'sometimes|required|date|date_format:"d.m.Y"',
            'tax_rate:*'    => 'integer',
            'discount.*'    => 'integer',
            'unit.*'        => 'sometimes|required',
            'quantity.*'    => 'sometimes|required|decimal',
            'price.*'       => 'sometimes|required|decimal',
        ];
    }

    public function save($invoice)
    {
        $total = 0;

        foreach ($invoice->items as $item) {

            $id = $item->id;

            $data = [
                'tax_rate' => $this->input('tax_rate.' . $id),
                'discount' => $this->input('discount.' . $id),
                'price'    => convert($this->input('price.' . $id))
            ];

            if ($this->filled('quantity.' . $id, 'price.' . $id, 'unit.' . $id) && ! $item['order_id']) {
                $data['service']    = $this->input('service.' . $id);
                $data['start_date'] = toSql($this->input('start_date.' . $id));
                $data['end_date']   = $data['start_date'];
                $data['quantity']   = convert($this->input('quantity.' . $id));
                $data['unit']       = $this->input('unit.' . $id);
                $data['sum']        = $data['quantity'] * $data['price'] * (1 - $data['discount'] / 100) * (1 + $data['tax_rate'] / 100);
            } else if ($item['order_id']) {
                $data['sum']        = $item->quantity * $data['price'] * (1 - $data['discount'] / 100) * (1 + $data['tax_rate'] / 100);
            } else {
                exit;
            }

            $total += $data['sum'];

            $item->update($data);
        }

        $invoice->update([
            'name'        => $this->get('name'),
            'street'      => $this->get('street'),
            'postal_code' => $this->get('postal_code'),
            'city'        => $this->get('city'),
            'country'     => $this->get('country'),
            'intro'       => $this->get('intro'),
            'outro'       => $this->get('outro'),
            'sum'         => $total
        ]);

        if ($this->has('contacts')) {
            $invoice->contacts()->sync($this->get('contacts'));
        }
    }
}
