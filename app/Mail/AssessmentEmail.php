<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AssessmentEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $attachment_path, $data;

    public $subject = "Your Energy Assessment";
    public $from = [
      "address" => "energyteam@plymouthenergycommunity.com",
      "name" => "Plymouth Energy Community Energy Team",
    ];

    /**
     * Create a new message instance.
     *
     * @param $data
     * @return void
     */
    public function __construct(Array $data)
    {
        $this->data = $data;
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
      ->markdown('emails.assessment', [
          'assessment' => $this->data['assessment'],
      ])
      ->attach(storage_path($this->attachment_path), array(
        'mime' => 'application/pdf'
      ));
    }
}
