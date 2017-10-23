<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Mail;
use App\Models\Assessment;
use App\Process\PdfGenerator;
use App\Mail\AssessmentEmail;

class EmailTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    public function testMailSent()
    {
        $this->seedData();
        Mail::fake();
        $pdf = new PdfGenerator();
        $pdf->process(1, 'email');

        Mail::assertSent(AssessmentEmail::class, function ($mail)
        {
            $assessment = Assessment::findOrFail(1);
            $emailTo = $assessment['homeowner_email'];
            return (
                $mail->hasTo($emailTo)
                && $mail->subject == "Your Energy Assessment"
                && $mail->from["address"] == "energyteam@plymouthenergycommunity.com"
            );
        });
    }

}
