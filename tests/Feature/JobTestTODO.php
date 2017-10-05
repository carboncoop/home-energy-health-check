<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Jobs\CreatePdfDocument;
use App\Jobs\SendEmail;
use App\Mail\AssessmentEmail;

class SubmissionTest extends TestCase
{

    public function setUp()
    {
        parent::setUp();
        //\Artisan::call('migrate');
        //\Artisan::call('db:seed', ['--class' => 'DatabaseSeeder', '--database' => 'mysql']);
    }

    public function tearDown()
    {
        //\Artisan::call('migrate:reset');
        parent::tearDown();
    }

  /**
   * A basic test example.
   *
   * @return void
   */
    public function testSendEmailJobIsSendingMail()
    {
        Mail::fake();

        $payload = [22 => ['value' => 'need', 'comment' => '...']];
        $email_job = [new SendEmail($payload)];
        CreatePdfDocument::withChain($email_job)->dispatch($payload);

        Mail::assertSent(AssessmentEmail::class, function ($mail) {
            return (
                $mail->hasTo('adam@appsynergy.net') &&
                $mail->subject == "Your Energy Assessment" &&
                $mail->from["address"] == "example@example.com"
                //empty($mail->attachments) // TODO: can Mail Fake read attachments?
            );
        });
    }
}
