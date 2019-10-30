<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Genre;
use App\Movie;
use App\Profession;
use Illuminate\Support\Facades\View;

class GenresController extends Controller
{
  public function __construct()
  {
    $genres = Genre::all();
    View::share('genres', $genres);
    $professions = Profession::all();
    View::share('professions', $professions);
  }

  public function show($id)
  {
    $genre = Genre::findOrFail($id);
    $movies = $genre->movies()->wherePivot('genre_id', $id)->orderBy('created_at', 'desc')->paginate(5);

    return view('front.genres.show', compact('genre', 'movies'));
  }
}
