<?php

namespace App\Mail\User;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserActivation extends Mailable
{
    use Queueable, SerializesModels;

    public $token;
    public $password;

    /**
     * Create a new message instance.
     *
     * @param $token
     * @param $password
     */
    public function __construct($token, $password)
    {
        $this->token = $token;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Kontoaktivierung')
            ->markdown('emails.user.user_activation');
    }
}
