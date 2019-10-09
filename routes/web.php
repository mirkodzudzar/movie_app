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

//Prefix 'admin' adds a admin in fron of every route in this group
Route::group(['prefix' => 'admin'], function(){
  Route::resource('users', 'AdminUsersController', ['names' => [
      'index' => 'admin.users.index',
      'create' => 'admin.users.create',
      'store' => 'admin.users.store',
      'show' => 'admin.users.show',
      'edit' => 'admin.users.edit',
      // 'administrator' => 'admin.users.administrator',
      // 'subscriber' => 'admin.users.subscriber',
    ]]);

  Route::resource('movies', 'AdminMoviesController', ['names' => [
    'index' => 'admin.movies.index',
    'create' => 'admin.movies.create',
    'store' => 'admin.movies.store',
    'show' => 'admin.movies.show',
    'edit' => 'admin.movies.edit',
    ]]);

  Route::get('/', ['as' => 'admin.index' , 'uses' => 'AdminController@index']);
});
