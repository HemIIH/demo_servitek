<?php

namespace App\Http\Controllers\Employee\Api;

use App\Http\Controllers\Controller;
use App\Models\Order\Order;

class OrderController extends Controller
{
    protected $employee;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->employee = auth()->user()->employee;

            return $next($request);
        });
    }

    public function requestedOrders()
    {
        return $this->employee->orders('asc')
            ->requested()
            ->where('start_date', '>', now())
            ->with('client')
            ->get();
    }

    public function accept(Order $order)
    {
        $this->employee->orders()->updateExistingPivot($order->id, [
            'employee_available'     => now(),
            'employee_not_available' => null
        ]);
    }

    public function deny(Order $order)
    {
        $this->employee->orders()->updateExistingPivot($order->id, [
            'employee_available'     => null,
            'employee_not_available' => now()
        ]);
    }

    public function withdraw(Order $order)
    {
        $this->employee->orders()->updateExistingPivot($order->id, [
            'employee_available'     => null,
            'employee_not_available' => null
        ]);
    }

}