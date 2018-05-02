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

Route::get('/dashboard', 'HomeController@index');

// Route::get('/index', function () {
//     return view('content.indexcontent');
// })->middleware('auth');

Route::get('/index', function () {
    return view('content.main_dashboard');
});

Route::get('/tracking', function () {
    return view('content.tracking');
});

Route::get('/users', function () {
    return view('content.users');
});

Route::get('/reports', function () {
    return view('content.reports');
});

Route::get('/references/institutes', function () {
    return view('content.institutes');
});

Route::get('/references/documents', function () {
    return view('content.document');
});

Route::get('/references/offices', function () {
    return view('content.offices');
});

Route::get('/references/utype', function () {
    return view('content.usertype');
});


