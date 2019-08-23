<?php

namespace App\Http\Controllers\Admin\Order;

use App\Events\TimetrackingUpdated;
use App\Models\Client\Client;
use App\Models\Order\Order;
use App\Models\Order\Timetracking;
use App\Http\Requests\Timetracking\TimetrackingRequest;

use App\Http\Controllers\Controller;

class TimeTrackingController extends Controller
{
    /**
     * Show overview of all orders with timetrackings.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $data['clients'] =  Client::orderBy('name')->get();

        return view('admin.timetracking.list', $data);
    }

    /**
     * Show timetrackings for an order.
     *
     * @param Order $order
     * @return \Illuminate\View\View
     */
    public function show(Order $order)
    {
        Timetracking::updateEntries($order);

        $data['timetrackings'] = $order->timetrackings()->with(['employee', 'employee.wages'])->get();

        return view('admin.orders.timetracking', $data)
            ->with('order', $order);
    }

    /**
     * Store timetrackings for an order.
     *
     * @param TimetrackingRequest $request
     * @param Order $order
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(TimetrackingRequest $request, Order $order)
    {
        if ($order->end_date > now()->format('Y-m-d') || $order->status == 'canceled') {
            error('timetracking');

            return redirect()->back();
        }

        $request->save($order);

        success('timetracking');

        event(new TimetrackingUpdated($order));

        return redirect()->back();
    }
}
