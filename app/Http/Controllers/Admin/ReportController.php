<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order\Order;

class ReportController extends Controller
{

    public function reports()
    {
        return view('admin.reports.index');
    }

    public function orders()
    {
        $orders = Order::active()
            ->whereYear('start_date', date('Y'))
            ->withCount(['employees' => function($query) {
                $query->approved();
            }])
            ->orderBy('start_date')
            ->get();

        $groupedOrders = $orders->groupBy(function($item) {
            return carbon($item->start_date)->format('W');
        });

        $ordersLastYear = Order::active()
            ->whereYear('start_date', date('Y') - 1)
            ->withCount(['employees' => function($query) {
                $query->approved();
            }])
            ->orderBy('start_date')
            ->get();

        $groupedOrdersLastYear = $ordersLastYear->groupBy(function($item) {
            return carbon($item->start_date)->format('W');
        });

        return view('admin.reports.orders', compact(
            'orders',
            'groupedOrders',
            'ordersLastYear',
            'groupedOrdersLastYear'
        ));
    }

    public function employees()
    {
        return view('admin.reports.employees');
    }

}
