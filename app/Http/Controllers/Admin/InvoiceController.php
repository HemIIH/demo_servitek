<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Invoice\SendInvoiceRequest;
use App\Http\Requests\Client\Invoice\UpdateInvoiceRequest;
use App\Models\Client\Client;
use App\Models\Client\Invoice;
use App\Models\Client\InvoiceItem;
use App\Models\Order\Timetracking;
use App\Models\Settings\Repos\TextblocksRepository;
use App\Services\Helper\LogMailTraffic;

class InvoiceController extends Controller
{
    use LogMailTraffic;

    /**
     * Show all invoices.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $data['clients'] = Client::orderBy('name')->get();

        return view('admin.invoices.list', $data);
    }

    /**
     * Create new invoice.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.invoices.new');
    }

    /**
     * Edit invoice.
     *
     * @param Invoice $invoice
     * @return \Illuminate\View\View
     */
    public function edit(Invoice $invoice)
    {
        $data['client']   = $invoice->client;
        $data['contacts'] = $invoice->client->contacts;

        return view('admin.invoices.edit', $data)
            ->with('invoice', $invoice);
    }

    /**
     * Update invoice.
     *
     * @param UpdateInvoiceRequest $request
     * @param Invoice $invoice
     * @return \Illuminate\View\View
     */
    public function update(UpdateInvoiceRequest $request, Invoice $invoice)
    {
        $request->save($invoice);

        success('invoice_updated');

        return redirect()->back();
    }

    /**
     * Add new item to invoice.
     *
     * @param Invoice $invoice
     * @return \Illuminate\View\View
     */
    public function newItem(Invoice $invoice)
    {
        $invoice->items()->create([
            'type'       => 'custom',
            'start_date' => now()->format('Y-m-d'),
            'end_date'   => now()->format('Y-m-d'),
            'service'    => 'Service',
            'quantity'   => '',
            'unit'       => 'Stunden',
            'price'      => '',
            'tax_rate'   => 19,
            'discount'   => 0
        ]);

        return redirect()->back();
    }

    /**
     * Show invoice as a PDF.
     *
     * @param Invoice $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        $client = $invoice->client;

        return \PDF::setPaper('A4')
            ->loadView('pdf.invoice', compact('invoice', 'client'))
            ->stream('Rechnung.pdf');
    }

    /**
     * Show all timetracked employees for an order.
     *
     * @param Invoice $invoice
     * @return \Illuminate\Http\Response
     */
    public function proofOfWork(Invoice $invoice)
    {
        // get orders for invoice
        $order_ids = InvoiceItem::where('invoice_id', $invoice->id)->pluck('order_id');

        $client = $invoice->client;

        $timetrackings = Timetracking::with('employee', 'order')
            ->whereIn('order_id', $order_ids)
            ->orderBy('date')
            ->get()
            ->groupBy('order_id');

        return \PDF::setPaper('A4')
            ->loadView('pdf.proof_of_work', compact('invoice', 'timetrackings', 'client'))
            ->stream('Rechnung.pdf');
    }

    /**
     * Delete client.
     *
     * @param Invoice $invoice
     */
    public function delete(Invoice $invoice)
    {
        $invoice->delete();
    }


    /**
     * Prepare sending invoice.
     *
     * @param Invoice $invoice
     * @param TextblocksRepository $textblocks
     * @return \Illuminate\View\View
     */
    public function prepare(TextblocksRepository $textblocks, Invoice $invoice)
    {
        $data['textblocks']  = $textblocks->byType('invoice');
        $data['contacts']    = $invoice->client->contacts;
        $data['mails']       = $invoice->mails;

        return view('admin.invoices.prepare', $data)
            ->with('invoice', $invoice);
    }

    /**
     * Prepare sending warning.
     *
     * @param Invoice $invoice
     * @param TextblocksRepository $textblocks
     * @return \Illuminate\View\View
     */
    public function warning(TextblocksRepository $textblocks, Invoice $invoice)
    {
        $data['textblocks']  = $textblocks->byType('invoice');
        $data['contacts']    = $invoice->client->contacts;
        $data['mails']       = $invoice->mails;

        return view('admin.invoices.warning', $data)
            ->with('invoice', $invoice);
    }

    /**
     * Send invoice.
     *
     * @param SendInvoiceRequest $request
     * @param Invoice $invoice
     * @return \Illuminate\Http\RedirectResponse
     */
    public function send(SendInvoiceRequest $request, Invoice $invoice)
    {
        \Mail::send(new \App\Mail\Invoice($invoice, $request));

        $this->log($invoice, trans('admin.Rechung versandt an').' ' . implode(', ', $request->get('contacts')));
        $invoice->update(['sent' => 1]);

        success('mail_sent');

        return redirect()->back();
    }


    /**
     * Send warning.
     *
     * @param SendInvoiceRequest $request
     * @param Invoice $invoice
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendWarning(SendInvoiceRequest $request, Invoice $invoice)
    {
        \Mail::send(new \App\Mail\Invoice($invoice, $request));

        $this->log($invoice, trans('admin.Erinnerung versandt an').' ' . implode(', ', $request->get('contacts')));

        success('mail_sent');

        return redirect()->back();
    }

}
