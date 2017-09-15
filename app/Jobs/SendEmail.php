<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Mail\AssessmentEmail;

class SendEmail implements ShouldQueue {

  use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

  protected $data;

  /**
   * Create a new job instance.
   *
   * @return void
   */
  public function __construct(Array $data) {
    $this->data = $data;
  }

  /**
   * Execute the job.
   *
   * @return void
   */
  public function handle() {
    print("Sending email..\n");
    //var_dump($this->data);
    \Mail::to("adam@appsynergy.net")->send(new AssessmentEmail($this->data));
    print("Email sending complete!\n");
  }

}
