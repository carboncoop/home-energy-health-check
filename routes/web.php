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
    return view('welcome', []);
});

$crudControllers = [
    'improvement' => 'ImprovementCrudController',
    'section' => 'SectionCrudController',
    'report' => 'ReportCrudController',
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
