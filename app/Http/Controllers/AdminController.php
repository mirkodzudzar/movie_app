<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use App\Celebrity;
use App\User;
use App\News;
use DB;

class AdminController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
    $this->middleware('administrator');
  }

  public function index()
  {
      $movies_count = Movie::count();
      $celebrities_count = Celebrity::count();
      $users_count = User::count();
      $celebritie_image_count = DB::table('imageables')->where('imageable_type', 'App\Celebrity')->count();
      $movie_image_count = DB::table('imageables')->where('imageable_type', 'App\Movie')->count();
      $news_count = News::count();

      return view('admin.index', compact('movies_count', 'celebrities_count', 'users_count', 'celebritie_image_count', 'movie_image_count', 'news_count'));
  }
}
