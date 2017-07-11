<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegisterMail extends Mailable
{
    use Queueable, SerializesModels;

    private $oUser;
    private $oCompany;
    private $oEvent;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($oUser, $oCompany, $oEvent)
    {
        $this->oUser = $oUser;
        $this->oCompany = $oCompany;
        $this->oEvent = $oEvent;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.register')
            ->subject('Registration notification')
            ->with('oUser', $this->oUser)
            ->with('oCompany', $this->oCompany)
            ->with('oEvent', $this->oEvent);
    }
}
