<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegisterCompany extends Mailable
{
    use Queueable, SerializesModels;

    protected $mail;
    protected $pass;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mail, $pass)
    {
        $this->mail = $mail;
        $this->pass = $pass;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Registro en Puente Diseño Empresa')
                    ->to($this->mail)
                    ->view('mails.register-company',[
                        'token' => $this->pass
                ]);
    }
}
