<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Improvement;
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
        $improvements = Improvement::all();
        $report = Report::findOrFail($id);
        return view('submission.show', [
            'improvements' => $improvements,
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
        return redirect()->route('submit.edit', $id);
    }
}
