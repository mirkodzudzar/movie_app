<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Genre;
use App\Movie;
use App\Profession;

class GenresController extends BaseController
{
  public function __construct()
  {
    parent::__construct();
  }

  public function show($id)
  {
    $genre = Genre::findOrFail($id);
    $movies = $genre->movies()->wherePivot('genre_id', $id)->orderBy('created_at', 'desc')->paginate(5);

    return view('front.genres.show', compact('genre', 'movies'));
  }
}
