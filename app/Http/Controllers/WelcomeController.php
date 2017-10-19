<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assessment;

class WelcomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function welcome() {
        return view('welcome', [
            'assessments' => Assessment::all(),
        ]);
    }
}
