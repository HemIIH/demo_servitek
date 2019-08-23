<?php

namespace App\Http\Controllers\Admin\Order;

use App\Models\Client\Client;
use App\Models\Order\Order;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    /**
     * Show all orders.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $data['clients'] = Client::orderBy('name')->get();

        return view('admin.orders.list', $data);
    }

    /**
     * Show single order.
     *
     * @param Order $order
     * @return \Illuminate\View\View
     */
    public function show(Order $order)
    {
        return view('admin.orders.show')
            ->with('order', $order->load('client', 'contacts', 'employees', 'parent', 'children', 'user'));
    }

}
