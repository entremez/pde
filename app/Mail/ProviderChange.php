<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Provider;

class ProviderChange extends Mailable
{
    use Queueable, SerializesModels;

    protected $name; 
    protected $type; 
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($type, $name)
    {
        $this->name = $name;
        $this->type = $type;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email = $this->getMessage($this->type, $this->name);
        $subject = $this->getSubject($this->type);
        return $this->subject($subject)
                    ->to('administrador@puentedisenoempresa.cl')
                    ->view('mails.provider-change',[
                        'email' => $email
                ]);
    }


    /**
     * Return messsage to mail body.
     * $name: Name of provider related
     * $type: Type of action to trigger email.
     * 1: Nuevo porveedor
     * 2: Nuevo caso agregado
     * 3: Cambios en proveedor
     * 4: Cambios en casos
     * 
     * @return $message
     */


    private function getMessage($type, $name)
    {
        switch ($type) {
            case 1:
                return "El proveedor ".$name." ha creado su perfil.";
                break;
            case 2:
                return "El proveedor ".$name." ha agegado un caso de éxito.";
                break;
            case 3:
                return "El proveedor ".$name." ha realizado cambios en su perfil.";
                break;
            case 4:
                return "El proveedor ".$name." ha realizado cambios en un caso de éxito.";
                break;
        }
    }

    private function getSubject($type)
    {
        switch ($type) {
            case 1:
                return 'Nuevo proveedor';
                break;
            case 2:
                return 'Nuevo caso agregado';
                break;
            case 3:
                return 'Proveedor realizó cambios en su perfil';
                break;
            case 4:
                return 'Cambios a un caso con observaciones';
                break;
        }
    }


}
