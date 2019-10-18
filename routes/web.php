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

  Route::resource('celebrities', 'AdminCelebritiesController', ['names' => [
    'index' => 'admin.celebrities.index',
    'create' => 'admin.celebrities.create',
    'store' => 'admin.celebrities.store',
    'show' => 'admin.celebrities.show',
    'edit' => 'admin.celebrities.edit',
    ]]);

    Route::get('/', ['as' => 'admin.index' , 'uses' => 'AdminController@index']);

    Route::get('roles', ['as' => 'admin.roles.index' , 'uses' => 'AdminRolesController@index']);
    Route::post('roles', ['as' => 'admin.roles.index' , 'uses' => 'AdminRolesController@store']);
    Route::get('roles/{role}', ['as' => 'admin.roles.edit' , 'uses' => 'AdminRolesController@edit']);
    Route::patch('roles/{role}', 'AdminRolesController@update');
    Route::delete('roles/{role}', 'AdminRolesController@destroy');

    Route::get('genres', ['as' => 'admin.genres.index' , 'uses' => 'AdminGenresController@index']);
    Route::post('genres', ['as' => 'admin.genres.index' , 'uses' => 'AdminGenresController@store']);
    Route::get('genres/{genre}', ['as' => 'admin.genres.edit' , 'uses' => 'AdminGenresController@edit']);
    Route::patch('genres/{genre}', 'AdminGenresController@update');
    Route::delete('genres/{genre}', 'AdminGenresController@destroy');

    Route::get('professions', ['as' => 'admin.professions.index' , 'uses' => 'AdminProfessionsController@index']);
    Route::post('professions', ['as' => 'admin.professions.index' , 'uses' => 'AdminProfessionsController@store']);
    Route::get('professions/{profession}', ['as' => 'admin.professions.edit' , 'uses' => 'AdminProfessionsController@edit']);
    Route::patch('professions/{profession}', 'AdminProfessionsController@update');
    Route::delete('professions/{profession}', 'AdminProfessionsController@destroy');

    Route::get('prices', ['as' => 'admin.prices.index' , 'uses' => 'AdminPricesController@index']);
    Route::post('prices', ['as' => 'admin.prices.create' , 'uses' => 'AdminPricesController@store']);
    Route::get('prices/{price}', ['as' => 'admin.prices.edit' , 'uses' => 'AdminPricesController@edit']);
    Route::patch('prices/{price}', 'AdminPricesController@update');
    Route::delete('prices/{price}', 'AdminPricesController@destroy');

});
