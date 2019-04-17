<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;
use App\MailBody;

class CommentToUser extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;
    protected $type;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $type)
    {
        $this->user = $user;
        $this->type = $type;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $body = $this->getBody();
        $body = str_replace('[TIPO_USUARIO]', $this->getType(), $body);
        return $this->subject($this->getSubject())
                    ->to($this->user->email)
                    ->view('mails.provider-success',[
                        'body' => $body
                ]);
    }

    private function getBody()
    {
        $mail_body = MailBody::first();
        switch ($this->type) {
            case 1:
                return nl2br($mail_body->user_without_profile);
                break;
            case 3:
        }
    }

    private function getSubject()
    {
        switch ($this->type) {
            case 1:
                return 'Completa tu perfil';
                break;
        }
    }

    private function getType()
    {
        switch ($this->user->role_id) {
            case 2:
                return 'proveedor de servicios de diseño';
                break;
            case 2:
                return 'empresa';
                break;
        }
    }
}
