<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PasswordViewedMail extends Mailable
{
    use Queueable, SerializesModels;

    private $password, $viewer, $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($password, $viewer, $user)
    {
        $this->password = $password;
        $this->viewer = $viewer;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Password ' . $this->password->company->name . ' - ' . $this->password->name . ' used!')
            ->view('mail.password_viewed', [
                'password' => $this->password,
                'viewer' => $this->viewer,
                'user' => $this->user
            ]);
    }
}
