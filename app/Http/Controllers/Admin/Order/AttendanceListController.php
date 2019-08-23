<?php

namespace App\Http\Controllers\Admin\Order;

use App\Models\Order\Order;
use App\Models\Settings\Repos\TextblocksRepository;
use App\Mail\AttendanceList;
use App\Http\Requests\Order\SendAttendanceListRequest;
use App\Services\Helper\LogMailTraffic;

use App\Http\Controllers\Controller;

class AttendanceListController extends Controller
{
    use LogMailTraffic;

    public function show(TextblocksRepository $textblocks, Order $order)
    {
        $data['contacts']   = $order->contacts;
        $data['mails']      = $order->mails;
        $data['textblocks'] = $textblocks->byKey('attendance_list.mail_body');

        return view('admin.orders.attendance_list', $data)
            ->with('order', $order);
    }

    /**
     * Preview PDF.
     *
     * @param Order $order
     * @return \Illuminate\Http\Response
     */
    public function pdf(Order $order)
    {
        $pdf = $this->generateAttendanceList($order);

        return $pdf->stream('Anwesenheitsliste: ' . $order->title . '.pdf');
    }


    /**
     * Send PDF with attendance list.
     *
     * @param SendAttendanceListRequest $request
     * @param Order $order
     * @return \Illuminate\Http\RedirectResponse
     */
    public function send(SendAttendanceListRequest $request, Order $order)
    {
        \Mail::send(new AttendanceList($order, $this->generateAttendanceList($order)));

        $this->log($order, request('type') . ' versendet an ' . implode(', ', $request->get('contacts')));
        $order->update(['sent' => now()]);

        success('mail_sent');

        return redirect()->back();
    }

    /**
     * Generate PDF.
     *
     * @param Order $order
     * @return \PDF
     */
    protected function generateAttendanceList(Order $order)
    {
        $children = $order->children()->where('status', 'active')->whereHas('employees')->get();
        $orders = collect([$order])->merge($children);
        $client = $order->client;

        return \PDF::loadView('pdf.attendance_list', compact('orders', 'textblocks', 'client'));
    }
}
