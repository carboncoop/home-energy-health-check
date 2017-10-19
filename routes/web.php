<?php

use App\Models\Part;
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

Route::get('/', 'WelcomeController@welcome');

Route::resource('submit', 'SubmissionController', [
    'only' => ['create', 'edit', 'update']
]);
Route::put('submit', 'SubmissionController@store');
Route::get('pdf-test/{id}', 'SubmissionController@pdfTest');


$crudControllers = [
    'improvements' => 'ImprovementCrudController',
    'parts' => 'PartCrudController',
    'assessments' => 'AssessmentCrudController',
    'sections' => 'SectionCrudController',
    'users' => 'UserCrudController',
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
