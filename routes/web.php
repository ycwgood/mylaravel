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

Route::get('/', 'CaseController@index');

Route::get('info', function () {
    phpinfo();
});

Route::get('/tasks', 'TaskController@index');
Route::get('/task/{task}', 'TaskController@edit');
Route::post('/task', 'TaskController@store');
Route::delete('/task/{task}', 'TaskController@destroy');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/cases', 'CaseController@index');
Route::get('/case', 'CaseController@add');
Route::get('/case/{id}', 'CaseController@edit');
Route::post('/case', 'CaseController@store');
Route::delete('/case/{id}', 'CaseController@destroy');
Route::get('/cases/export', 'CaseController@export');
