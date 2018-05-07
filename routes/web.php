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


Auth::routes();

Route::get('/logout', 'Auth\LoginController@logout');



// Route::get('/index', function () {
//     return view('content.indexcontent');
// })->middleware('auth');
Route::get('/index', 'GuestController@index');

Route::get('/dashboard', 'HomeController@index');

Route::get('/tracking', 'TrackingController@index');

Route::get('/users', 'UsersController@index');

Route::get('/references/utype', 'UsersController@utype');

Route::get('/reports', 'ReportsController@index');

Route::get('/references/institutes', 'InstituteController@index');

Route::get('/references/documents', 'DocumentController@index');

Route::get('/references/offices', 'AssocController@index');




