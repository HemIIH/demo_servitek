<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Request extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;

    /**
     * Create a new message instance.
     *
     * @param $user
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $mail = $this->subject('Nachricht von ' . $this->user->name . ' - ' . request('subject'))
            ->from($this->user->email)
            ->to(request('topic'));

        if (request()->hasFile('attachment')) {
            $file = request()->file('attachment');

            $mail->attach($file->getRealPath(), [
                'as' => $file->getClientOriginalName(),
                'mime' => $file->getMimeType()
            ]);
        }

        return $mail->markdown('emails.contact', [
            'body' => request('body'),
            'user' => $this->user
        ]);
    }
}
