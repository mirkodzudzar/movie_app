<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use App\Genre;
use App\Profession;
use Illuminate\Support\Facades\View;

class MoviesController extends Controller
{
  public function __construct()
  {
    $genres = Genre::all();
    View::share('genres', $genres);
    $professions = Profession::all();
    View::share('professions', $professions);
  }

  public function index()
  {
    $movies = Movie::orderBy('created_at', 'desc')->paginate(5);

    return view('front.movies.index', compact('movies'));
  }

  public function show($id)
  {
    $movie = Movie::findOrFail($id);

    return view('front.movies.show', compact('movie'));
  }
}
