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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

//Controllers for front pages
//News controller
Route::get('news', ['as' => 'front.news.index' , 'uses' => 'NewsController@index']);
Route::post('news', ['as' => 'front.news.index', 'uses' => 'NewsController@store']);
Route::get('news/{news}', ['as' => 'front.news.show' , 'uses' => 'NewsController@show']);

//Users controller
Route::get('users/{user}', ['as' => 'front.users.show' , 'uses' => 'UsersController@show']);
Route::get('users/{user}/edit', ['as' => 'front.users.edit' , 'uses' => 'UsersController@edit']);
Route::patch('users/{user}', 'UsersController@update');

//Movies controller
Route::get('movies', ['as' => 'front.movies.index' , 'uses' => 'MoviesController@index']);
Route::get('movies/{movie}', ['as' => 'front.movies.show' , 'uses' => 'MoviesController@show']);

//Genres controller
Route::get('genres/{genre}', ['as' => 'front.genres.show' , 'uses' => 'GenresController@show']);

//Prefix 'admin' adds a admin in fron of every route in this group
Route::group(['prefix' => 'admin'], function(){
    //Users controller
    Route::resource('users', 'AdminUsersController', ['names' => [
        'index' => 'admin.users.index',
        'create' => 'admin.users.create',
        'store' => 'admin.users.store',
        'show' => 'admin.users.show',
        'edit' => 'admin.users.edit',
        // 'administrator' => 'admin.users.administrator',
        // 'subscriber' => 'admin.users.subscriber',
      ]]);
    Route::post('/users/search', 'AdminUsersController@index');

    //Movies controller
    Route::resource('movies', 'AdminMoviesController', ['names' => [
      'index' => 'admin.movies.index',
      'create' => 'admin.movies.create',
      'store' => 'admin.movies.store',
      'show' => 'admin.movies.show',
      'edit' => 'admin.movies.edit',
      ]]);
    Route::post('/movies/search', 'AdminMoviesController@index');

    //Celebrities controller
    Route::resource('celebrities', 'AdminCelebritiesController', ['names' => [
      'index' => 'admin.celebrities.index',
      'create' => 'admin.celebrities.create',
      'store' => 'admin.celebrities.store',
      'show' => 'admin.celebrities.show',
      'edit' => 'admin.celebrities.edit',
      ]]);
    Route::post('/celebrities/search', 'AdminCelebritiesController@index');

    //Admin controller
    Route::get('/', ['as' => 'admin.index' , 'uses' => 'AdminController@index']);

    //Roles controller
    Route::get('roles', ['as' => 'admin.roles.index' , 'uses' => 'AdminRolesController@index']);
    Route::post('roles', ['as' => 'admin.roles.index' , 'uses' => 'AdminRolesController@store']);
    Route::get('roles/{role}/edit', ['as' => 'admin.roles.edit' , 'uses' => 'AdminRolesController@edit']);
    Route::patch('roles/{role}', 'AdminRolesController@update');
    Route::delete('roles/{role}', 'AdminRolesController@destroy');
    Route::post('/roles/search', 'AdminRolesController@index');

    //Genres controller
    Route::get('genres', ['as' => 'admin.genres.index' , 'uses' => 'AdminGenresController@index']);
    Route::post('genres', ['as' => 'admin.genres.index' , 'uses' => 'AdminGenresController@store']);
    Route::get('genres/{genre}/edit', ['as' => 'admin.genres.edit' , 'uses' => 'AdminGenresController@edit']);
    Route::patch('genres/{genre}', 'AdminGenresController@update');
    Route::delete('genres/{genre}', 'AdminGenresController@destroy');
    Route::post('/genres/search', 'AdminGenresController@index');

    //Professions controller
    Route::get('professions', ['as' => 'admin.professions.index' , 'uses' => 'AdminProfessionsController@index']);
    Route::post('professions', ['as' => 'admin.professions.index' , 'uses' => 'AdminProfessionsController@store']);
    Route::get('professions/{profession}/edit', ['as' => 'admin.professions.edit' , 'uses' => 'AdminProfessionsController@edit']);
    Route::patch('professions/{profession}', 'AdminProfessionsController@update');
    Route::delete('professions/{profession}', 'AdminProfessionsController@destroy');
    Route::get('professions/edit_profession/{id}/{movieId}', ['as' => 'admin.professions.edit_profession' , 'uses' => 'AdminProfessionsController@editProfession']);
    Route::patch('professions/edit_profession/{id}/{movieId}', 'AdminProfessionsController@updateProfession');
    Route::post('/professions/search', 'AdminProfessionsController@index');

    //Prices controller
    Route::get('prices', ['as' => 'admin.prices.index' , 'uses' => 'AdminPricesController@index']);
    Route::post('prices', ['as' => 'admin.prices.create' , 'uses' => 'AdminPricesController@store']);
    Route::get('prices/{price}/edit', ['as' => 'admin.prices.edit' , 'uses' => 'AdminPricesController@edit']);
    Route::patch('prices/{price}', 'AdminPricesController@update');
    Route::delete('prices/{price}', 'AdminPricesController@destroy');
    Route::post('/prices/search', 'AdminPricesController@index');

    //Images controller
    Route::get('images', ['as' => 'admin.images.index' , 'uses' => 'AdminImagesController@index']);
    Route::post('images', ['as' => 'admin.images.index' , 'uses' => 'AdminImagesController@store']);
    Route::delete('images/celebrities/{id}/{celebrity_id}', 'AdminImagesController@destroyCelebrityImage');
    Route::delete('images/movies/{id}/{movie_id}', 'AdminImagesController@destroyMovieImage');

    Route::get('news', ['as' => 'admin.news.index' , 'uses' => 'AdminNewsController@index']);
    Route::delete('news/{news}', 'AdminNewsController@destroy');

});
