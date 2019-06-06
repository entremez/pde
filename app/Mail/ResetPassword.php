<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    protected $mail;
    protected $token;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mail, $token)
    {
        $this->mail = $mail;
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Notificación de cambio de contraseña')
                    ->to($this->mail)
                    ->view('mails/mail-reset', [
                        'token' => $this->token
                    ]);
    }
}
