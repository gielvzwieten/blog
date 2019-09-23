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

// Pages routes
Route::get('/', 'PagesController@getIndex');
Route::get('/about', 'PagesController@getAbout');
Route::get('/contact', 'PagesController@getContact');
Route::post('/contact', 'PagesController@postContact');

// Posts routes
Route::resource('/posts', 'PostController');

// Categories routes
Route::resource('/categories', 'CategoryController', ['except' => ['create']]);

//Tags routes
Route::resource('/tags', 'TagController')->except('create');

// Blog routes
Route::get('/blog', 'BlogController@index')->name('blog.index');
Route::get('/blog/{post}/{slug}', 'BlogController@show')->name('blog.show');

// Comments routes
Route::post('comments/{post_id}', 'CommentsController@store')->middleware('auth');


Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
