<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Carbon\Carbon;

class CreatePdfDocument implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        print("Generating PDF...\n");
        //var_dump($this->data);
        \PDF::setOptions(['isHtml5ParserEnabled' => true]);
        $pdf = \PDF::loadView('pdf.assessment', $this->data)
            ->setPaper('a4', 'portrait');
        $t = Carbon::now()->toDateTimeString();
        $pdf->save(storage_path('pdf/t'.$t.'.pdf'));
        print("PDF generation complete!\n");
        return;
    }
}
