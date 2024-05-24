<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RegisterUserPasswordMail extends Mailable
{
  // use Queueable;

  private $user;
  private $password;

  public function __construct($user, $password)
  {
    $this->user = $user;
    $this->password = $password;
  }

  public function via($notifiable)
  {
    return ['mail'];
  }

  public function build()
  {

    return $this->view('mail/register-user-password-mail')
      ->with(['password' => $this->password]);
  }



  /**
   * Get the message envelope.
   *
   * @return \Illuminate\Mail\Mailables\Envelope
   */
  public function envelope()
  {
    return new Envelope(
      subject: 'Register User Password Mail',
    );
  }

  /**
   * Get the message content definition.
   *
   * @return \Illuminate\Mail\Mailables\Content
   */
  public function content()
  {
    return new Content(
      markdown: 'register-user-password-mail',
      with: [
        'name' => $this->user->name,
        'password' => $this->password,
      ],
    );
  }

  /**
   * Get the attachments for the message.
   *
   * @return array
   */
  public function attachments()
  {
    return [];
  }
}
