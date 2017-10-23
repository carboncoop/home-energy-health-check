<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Mail;
use App\Process\PdfGenerator;
use App\Mail\AssessmentEmail;

class EmailTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    public function testMailSent()
    {
        $this->seedData();
        Mail::fake();
        $pdfGenerator = new PdfGenerator();
        $done = $pdfGenerator->process(1, 'email');

        Mail::assertSent(AssessmentEmail::class, function ($mail)
        {
            return (
                $mail->hasTo('adam@appsynergy.net') &&
                $mail->subject == "Your Energy Assessment" &&
                $mail->from["address"] == "example@example.com"
                //empty($mail->attachments) // TODO: can Mail Fake read attachments?
            );
        });
    }

}
