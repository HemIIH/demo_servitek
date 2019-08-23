<?php

namespace App\Mail;

use App\Models\Order\Order;

use App\Models\Settings\Repos\TextblocksRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AttendanceList extends Mailable
{
    use Queueable, SerializesModels;

    protected $order;

    protected $pdf;

    /**
     * Create a new message instance.
     *
     * @param Order $order
     */
    public function __construct(Order $order, $pdf)
    {
        $this->order = $order;
        $this->pdf = $pdf;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(request('subject'))
                ->from(auth()->user()->email)
                ->to(request('contacts'))
                ->bcc(auth()->user()->cc_email)
                ->attachData($this->pdf->output(), 'Stundenzettel - ' . $this->order->start . '.pdf')
                ->view('emails.clients.attendance_list', ['body' => request('body')]);
    }
}
