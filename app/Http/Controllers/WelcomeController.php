<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assessment;

class WelcomeController extends Controller
{
    public function welcome() {
        return view('welcome', [
            'assessments' => Assessment::all(),
        ]);
    }
}
