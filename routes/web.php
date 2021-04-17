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
    return view('welcome');
});


Route::get('/signin', function () {
    return view('auth.login');
});

Route::get('/signup', function () {
    return view('auth.register');
})->name("register");

Route::get('/issues', 'IssueController@index');
Route::get('/issues/{slug?}', 'IssueController@index');

Route::get('/issue/{slug?}/view', 'IssueController@view');


Auth::routes();

Route::group(['middleware' => ['auth']], function() {
    Route::get('/open-issue', 'IssueController@create');
    Route::get('/issue/{slug?}/delete', 'IssueController@delete');
    Route::post('/open-issue', 'IssueController@store')->name('open-issue');
    Route::get('/issue/{slug?}/edit', 'IssueController@edit');
    Route::post('/issue/{slug?}/edit', 'IssueController@update');
});

Route::get('/home', 'HomeController@index')->name('home');