<?php

namespace App\Http\Controllers\Api;

use App\Events\StaffUpdatedForOrder;
use App\Http\Requests\Order\CalculationRequest;
use App\Http\Requests\Order\OrderRequest;

use App\Models\Employee\Employee;
use App\Models\Employee\Timeoff;
use App\Models\Notifications;
use App\Models\Order\Order;
use App\Services\Helper\HasNotes;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    use HasNotes;

    /**
     * Get data for list view.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getData()
    {
        return Order::with('client', 'contacts')
            ->search()
            ->paginateAndOrder();
    }

    /**
     * Get single order.
     *
     * @param $order
     * @return mixed
     */
    public function get($order)
    {
        return $order->load('client', 'contacts', 'employees', 'parent', 'children', 'user', 'calculation');
    }

    /**
     * Store a new order.
     *
     * @param OrderRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(OrderRequest $request)
    {
        $request->store();

        return response('Order Created', 201);
    }

    /**
     * Update an order.
     *
     * @param OrderRequest $request
     * @param Order $order
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(OrderRequest $request, Order $order)
    {
        $request->save($order);

        return response('Order Updated', 201);
    }

    /**
     * Approve an order.
     *
     * @param OrderRequest $request
     * @param Order $order
     * @return \Illuminate\Http\RedirectResponse
     */
    public function approve(OrderRequest $request, Order $order)
    {
        $order->update([
            'status' => 'active'
        ]);

        $request->save($order);

        Notifications::dismiss('Order', $order->id);

        return response('Order Updated', 201);
    }

    /**
     * Cancel an order.
     *
     * @param Order $order
     */
    public function cancel(Order $order)
    {
        $order->update(['status' => 'canceled']);
    }

    /**
     * Activate an order.
     *
     * @param Order $order
     */
    public function activate(Order $order)
    {
        $order->update(['status' => 'active']);
    }

    /**
     * Get all employees assigned to an order.
     *
     * @param Order $order
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAssignedEmployees(Order $order)
    {
        return $order->employees()->with('roles')->get();
    }

    /**
     * Get all "available" employees for an order.
     *
     * @param Order $order
     * @return mixed
     */
    public function getAvailableEmployees(Order $order)
    {
        $orders = Order::active()
                    ->where(function ($query) use ($order) {
                        $query->whereBetween('start_date', [$order->start_date, $order->end_date])
                              ->orWhereBetween('end_date', [$order->start_date, $order->end_date]);
                    })->get(['id']);

        // get employees who are planned for an uncanceled order in this period
        $planned = \DB::table('employee_order')
                        ->whereIn('order_id', $orders->pluck('id'))
                        ->where(function ($query) {
                            $query->whereNull('rejected_by_employee')
                                ->orWhere('rejected_by_employee', 0);
                        })
                        ->pluck('employee_id');

        // get employees who are absent
        $absent = Timeoff::whereBetween('date', [$order->start_date, $order->end_date])->pluck('employee_id');

        //get blocked employees
        $blocked = $order->client->blockedEmployees()->pluck('id');

        return Employee::active()
            ->where('applicant', 0)
            ->with(['roles', 'workingTimeAccounts' => function($query) {
                $query->where('date', true);
            }])
            ->whereNotIn('id', $order->employees->pluck('id'))// exclude employees from this order
            ->get(['id', 'first_name', 'last_name', 'sex', 'city', 'locations', 'occupation_type', 'driving_license', 'car', 'working_time_account', 'contractual_working_hours', \DB::raw("CASE
                                                   WHEN id IN (" . implode(', ', $blocked->toArray() ?: [0]) . ") THEN 'blocked'
                                                   WHEN id IN (" . implode(', ', $absent->toArray() ?: [0]) . ") THEN 'absent'
                                                   WHEN id IN (" . implode(', ', $planned->toArray() ?: [0]) . ") THEN 'planned'
                                                   ELSE 'free'
                                                   END 
                                                   AS status")]);
    }

    /**
     * Get an employee for an order.
     *
     * @param Order $order
     * @param Employee $employee
     * @return mixed
     */
    public function getEmployee($order, $employee)
    {
        return $order->employees()
            ->where('employee_id', $employee->id)
            ->first();
    }

    /**
     * Check if assignment conflicts with other employee's assignments.
     *
     * @param $order
     * @param $employee
     * @return mixed
     */
    public function check(Order $order, Employee $employee)
    {
        $orders = $employee->orders()
            ->where(function($query) use ($order) {
                $query->whereDate('start_date', '=', carbon($order->start_date)->addDay())
                    ->orWhereDate('end_date', '=', carbon($order->start_date)->subDay());
            })->where(function($query) {
                $query->where('rejected_by_employee', 0)
                    ->orWhereNull('rejected_by_employee');
            })
            ->get(['id', 'start_date', 'end_date', 'start_time']);

        return $orders;
    }

    /**
     * Attach an employee to an order.
     *
     * @param Order $order
     * @param Employee $employee
     * @return mixed
     */
    public function attachEmployee(Order $order, Employee $employee)
    {
        if ($order->employees->contains($employee->id))
            return;

        $order->employees()->attach($employee->id, [
            'role'          => request('role') ?: '-',
            'meeting_point' => $order->meeting_point,
            'meeting_time'  => $order->meeting_time,
            'edited_by'     => auth()->user()->name
        ]);

        event(new StaffUpdatedForOrder($order));
    }

    /**
     * Detach an employee from an order.
     *
     * @param Order $order
     * @param Employee $employee
     */
    public function detachEmployee(Order $order, Employee $employee)
    {
        $order->employees()->detach($employee->id);

        event(new StaffUpdatedForOrder($order));
    }

    /**
     * Save changes in personal allocation for order.
     *
     * @param Order $order
     *
     * @return int
     */
    public function save($order)
    {
        foreach (request('employees') as $employee) {

            $order->employees()->updateExistingPivot($employee['pivot']['employee_id'], [
                'role'                 => $employee['pivot']['role'],
                'working_area'         => $employee['pivot']['working_area'],
                'approved_by_employee' => $employee['pivot']['approved_by_employee'],
                'rejected_by_employee' => $employee['pivot']['rejected_by_employee'],
                'meeting_point'        => $employee['pivot']['meeting_point'],
                'meeting_time'         => $employee['pivot']['meeting_time'],
                'edited_by'            => $employee['pivot']['edited_by']
            ]);
        }

        event(new StaffUpdatedForOrder($order));

        return $order->employees()->approved()->count();
    }

    /**
     * Delete an order.
     *
     * @param Order $order
     * @return bool
     */
    public function delete(Order $order)
    {
        if ($order->time_recorded || $order->employees()->exists() || $order->children()->exists())
            return false;

        return $order->delete();
    }

    /**
     * Make calculation for this order.
     *
     * @param CalculationRequest $request
     * @param Order $order
     */
    public function calculation(CalculationRequest $request, Order $order)
    {
        $request->save($order);
    }

    /**
     * Update other costs for this order.
     *
     * @param Order $order
     */
    public function accounting(Order $order)
    {
        $this->validate(request(), ['other_costs' => 'decimal']);

        $order->update([
            'other_costs' => (float) convert(request('other_costs', 0)),
        ]);
    }

    /**
     * Send reminder
     */
    public function reminder()
    {

    }
}
