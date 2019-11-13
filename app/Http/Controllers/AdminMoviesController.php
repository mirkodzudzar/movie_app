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
use Illuminate\Support\Facades\Input;

class AdminMoviesController extends AdminBaseController
{
    public function __construct()
    {
      parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //We need to sort movies by number of votes(likes or dislikes)
        $movies = Movie::all();
        $professions = Profession::all();
        $query = Input::get('query');

        if($query != '')
        {
          $movie = Movie::where('name', 'LIKE', '%' . $query . '%')->get();
          if(count($movie) > 0)
          {
            return view('admin.movies.index', compact('movies', 'professions'))->withDetails($movie)->withQuery($query);
          }

          return view('admin.movies.index', compact('movies', 'professions'))->withMessage('No movies found!');
        }

        return view('admin.movies.index', compact('movies', 'professions'));
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
        $profession = Profession::where('name', 'director')->orWhere('id', 1)->first();
        $celebrities = Celebrity::all()->sortBy('last_name');//paginate(5)

        return view('admin.movies.create', compact('genres', 'profession', 'celebrities'));
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
      $movie->celebrities()->attach($request->celebrity, ['profession_id' => $request->profession_id]);
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
        $professions = Profession::all();

        return view('admin.movies.show', compact('movie', 'professions'));
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
        $profession = Profession::where('name', 'director')->orWhere('id', 1)->first();
        $celebrities = Celebrity::all();

        // $celebrities = Celebrity::all()->pluck('full_name', 'id');

        return view('admin.movies.edit', compact('movie', 'genres', 'profession', 'celebrities'));
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

      if($request->celebrity == null)
      {
        $movie->celebrities()->wherePivot('movie_id', $id)->detach();
      }
      else
      {
        $movie->celebrities()->wherePivot('movie_id', $id)->detach();
        //Attaching celebrities to the created movie, inserting values in celebrity_movie table, also with specific profession
        $movie->celebrities()->attach($request->celebrity, ['profession_id' => $request->profession_id]);
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
        //Detaching all movie genres, users and celebrities from pivot tables
        $movie->genres()->detach();
        $movie->users()->detach();
        $movie->celebrities()->detach();
        // $movie->price()->dissociate();
        $movie->delete();
        Session::flash('deleted_movie', 'The movie '.$movie->name.' has been deleted.');

        return redirect('admin/movies');
    }
}
