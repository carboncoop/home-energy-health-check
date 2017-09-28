<?php

namespace App\Process;

use Carbon\Carbon;

class SubmissionProcessor
{
    protected $pdf;

    public function __construct()
    {
        //$this->pdf = \Snappy;
        $this->now = Carbon::now()->toDateTimeString();
    }

    public function process($id, $data, $method = 'file')
    {
        $this->debug($id, $data);
        $this->pdf = \Snappy::loadView('pdf.assessment', $data);
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

    protected function debug($id, $data)
    {
        echo "\n Id: ".$id."\n";
        foreach ($data as $key => $vv) {
            foreach ($vv as $k => $v) {
                echo $key." - ".$k." : ".$v."\n";
            }
        }
    }
}
