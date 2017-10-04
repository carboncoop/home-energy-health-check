<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assessment;
use App\Models\Improvement;
use App\Models\Part;
use App\Models\AssessmentImprovement;
use App\Jobs\CreatePdfDocument;
use App\Jobs\SendEmail;
use App\Process\SubmissionProcessor;

class SubmissionController extends Controller
{
    protected $processor;

    public function __construct(SubmissionProcessor $processor)
    {
        $this->processor = $processor;
    }

    /**
     * Show the Asessment form.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $assessment = Assessment::findOrFail($id);
        $parts = Part::get([
            'id', 'title', 'description'
        ]);
        $improvements = Improvement::get([
            'id', 'title', 'part_id', 'description',
            'assessor_comment', 'assessor_guidance',
        ]);
        return view('submission.edit', [
            'parts' => $parts,
            'json_parts' => $parts->toJson(),
            'json_improvements' => $improvements->toJson(),
            'assessment' => $assessment,
        ]);
    }

    /**
     * Process a submitted Assessment form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $assessment = Assessment::findOrFail($id);

        // save assessment data on the main table
        $assessment_data = $request->input('assessment');
        $assessment->fill($assessment_data);
        $assessment->save();

        // save improvement data on the related table
        $improvements_data = $request->input('improvements');
        $improvements_to_save = collect($improvements_data)->filter(function ($imp) {
            return isset($imp['value']) || isset($imp['comment']);
        })->map(function ($imp) {
            return new AssessmentImprovement($imp);
        });
        $assessment->assessment_improvements()->saveMany($improvements_to_save);

        // prepare pdf and send email
        if ($request->andProcess) {
            return $this->processor->process($id, $request->all());
        }

        return response()->json([
            'status' => 'OK',
            'where' => 'just saved',
            'input' => $request->all(),
        ]);
    }

    /**
     * Test the pdf output.
     *
     * @return \Illuminate\Http\Response
     */
    public function pdfTest(Request $request)
    {
        $input = [
            1 => [ 'value' => "need", 'comment' => "test comment" ],
            2 => [ 'value' => "need", 'comment' => "test comment" ],
            3 => [ 'value' => "need", 'comment' => "test comment" ],
            8 => [ 'value' => "need", 'comment' => "test comment" ],
            9 => [ 'value' => "need", 'comment' => "test comment" ],
            10 => [ 'value' => "need", 'comment' => "test comment" ],
        ];
        return $this->processor->process(1, $input, 'screen');
    }

}
