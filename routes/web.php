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



Route::get('login/facebook', 'Auth\LoginController@redirectToProvider')->name('facebook_login');
Route::get('login/facebook/callback', 'Auth\LoginController@handleProviderCallback')->name('facebook_callback');

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');


Route::post('/notification/get', 'NotificationController@get');
Route::post('/notification/read', 'NotificationController@read');

Route::prefix('post')->group(function() {
	Route::get('/{type}', 'PostsController@index')->name('post','{type}');
	Route::get('/old/{type}', 'PostsController@index_old')->name('post_old','{type}');
	Route::get('/info/{id}', 'PostsController@post_info')->name('post_info','{id}');
	Route::post('/post{id}', 'PostsController@post_comm')->name('post_info_comm','{id}');
	Route::post('/favourite', 'FavouritesController@store')->name('favourite');
});



Route::prefix('account')->group(function() {
	Route::get('/', 'UserController@index')->name('account');
	Route::prefix('/postslist')->group(function() {
		Route::get('/', 'UserController@userPosts')->name('userposts');		
		Route::delete('/{id}', 'PostsController@destroy')->name('delectpost','{id}');
		Route::get('/edit_post/{id}', 'UserController@editPost_page')->name('user_editpost_page','{id}');
		Route::post('/edit_post/{id}', 'PostsController@editPost_edit')->name('user_editpost_edit','{id}');
	});
	
	Route::get('/newpost', 'UserController@newpost')->name('newpost');
	Route::post('/newpost/post', 'PostsController@newpost_post')->name('newpost_post');
	Route::post('/user/change_password', 'UserController@changePassword')->name('change_password');
	Route::post('/user/change_info', 'UserController@changeInfo')->name('change_info');
});

Route::prefix('favlist')->group(function() {
	Route::get('/', 'FavouritesController@index')->name('favlist');	
	Route::delete('/{id}', 'FavouritesController@destroy')->name('delectfav','{id}');
});





