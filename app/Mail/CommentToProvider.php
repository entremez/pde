<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CommentToProvider extends Mailable
{
    use Queueable, SerializesModels;

    protected $mail;
    protected $comment;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mail, $comment)
    {
        $this->mail = $mail;
        $this->comment = $comment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Observaciones perfil proveedor de servicios de diseño')
            ->to($this->mail)
            ->view('mails.comment-to-provider',[
                'comment' => $this->comment,
        ]);
    }
}
