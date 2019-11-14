<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use App\Profession;
use Illuminate\Support\Facades\Auth;
use DB;

class MoviesController extends BaseController
{
  public function __construct()
  {
    parent::__construct();
    $this->middleware('auth', ['only' => ['like', 'dislike', 'ratings']]);
  }

  public function index()
  {
    $movies = Movie::orderBy('release_date', 'desc')->paginate(5);

    return view('front.movies.index', compact('movies'));
  }

  public function show($id)
  {
    $professions = Profession::all();
    $movie = Movie::findOrFail($id);

    return view('front.movies.show', compact('movie', 'professions'));
  }

  public function like($id)
  {
    $movie = Movie::findOrFail($id);
    $user_id = Auth::user()->id;

    $movie_user = DB::table('movie_user')->where('movie_id', $id)->where('user_id', $user_id)->first();
    if($movie_user == null)
    {
      $movie->users()->attach($user_id, ['like' => 1]);
    }
    elseif($movie_user->like == 0)
    {
      $movie->users()->detach($user_id);
      $movie->users()->attach($user_id, ['like' => 1]);
    }
    else
    {
      $movie->users()->detach($user_id);
    }

    return redirect()->back();
  }

  public function dislike($id)
  {
    $movie = Movie::findOrFail($id);
    $user_id = Auth::user()->id;

    $movie_user = DB::table('movie_user')->where('movie_id', $id)->where('user_id', $user_id)->first();
    if($movie_user == null)
    {
      $movie->users()->attach($user_id, ['like' => 0]);
    }
    elseif($movie_user->like == 1)
    {
      $movie->users()->detach($user_id);
      $movie->users()->attach($user_id, ['like' => 0]);
    }
    else
    {
      $movie->users()->detach($user_id);
    }

    return redirect()->back();
  }

  //We need to improve this code because if ratigns() returns a null then in a blade we need to check for that. So we need to check for null value before it goes to blade
  public function ratings($user_id)
  {
    $movies = Movie::ratings($user_id);

    if(Auth::user()->id == $user_id)
    {
      return view('front.movies.ratings', compact('movies'));
    }
    else
    {
      return redirect()->back();
    }
  }
}
