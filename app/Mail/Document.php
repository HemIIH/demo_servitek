<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Document extends Mailable
{
    use Queueable, SerializesModels;

    public $document;

    /**
     * Create a new message instance.
     *
     * @param $document
     */
    public function __construct($document)
    {
        $this->document = $document;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user = auth()->user();

        return $this->subject(request('subject'))
            ->from($user->email, $user->name)
            ->to(request('email'))
            ->bcc($user->cc_email)
            ->attach(\Storage::path($this->document->path), ['as' => $this->document->name . '.pdf', 'mime' => 'application/pdf'])
            ->view('emails.employees.document', ['body' => request('body')]);
    }
}
