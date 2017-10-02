<?php

namespace App\Process;

use Carbon\Carbon;
use App\Models\Improvement;
use App\Models\Part;

class SubmissionProcessor
{
    protected $pdf, $input;

    public function __construct()
    {
        $this->now = Carbon::now()->toDateTimeString();
    }

    public function process($id, $input, $method = 'file')
    {
        $this->input = $input;

        $parts = Part::with('improvements')->get()->map(function ($part) {
            $part->improvements = $part->improvements->filter(function ($imp) {
                return array_key_exists($imp->id, $this->input) &&
                    $this->input[$imp->id]['value'] == 'need';
            });
            return $part;
        });

        $this->pdf = \Snappy::loadView('pdf.assessment', [
            'input' => $this->input,
            'parts' => $parts,
        ]);

        if ('file' == $method) {
            return $this->outputToFile();
        }
        else if ('screen' == $method) {
            return $this->outputToScreen();
        }
        else if ('download' == $method) {
            return $this->outputToDownload();
        }
    }

    protected function outputToFile()
    {
        $this->pdf->save(storage_path('pdf/t'.$this->now.'.pdf'));
        return response()->json([
            'status' => 'OK',
            'input' => $this->input,
        ]);
    }

    protected function outputToScreen()
    {
        return $this->pdf->inline();
    }

    protected function outputToDownload()
    {
        return $this->pdf->download('assessment.pdf');
    }
}
