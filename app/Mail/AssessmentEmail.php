<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AssessmentEmail extends Mailable {
  use Queueable, SerializesModels;

  public
    $subject = "Your Energy Assessment",
    $from = "example@example.com";

  /**
   * Create a new message instance.
   *
   * @return void
   */
  public function __construct()
  {
  }

  /**
   * Build the message.
   *
   * @return $this
   */
  public function build()
  {
    return $this
      ->from($this->from)
      ->subject($this->subject)
      ->markdown('emails.assessment')
      ->attach(storage_path('pdf/my-file.pdf'), array(
        'mime' => 'application/pdf'
      ));
  }

}
