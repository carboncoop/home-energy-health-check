<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AssessmentEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $attachment_path, $data, $subject, $from;

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
        $this->subject = config('app.assessment_title');
        $this->from = [
          "address" => config('mail.from.address'),
          "name" => config('mail.from.name'),
        ];
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
