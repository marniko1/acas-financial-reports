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

// no email verification
Auth::routes(['register'=>false]);

// after adding, email verification
// Auth::routes(['verify' => true]);



Route::group(['middleware' => 'auth'], function() {

	Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
	Route::get('/', [ 'as' => 'donators', 'uses' => 'DatatablesController@index']);


	Route::group(['middleware' => 'is_admin'], function() {

		Route::resource('/users', 'UserController');
		Route::post('/add_user', 'AdminController@addUser')->name('add_user');
		// Route::put('/users', 'UserController@addUser')->name('edit_user');
	});

});

