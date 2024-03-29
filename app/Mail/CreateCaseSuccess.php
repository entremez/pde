<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Instance;
use App\MailBody;

class CreateCaseSuccess extends Mailable
{
    use Queueable, SerializesModels;

    protected $instance;
    protected $type; // 1: creado , 2: aprobado

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Instance $instance, $type)
    {
        $this->instance = $instance;
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
        $body = str_replace('[NOMBRE_CASO]', $this->instance->name, $body);
        $body = str_replace('[NOMBRE_USUARIO]', $this->instance->nameProvider(), $body);
        return $this->subject($this->getSubject())
                    ->to($this->instance->emailProvider())
                    ->view('mails.provider-success',[
                        'body' => $body
                ]);
    }

    private function getSubject()
    {
        switch ($this->type) {
            case 1:
                return 'Has creado un nuevo caso';
                break;
            case 2:
                return 'Tu caso ha sido aprobdo';
                break;
        }
    }

    private function getBody()
    {
        $mail_body = MailBody::first();
        switch ($this->type) {
            case 1:
                return nl2br($mail_body->new_instance);
                break;
            case 2:
                return nl2br($mail_body->instance_approved);
                break;
            case 3:
        }
    }
}
