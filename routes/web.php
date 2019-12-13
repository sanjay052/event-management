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


Route::group(['middleware' => 'adminauth'], function () {
	Route::resource('locations', 'LocationController'); 
	Route::resource('categories', 'CategoryController'); 
	Route::get('/events/create', 'EventController@create')->name('events.create');
	Route::get('/events/{event}/edit', 'EventController@edit')->name('events.edit');
	Route::post('/events', 'EventController@store')->name('events.store');
	Route::patch('/events/{event}', 'EventController@update')->name('events.update');
	Route::delete('/events/{event}', 'EventController@destroy')->name('events.destroy');
});

Route::group(['middleware' => 'auth'], function () { 
	Route::resource('comments', 'CommentController');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/events/{id}', 'EventController@show')->name('events.show');
Route::get('/events', 'EventController@index')->name('events.index');




 

