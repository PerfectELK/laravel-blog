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

Use App\Material;
Use App\Http\Controllers\CommentController;

Route::get('/', function () {
    $materials = Material::all();
    return view('main', compact('materials'));
});

Route::get('/views/{id}', 'MaterialController@viewMaterial');

Route::post('/viewComment', 'CommentController@viewComment');

Route::post('/addComment', 'CommentController@insertComment');

Route::get('/admin','AdminController@auth');

Route::post('/confirm','AdminController@check');

Route::post('/create', 'MaterialController@create');

Route::post('/delete/{id}', 'MaterialController@delete');

Route::get('/logout', 'AdminController@logout');

Route::get('/change-material/{id}', 'MaterialController@change');

Route::post('/changeComment','CommentController@changeComment');

Route::post('/removeComment','CommentController@removeComment');