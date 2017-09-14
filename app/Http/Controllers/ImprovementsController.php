<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Improvement;

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

  public function store($data) {

  }

}
