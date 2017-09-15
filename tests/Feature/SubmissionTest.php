<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Jobs\CreatePdfDocument;
use App\Jobs\SendEmail;
use App\Mail\AssessmentEmail;

class SubmissionTest extends TestCase {

  /**
   * A basic test example.
   *
   * @return void
   */
  public function testSendEmailJobIsSendingMail() {

    Mail::fake();

    $payload = array('foo' => 44, 'fii' => 'it works');
    $email_job = [new SendEmail($payload)];
    CreatePdfDocument::withChain($email_job)->dispatch($payload);

    Mail::assertSent(AssessmentEmail::class, function ($mail) {
      //print_r($mail);
      return (
        $mail->hasTo('adam@appsynergy.net') &&
        $mail->subject == "Your Energy Assessment" &&
        $mail->from == "example@example.com" &&
        empty($mail->attachments) // TODO: should NOT be empty
      );
    });
  }

}
