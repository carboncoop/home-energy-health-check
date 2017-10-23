<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AssessmentEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $attachment_path;
    public $subject = "Your Energy Assessment";
    public $from = [
      "address" => "example@example.com",
      "name" => "My Name",
    ];

    /**
     * Create a new message instance.
     *
     * @param $data
     * @return void
     */
    public function __construct(Array $data)
    {
        $this->attachment_path = $data['attachment_path'];
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
      ->attach(storage_path($this->attachment_path), array(
        'mime' => 'application/pdf'
      ));
    }
}
