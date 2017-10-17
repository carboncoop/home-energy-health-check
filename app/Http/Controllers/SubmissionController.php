<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SubmissionRequest;
use App\Models\Assessment;
use App\Models\Improvement;
use App\Models\Part;
use App\Models\AssessmentImprovement;
use App\Process\PdfGenerator;

class SubmissionController extends Controller
{
    protected $pdf;

    public function __construct(PdfGenerator $pdf)
    {
        $this->pdf = $pdf;
    }

    /**
     * Show the Create Asessment form.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $improvements = Improvement::get([
            'id', 'title', 'part_id', 'description',
            'assessor_comment', 'assessor_guidance',
        ]);
        return view('submission.create', [
            'json_improvements' => $improvements->toJson(),
        ]);
    }

    /**
     * Show the Edit Asessment form.
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
        $assImps = AssessmentImprovement::where('assessment_id', '=', $id)->get();

        return view('submission.edit', [
            'json_form_schema' => json_encode(Assessment::formSchema()),
            'json_parts' => $parts->toJson(),
            'json_improvements' => $improvements->toJson(),
            'json_assessment' => $assessment->toJson(),
            'json_assessment_improvements' => $assImps->toJson(),
        ]);
    }

    /**
     * Process a Create Assessment form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubmissionRequest $request)
    {
        // create assessment data on the main table
        if ($request->has('assessment')) {
            $assessment = new Assessment();
            $assessment_data = $request->input('assessment');
            $assessment->fill($assessment_data);
            $assessment->save();
        }

        return response()->json([
            'status' => 'OK',
            'input' => $request->all(),
        ]);
    }

    /**
     * Process an Edit Assessment form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SubmissionRequest $request, $id)
    {
        $assessment = Assessment::findOrFail($id);

        // save assessment data on the main table
        if ($request->has('assessment')) {
            $assessment_data = $request->input('assessment');
            if ($request->andProcess) {
                $assessment_data['submitted'] = true;
            }
            $assessment->fill($assessment_data);
            $assessment->save();
        }

        // save improvement data on the related table
        $improvements_data = $request->input('improvements');
        $improvements_to_save = collect($improvements_data)->filter(function ($imp) {
            return isset($imp['value']) || isset($imp['comment']);
        })->map(function ($imp) use ($id) {
            if ($ass_imp = AssessmentImprovement::where([
                ['assessment_id', '=', $id],
                ['improvement_id', '=', $imp['improvement_id']],
            ])->first()) {
                $ass_imp->fill([
                    'value' => $imp['value'],
                    'comment' => $imp['comment'],
                ]);
                return $ass_imp;
            } else {
                return new AssessmentImprovement([
                    'value' => $imp['value'],
                    'comment' => $imp['comment'],
                    'improvement_id' => $imp['improvement_id'],
                ]);
            }
        });

        $assessment->assessment_improvements()->saveMany($improvements_to_save);

        // prepare pdf and send email
        if ($request->andProcess) {
            return $this->pdf->process($id, 'file');
        }

        return response()->json([
            'status' => 'OK',
            'input' => $request->all(),
        ]);
    }

    /**
     * Test the pdf output.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function pdfTest($id)
    {
        return $this->pdf->process($id, 'screen');
    }

}
