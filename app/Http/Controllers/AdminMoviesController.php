<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use App\Director;
use App\Genre;
use App\Http\Requests\MovieCreateRequest;
use App\Http\Requests\MovieEditRequest;
use Illuminate\Support\Facades\Session;

class AdminMoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movies = Movie::all();

        return view('admin.movies.index', compact('movies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Getting full name from accessor in Movie model
        $directors = Director::all()->pluck('full_name', 'id');
        //In this case, this method does not working because there is not a 'full_name' fild in movies table
        // $directors = Director::pluck('full_name', 'id')->all();
        $genres = Genre::all();

        return view('admin.movies.create', compact('directors', 'genres'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MovieCreateRequest $request)
    {
      $input = $request->all();
      $movie = Movie::create($input);
      //Attaching genres to the created movie, inserting values in genre_movie table
      $movie->genres()->attach($request->genre);
      Session::flash('created_movie', 'The movie '.$request->name.' has been created.');

      return redirect('admin/movies');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $movie = Movie::findOrFail($id);

        return view('admin.movies.show', compact('movie'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $movie = Movie::findOrFail($id);
        $genres = Genre::all();
        $directors = Director::all()->pluck('full_name', 'id');

        return view('admin.movies.edit', compact('movie', 'directors', 'genres'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MovieEditRequest $request, $id)
    {
      $movie = Movie::findOrFail($id);
      $input = $request->all();

      if($request->genre)
      {
        $movie->genres()->detach();
        //Attaching genres to the created movie, inserting values in genre_movie table
        $movie->genres()->attach($request->genre);
      }

      $movie->update($input);
      Session::flash('updated_movie', 'The movie '.$request->name.' has been updated.');

      return redirect('admin/movies');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);
        //Detaching all movie genres from genre_movie table
        $movie->genres()->detach();
        $movie->delete();
        Session::flash('deleted_movie', 'The movie '.$movie->name.' has been deleted.');

        return redirect('admin/movies');
    }
}
