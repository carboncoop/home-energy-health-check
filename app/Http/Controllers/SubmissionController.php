<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Improvement;
use App\Models\Section;
use App\Models\Report;

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
        $sections = Section::all();
        $report = Report::findOrFail($id);
        return view('submission.edit', [
            'sections' => $sections,
            'report' => $report,
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
        dd($request->request);
        return redirect()->route('submit.edit', $id);
    }
}
