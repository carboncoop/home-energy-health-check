<?php

namespace App\Process;

use Carbon\Carbon;
use Vinkla\Hashids\Facades\Hashids;
use App\Models\Improvement;
use App\Models\Part;
use App\Models\Section;
use App\Models\Assessment;
use App\Models\AssessmentImprovement;
use App\Jobs\SendEmail;

class PdfGenerator
{
    protected $pdf, $viewVars;

    public function __construct()
    {
        $this->now = Carbon::now()->toDateTimeString();
    }

    public function process($id, $method = 'file', $debug = false)
    {
        $assessment = Assessment::findOrFail($id)->toArray();
        $parts = Part::with('improvements')->get()->toArray();
        $sections = Section::all()->toArray();

        $ai = AssessmentImprovement::where('assessment_id', '=', $id)
            ->get()->keyBy('improvement_id')->toArray();

        foreach ($parts as $pkey => $p) {
            foreach ($p['improvements'] as $ikey => $imp) {
                if (array_key_exists($imp['id'], $ai) && $ai[$imp['id']]['value'] != 'n/a') {
                    $parts[$pkey]['improvements'][$ikey]['value'] = $ai[$imp['id']]['value'];
                    $parts[$pkey]['improvements'][$ikey]['comment'] = $ai[$imp['id']]['comment'];
                } else {
                    // remove imps with n/a values
                    unset($parts[$pkey]['improvements'][$ikey]);
                }
            }
            // reset array keys
            $parts[$pkey]['improvements'] = array_values($parts[$pkey]['improvements']);
        }

        $this->viewVars = [
            'assessment' => $assessment,
            'parts' => $parts,
            'sections' => $sections,
            'formSchema' => Assessment::formSchema(),
        ];

        $this->pdf = \Snappy::loadView('pdf.assessment', $this->viewVars);

        if ('file' == $method) {
            return $this->outputToFile();
        }
        else if ('screen' == $method) {
            return $this->outputToScreen($debug);
        }
        else if ('download' == $method) {
            return $this->outputToDownload();
        }
        else if ('email' == $method) {
            $result = $this->outputToFile();
            SendEmail::dispatch([
                'assessment' => $assessment,
                'attachment_path' => $this->getStoragePath(),
            ]);
        }
    }

    protected function getStoragePath()
    {
        $id = $this->viewVars['assessment']['id'];
        $unique = Hashids::encode($id);
        return 'pdf/' . $unique . '.pdf';
    }

    protected function outputToFile()
    {
        $this->pdf->save(storage_path($this->getStoragePath()), true);
        return response()->json([
            'status' => 'OK',
        ]);
    }

    protected function outputToScreen($debug = false)
    {
        if ($debug) {
            return view('pdf.assessment', $this->viewVars);
        }
        return $this->pdf->inline();
    }

    protected function outputToDownload()
    {
        return $this->pdf->download('assessment.pdf');
    }
}
