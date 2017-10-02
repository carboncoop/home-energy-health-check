<?php

use App\Models\Section;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome', []);
});

// TODO: remove when done
$input = [
    1 => [ 'value' => "need", 'comment' => "test comment" ],
    2 => [ 'value' => "need", 'comment' => "test comment" ],
    3 => [ 'value' => "need", 'comment' => "test comment" ],
    8 => [ 'value' => "need", 'comment' => "test comment" ],
    9 => [ 'value' => "need", 'comment' => "test comment" ],
    10 => [ 'value' => "need", 'comment' => "test comment" ],
];
$sections = Section::with('improvements')->get()->map(function ($sec) use ($input) {
    $sec->improvements = $sec->improvements->filter(function ($imp) use ($input) {
        return array_key_exists($imp->id, $input) &&
            $input[$imp->id]['value'] == 'need';
    });
    return $sec;
});
Route::get('pdf-test', function () use ($input, $sections) {
    return view('pdf.assessment', [
        'sections' => $sections,
        'input' => $input,
    ]);
});

$crudControllers = [
    'improvements' => 'ImprovementCrudController',
    'sections' => 'SectionCrudController',
    'assessments' => 'AssessmentCrudController',
];

Route::group([
    'prefix' => 'admin',
    'middleware' => ['admin'],
    'namespace' => 'Admin'
], function() use ($crudControllers) {
    foreach ($crudControllers as $slug => $controller) {
        \CRUD::resource($slug, $controller);
    }
});

Route::resource('submit', 'SubmissionController', [
    'only' => ['edit', 'update']
]);
