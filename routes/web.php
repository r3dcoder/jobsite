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

Route::prefix('user')->group(function (){
	Route::get('/{id}/profile', 'ApplicantController@profile')->name('Profile');
	Route::get('/{id}/editprofile', 'ApplicantController@edit_profile')->name('editProfile');
	Route::post('/{id}/editprofile', 'ApplicantController@edit_profile_post')->name('editProfilePost');
	Route::get('/{id}/apply', 'ApplicantController@apply')->name('ApplyPost');
	Route::post('/{id}/apply', 'ApplicantController@apply_post')->name('ApplyPost');
});

Route::prefix('/company')->group(function (){
	Route::get('/dashboard', 'HomeController@company_dashboard')->name('company_dashboard');
	Route::get('/newpost', 'HomeController@newPost')->name('new_post');
	Route::post('/newpost', 'HomeController@newPostStore')->name('new_post_store');
});
