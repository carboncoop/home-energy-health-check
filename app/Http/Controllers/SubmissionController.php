<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assessment;
use App\Models\Improvement;
use App\Models\Section;

class SubmissionController extends Controller
{
    /**
     * Show the Asessment form.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $assessment = Assessment::findOrFail($id);
        $sections = Section::get(['id', 'title', 'description']);
        $improvements = Improvement::get(['id', 'title', 'section_id', 'description', 'assessor_comment']);
        return view('submission.edit', [
            'sections' => $sections,
            'json_sections' => $sections->toJson(),
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
        foreach ($request->all() as $key => $data) {
            echo $key." - ".$data."\n";
        }
        //return redirect()->route('submit.edit', $id);
    }
}
