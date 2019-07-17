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

Route::get('/', 'GuestController@index');
Route::post('/tracking/guest_search', 'GuestController@search');

Route::get('/index', 'GuestController@index');

Route::get('/dashboard', 'HomeController@index');

Route::get('/testmail', 'TrackingController@testmail');
Route::get('/tracking', 'TrackingController@index');
Route::get('/tracking/addnew', 'TrackingController@trackingAdd');
Route::get('/tracking/view/{id}', 'TrackingController@view');
Route::get('/tracking/finished', 'TrackingController@finished');
Route::get('/tracking/printattach/{id}', 'TrackingController@print_track_attachment');
Route::get('/tracking/startprocess/{id}', 'TrackingController@start_tracking');
Route::get('/tracking/cancelprocess/{id}', 'TrackingController@cancel_tracking');
Route::get('/tracking/finishprocess/{id}', 'TrackingController@finish_tracking');
Route::get('/tracking/recieve/{id}/{proc_id}', 'TrackingController@recieve');
Route::get('/tracking/release/{id}/{proc_id}', 'TrackingController@release');
Route::post('/tracking/addnew', 'TrackingController@trackingSave');
Route::post('/tracking/addremark', 'TrackingController@remarkSave');
Route::post('/tracking/search', 'TrackingController@search');
Route::post('/tracking/advancesearch', 'TrackingController@advancesearch');
Route::post('/tracking/trackingrecieve', 'TrackingController@recieveSave');
Route::post('/tracking/trackingrelease', 'TrackingController@releaseSave');
Route::post('/tracking/trackingremarks', 'TrackingController@remarksSave');
Route::post('/tracking/updateattachment', 'TrackingController@add_attachments');

Route::get('/users', 'UsersController@index');
Route::get('/users/addnew', 'UsersController@usersAdd');
Route::post('/users/addnew', 'UsersController@usersSave');
Route::get('/users/edit/{id}', 'UsersController@usersEdit');
Route::post('/users/saveedit', 'UsersController@usersSaveedit');


Route::get('/references/utype', 'UsersController@utype');

Route::get('/reports', 'ReportsController@index');

Route::get('/references/institutes', 'InstituteController@index');
Route::get('/references/institutes/edit/{id}', 'InstituteController@insEdit');
Route::post('/references/institutes/editsave', 'InstituteController@saveEditIns');
Route::post('/references/institutes', 'InstituteController@saveIns');
Route::get('/references/institutes/enable/{id}', 'InstituteController@insEnable');
Route::get('/references/institutes/disable/{id}', 'InstituteController@insDisable');

Route::get('/references/documents', 'DocumentController@index');
Route::get('/references/documents/edit/{id}', 'DocumentController@docEdit');
Route::post('/references/documents/edit', 'DocumentController@docSaveEdit');
Route::get('/references/documents/enable/{id}', 'DocumentController@docEnable');
Route::get('/references/documents/disable/{id}', 'DocumentController@docDisable');
Route::get('/references/documents/addnew', 'DocumentController@docAdd');
Route::post('/references/documents/addnew', 'DocumentController@saveDocty');

Route::get('/references/offices', 'AssocController@index');
Route::get('/references/offices/edit/{id}', 'AssocController@assEdit');
Route::post('/references/offices/editsave', 'AssocController@saveEditOff');
Route::post('/references/offices', 'AssocController@saveAssoc');
Route::get('/references/offices/enable/{id}', 'AssocController@offEnable');
Route::get('/references/offices/disable/{id}', 'AssocController@offDisable');




