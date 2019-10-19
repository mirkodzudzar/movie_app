<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use App\Celebrity;
use App\Genre;
use App\Profession;
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
        //We need to sort movies by number of votes(likes or dislikes)
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
        // $celebrities = Celebrity::where('celeb_role', 1)->pluck('full_name', 'id');
        //In this case, this method does not working because there is not a 'full_name' fild in movies table
        // $directors = Director::pluck('full_name', 'id')->all();
        $genres = Genre::all();
        $professions = Profession::all();
        $celebrities = Celebrity::all();//paginate(5)

        return view('admin.movies.create', compact('genres', 'professions', 'celebrities'));
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
        $professions = Profession::all();
        $celebrities = Celebrity::all();

        // $celebrities = Celebrity::all()->pluck('full_name', 'id');

        return view('admin.movies.edit', compact('movie', 'genres', 'professions', 'celebrities'));
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

      //We can uncheck all checkboxes and leave everything empty
      if($request->genre == null)
      {
        $movie->genres()->detach();
      }

      else
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
        $movie->users()->detach();
        $movie->celebrities()->detach();
        // $movie->price()->dissociate();
        $movie->delete();
        Session::flash('deleted_movie', 'The movie '.$movie->name.' has been deleted.');

        return redirect('admin/movies');
    }
}
