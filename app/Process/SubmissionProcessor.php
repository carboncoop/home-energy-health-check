<?php

namespace App\Process;

use Carbon\Carbon;
use App\Models\Improvement;
use App\Models\Section;

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
        $sections = Section::all();
        $improvements = Improvement::all()->filter(function ($imp) use ($input) {
            return array_key_exists($imp->id, $input) &&
                $input[$imp->id]['value'] == 'need';
        });
        $this->pdf = \Snappy::loadView('pdf.assessment', [
            'input' => $this->input,
            'improvements' => $improvements,
            'sections' => $sections,
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
