<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Improvement;
use App\Jobs\CreatePdfDocument;

class ImprovementsController extends Controller {

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index() {
    $improvements = Improvement::all();
    return view('index', compact('improvements'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id) {
    $improvement = Improvement::findOrFail($id);
    return view('edit', compact('improvement'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id) {
    $improvement = Improvement::findOrFail($id);
    $fields = [
      'title' => $request->get('title'),
      'description' => $request->get('description'),
      'estimated_cost' => $request->get('estimated_cost'),
    ];
    $improvement->fill($fields);
    $improvement->save();
    return redirect()->action('ImprovementsController@index');
  }

  /**
   * TODO: this is just a quick test
   */
  public function try_pdf() {
    $improvements = Improvement::all()->toArray();
    //dd($improvements);
    $pdf = PDF::loadView('index', ['improvements' => $improvements])
      ->setPaper('a4', 'portrait');
    return $pdf->stream('this_should_just_say_hello_world.pdf');
  }

}
