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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
// Route::get('/user/{id}/profile', 'HomeController@profile')->name('Profile');

// Route::get('/user/{id}/editprofile', 'HomeController@edit_profile')->name('editProfile');
// Route::post('/user/{id}/editprofile', 'HomeController@edit_profile_post')->name('editProfilePost');

// Route::get('/user/{id}/apply', 'HomeController@apply')->name('ApplyPost');
// Route::post('/user/{id}/apply', 'HomeController@apply_post')->name('ApplyPost');


Route::prefix('user')->group(function (){
	Route::get('/{id}/profile', 'HomeController@profile')->name('Profile');

	Route::get('/{id}/editprofile', 'HomeController@edit_profile')->name('editProfile');
	Route::post('/{id}/editprofile', 'HomeController@edit_profile_post')->name('editProfilePost');

	Route::get('/{id}/apply', 'HomeController@apply')->name('ApplyPost');
	Route::post('/{id}/apply', 'HomeController@apply_post')->name('ApplyPost');
});


// Route::get('/company/dashboard', 'HomeController@company_dashboard')->name('company_dashboard');

// Route::get('/company/newpost', 'HomeController@newPost')->name('new_post');
// Route::post('/company/newpost', 'HomeController@newPostStore')->name('new_post_store');

Route::prefix('/company')->group(function (){
	Route::get('/dashboard', 'HomeController@company_dashboard')->name('company_dashboard');
	Route::get('/newpost', 'HomeController@newPost')->name('new_post');
	Route::post('/newpost', 'HomeController@newPostStore')->name('new_post_store');
});
