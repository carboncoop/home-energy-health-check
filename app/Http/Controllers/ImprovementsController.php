<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Improvement;
use App\Jobs\CreatePdfDocument;

class ImprovementsController extends Controller
{

    /**
     * List improvements.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $improvements = Improvement::all();
        return view('improvements.index', compact('improvements'));
    }

    /**
     * Show the form for editing an improvement.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $improvement = Improvement::findOrFail($id);
        return view('improvements.edit', compact('improvement'));
    }

    /**
     * Update an improvement in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $improvement = Improvement::findOrFail($id);
        $fields = [ // TODO : validate
            'title' => $request->get('title'),
            'section_id' => $request->get('section_id'),
            'description' => $request->get('description'),
            'estimated_cost' => $request->get('estimated_cost'),
        ];
        $improvement->fill($fields);
        $improvement->save();
        return redirect()->route('improvements.index');
    }

}
