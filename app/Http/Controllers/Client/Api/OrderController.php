<?php

namespace App\Http\Controllers\Client\Api;

use App\Http\Controllers\Controller;
use App\Models\Order\Order;
use App\Notifications\OrderChanged;
use App\Notifications\OrderRequested;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $client;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->client = auth()->user()->client;

            return $next($request);
        });
    }

    public function request(Request $request)
    {
        $this->validate($request, [
            'title'      => 'required',
            'start_date' => 'required|date|date_format:"d.m.Y"',
            'end_date'   => 'date|date_format:"d.m.Y"|after_or_equal:start_date',
            'start_time' => 'required|time',
            'end_time'   => 'time',

            'work_location'  => 'required',
            'staff_required' => 'required|integer|min:1'
        ]);

        $order = Order::create([
            'client_id'       => $this->client->id,
            'title'           => request('title'),
            'status'          => 'requested',
            'start_date'      => request('start_date'),
            'end_date'        => request('end_date') ?: request('start_date'),
            'start_time'      => request('start_time'),
            'end_time'        => request('end_time'),
            'work_location'   => request('work_location'),
            'client_location' => $this->client->location,
            'staff_required'  => request('staff_required'),
            'meeting_time'    => request('start_time'),
            'requirements'    => request('requirements'),
            'requested_by'    => $this->client->id
        ]);

        $order->notify(new OrderRequested($order));
    }

    public function update(Request $request, Order $order)
    {
        $order->update([
            'status'         => 'requested',
            'start_time'     => request('start_time'),
            'end_time'       => request('end_time'),
            'staff_required' => request('staff_required'),
        ]);

        $order->notify(new OrderChanged($order));
    }

}