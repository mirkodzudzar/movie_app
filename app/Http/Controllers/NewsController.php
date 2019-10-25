<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;
use App\Movie;
use App\Genre;
use App\Profession;
use DB;
use View;

class NewsController extends Controller
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
      $news = News::paginate(5);
      $latest_news = News::orderBy('created_at', 'desc')->first();
      $latest_movie = Movie::orderBy('release_date', 'desc')->first();
      //WE NEED TO FIND TOP RATED MOVIE...
      $movie_user = DB::table('movie_user')->where('like', 1)->orderBy('like', 'desc')->first();
      $top_movie = Movie::where('id', $movie_user->movie_id)->first();

      return view('front.news.index', compact('news', 'latest_news', 'latest_movie'));
    }
}
