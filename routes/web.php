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

Route::get('/pdf', 'ImprovementsController@try_pdf');


Route::resource('improvements', 'ImprovementsController', ['only' => [
    'index', 'edit', 'update'
]]);
