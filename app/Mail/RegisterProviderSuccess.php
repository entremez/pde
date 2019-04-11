<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;
use App\Provider;
use App\MailBody;

class RegisterProviderSuccess extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
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
        $provider = Provider::where('user_id', $this->user->id)->first();
        $mail_body = MailBody::first();
        $body = nl2br($mail_body->provider_approved);
        $body = str_replace('[NOMBRE_USUARIO]', $provider->name, $body);
        return $this->subject('Proveedor aprobado en plataforma Puente Diseño Empresa')
                    ->to($this->user->email)
                    ->view('mails.provider-success',[
                        'body' => $body
                ]);
    }
}
