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

/* Auth */
Route::group(['middleware' => ['auth']], function() {
	Route::resource('roles', 'RoleController');
	Route::resource('users', 'UserController');
});

/* Logout */
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
