<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Auth\User;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;



class ConfirmationEmail extends Mailable
{
    use Queueable, SerializesModels;


    public $user;


    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function build()
    {
        return $this->view('email.confirmation');
    }
}
