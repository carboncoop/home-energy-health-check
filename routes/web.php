<?php

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
    return view('welcome', ['foo' => 'routing', 'fii' => 43]);
});

Route::group(['prefix' => 'admin', 'middleware' => ['admin'], 'namespace' => 'Admin'], function() {
    \CRUD::resource('improvement', 'ImprovementCrudController');
});

Route::group(['prefix' => 'admin', 'middleware' => ['admin'], 'namespace' => 'Admin'], function() {
    \CRUD::resource('section', 'SectionCrudController');
});

Route::group(['prefix' => 'admin', 'middleware' => ['admin'], 'namespace' => 'Admin'], function() {
    \CRUD::resource('report', 'ReportCrudController');
});


Route::resource('improvements', 'ImprovementsController', [
    'only' => ['index', 'edit', 'update']
]);

Route::resource('reports', 'ReportsController', [
    'only' => ['index', 'edit', 'update']
]);

Route::resource('submit', 'SubmissionController', [
    'only' => ['edit', 'update']
]);
