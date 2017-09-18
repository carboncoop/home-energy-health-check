<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\CreatePdfDocument;
use App\Jobs\SendEmail;

class TestJobCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jobs:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Runs a test queue.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $test = ['foo' => 'bar', 'fii' => 42];
        $this->comment("Testing Job..");
        $email_job = [new SendEmail($test)];
        CreatePdfDocument::withChain($email_job)->dispatch($test);
    }
}
