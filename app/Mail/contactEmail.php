<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Contact;

class contactEmail extends Mailable
{
    use Queueable, SerializesModels;


    public $user;


//    public function __construct(Contact $user)
//    {
//        $this->user = $user;
//    }

    public function build()
    {
        return $this->view('email.contact');
    }
}
