<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PasswordUpdatedMail extends Mailable
{
    use Queueable, SerializesModels;

    private $password, $viewer, $user, $ip;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($password, $viewer, $user, $ip)
    {
        $this->password = $password;
        $this->viewer = $viewer;
        $this->user = $user;
        $this->ip = $ip;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Password ' . $this->password->company->name . ' - ' . $this->password->name . ' updated!')
            ->view('mail.password_updated', [
                'password' => $this->password,
                'viewer' => $this->viewer,
                'user' => $this->user,
                'ip' => $this->ip
            ]);
    }
}
