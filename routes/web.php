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

/* Home */
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');

/* Form */

Route::get('/confirmForm', 'ConfirmFormController@create')->name('confirmForm');
Route::get('/verifyForm', 'VerifyFormController@create')->name('verifyForm');
Route::get('/WalkinCaseForm', array(
						'as'   => 'walkincase.create',
						'uses' => 'WalkInCaseController@create'
					));
Route::post('/WalkinCaseForm', array(
						'as'   => 'walkincase.store',
						'uses' => 'WalkInCaseController@store'
					));

Route::get('/confirmForm/{id}', 'ConfirmFormController@create')->name('confirmForm');
Route::post('confirmCase', 'ConfirmFormController@addConfirmCase')->name('confirmCase');
//Route::get('/verifyForm', 'VerifyFormController@create')->name('verifyForm');


/* Invest list */
Route::resource('investList', 'InvestListController');

/* fetch district, fetch sub-district */
Route::post('province/district', 'ConfirmFormController@districtFetch')->name('districtFetch');
Route::post('province/district/sub-district', 'ConfirmFormController@subDistrictFetch')->name('subDistrictFetch');

/* Auth */
Route::group(['middleware' => ['auth']], function() {
	Route::resource('roles', 'RoleController');
	Route::resource('users', 'UserController');
});


/* Contact */
Route::get('/indexcasetable', 'ContactController@indexcasetable')->name('indexcasetable');
Route::get('/contacttable', 'ContactController@contacttable')->name('contacttable');
Route::get('/contactfollowtable', 'ContactController@contactfollowtable')->name('contactfollowtable');
Route::get('/addcontact', 'ContactController@addcontact')->name('addcontact');
Route::post('/addcontact/fetch', 'ContactController@fetch')->name('dropdown.fetch');
Route::post('/addcontact/fetchD', 'ContactController@fetchD')->name('dropdown.fetchD');
Route::get('/followupcontact', 'ContactController@followupcontact')->name('followupcontact');
Route::post('/followupcontactinsert', 'ContactController@followupcontactinsert')->name('followupcontactinsert');
Route::post('/contactinsert', 'ContactController@contactinsert')->name('contactinsert');

/* Logout */
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
