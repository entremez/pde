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
    protected $type;
    protected $customSubject;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mail, $comment, $type, $customSubject)
    {
        $this->mail = $mail;
        $this->comment = $comment;
        $this->type = $type;
        $this->customSubject = $customSubject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->customSubject)
            ->to($this->mail)
            ->view('mails.provider-success',[
                'body' => $this->comment,
        ]);
    }
}
