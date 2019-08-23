<?php

namespace App\Http\Requests\Order;

use App\Http\Requests\Request;
use App\Models\Order\Order;
use App\Models\Client\Client;

class OrderRequest extends Request
{
    public function rules()
    {
        return [
            'client_id'      => 'required|integer',

            // contacts
            'contacts'       => 'required',
            'contacts.*'     => 'required|integer',

            // basics
            'title'          => 'required',
            'start_date'     => 'required|date|date_format:"d.m.Y"',
            'end_date'       => 'date|date_format:"d.m.Y"|after_or_equal:start_date',
            'start_time'     => 'required|time',
            'end_time'       => 'time',

            'work_location'  => 'required',
            'staff_required' => 'required|integer|min:1',
            'meeting_point'  => 'required',
            'meeting_time'   => 'required|time',
            'requirements'   => 'required',
        ];
    }

    public function store()
    {
        $data = $this->getData();

        if ($this->has('parent_id')) {
            Order::find($this->get('parent_id'))->update(['is_parent' => 1]);

            $data['parent_id'] = $this->get('parent_id');
        }

        $order = Order::create($data);

        $this->storeContacts($order);
    }

    public function save($order)
    {
        $order->update($this->getData());

        $this->storeContacts($order);
    }

    protected function getData()
    {
        $data = $this->only([
            'title',
            'client_id',
            'start_date',
            'start_time',
            'work_location',
//            'public',
            'staff_required',
            'meeting_point',
            'meeting_time',
            'requirements',
        ]);

        $data['end_date'] = $this->get('end_date') ?: $this->get('start_date');
        $data['client_location'] = Client::find($this->get('client_id'))->location;

        if ($this->route('order')) {
            $data['edited_by'] = $this->user()->id;
            $data['important_change'] = json_encode($this->get('changes'));
        } else {
            $data['created_by'] = $this->user()->id;
        }

        return $data;
    }

    protected function storeContacts($order)
    {
        if ($contacts = $this->get('contacts')) {
            $order->contacts()->sync($contacts);
        }
    }

}