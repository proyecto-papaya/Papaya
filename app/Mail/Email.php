<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Email extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $demo;


    public function __construct($demo)
    {
        $this->demo = $demo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        /*
        $address = 'papaya.project20@gmail.com';
        $subject = '¡Bienvenidx!';
        $name = 'Papaya';

        return $this->view('mails.demo')
            ->from($address, $name)
            ->cc($address, $name)
            ->subject($subject)
            ->text('mails.demo_plain')
            ->with(['message' => $this->demo['message']]);
        */

        $user = $this->demo;

        return $this->view('mails.inactividad',compact('user'))
            ->subject('Inactividad');

    }
}
