<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Improvement;

class ImprovementsController extends Controller {

  public function index() {
    $improvements = Improvement::all();
    return view('index', compact('improvements'));
  }


}
