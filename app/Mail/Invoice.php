<?php

namespace App\Mail;

use App\Models\Client\InvoiceItem;
use App\Models\Order\Timetracking;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Invoice extends Mailable
{
    use Queueable, SerializesModels;

    protected $invoice;

    protected $request;

    /**
     * Create a new message instance.
     *
     * @param $invoice
     * @param $request
     */
    public function __construct($invoice, $request)
    {
        $this->invoice = $invoice;
        $this->request = $request;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $invoice = $this->generateInvoice($this->invoice);
        $proof_of_work = $this->generateProofOfWork($this->invoice);

        $user = auth()->user();

        return $this->subject(request('mail_subject'))
            ->from($user->email, $user->name)
            ->to(request('contacts'))
            ->bcc($user->cc_email)
            ->attachData($invoice, 'Rechnung - Nr .' . $this->invoice->id. '.pdf')
            ->attachData($proof_of_work, 'Stundennachweis zu Rechnung ' . $this->invoice->id. '.pdf')
            ->view('emails.clients.invoice', ['body' => request('mail_body')]);
    }

    /**
     * Generate PDF of the invoice.
     *
     * @param $invoice
     * @return \PDF
     */
    protected function generateInvoice($invoice)
    {
        $client = $invoice->client;

        return \PDF::loadView('pdf.invoice', compact('invoice', 'client'))->output();
    }

    /**
     * Generate proof of work of all orders
     * belonging to the invoice.
     *
     * @param $invoice
     * @return \PDF
     */
    protected function generateProofOfWork($invoice)
    {
        // get orders for invoice
        $order_ids = InvoiceItem::where('invoice_id', $invoice->id)->pluck('order_id');

        $timetrackings = Timetracking::with('employee', 'order')
            ->whereIn('order_id', $order_ids)
            ->orderBy('date')
            ->get()
            ->groupBy('order_id');

        return \PDF::loadView('pdf.proof_of_work', compact('invoice', 'timetrackings'))->output();
    }
}
