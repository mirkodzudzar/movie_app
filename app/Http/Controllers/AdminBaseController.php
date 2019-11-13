<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use App\Celebrity;
use App\User;
use App\News;
use App\Genre;
use App\Price;
use App\Profession;
use App\Role;
use DB;
use Illuminate\Support\Facades\View;

class AdminBaseController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
    $this->middleware('administrator');

    $movies_count = Movie::count();
    $celebrities_count = Celebrity::count();
    $users_count = User::count();
    $all_image_count = DB::table('imageables')->count();
    $celebritie_image_count = DB::table('imageables')->where('imageable_type', 'App\Celebrity')->count();
    $movie_image_count = DB::table('imageables')->where('imageable_type', 'App\Movie')->count();
    $news_count = News::count();
    $genres_count = Genre::count();
    $prices_count = Price::count();
    $professions_count = Profession::count();
    $roles_count = Role::count();

    View::share([
      'movies_count' => $movies_count,
      'celebrities_count' => $celebrities_count,
      'users_count' => $users_count,
      'all_image_count' => $all_image_count,
      'celebritie_image_count' => $celebritie_image_count,
      'movie_image_count' => $movie_image_count,
      'news_count' => $news_count,
      'genres_count' => $genres_count,
      'prices_count' => $prices_count,
      'professions_count' => $professions_count,
      'roles_count' => $roles_count
    ]);


    // $movies_count = Movie::count();
    // View::share('movies_count', $movies_count);
    // $celebrities_count = Celebrity::count();
    // View::share('celebrities_count', $celebrities_count);
    // $users_count = User::count();
    // View::share('users_count', $users_count);
    // $all_image_count = DB::table('imageables')->count();
    // View::share('all_image_count', $all_image_count);
    // $celebritie_image_count = DB::table('imageables')->where('imageable_type', 'App\Celebrity')->count();
    // View::share('celebritie_image_count', $celebritie_image_count);
    // $movie_image_count = DB::table('imageables')->where('imageable_type', 'App\Movie')->count();
    // View::share('movie_image_count', $movie_image_count);
    // $news_count = News::count();
    // View::share('news_count', $news_count);
    // $genres_count = Genre::count();
    // View::share('genres_count', $genres_count);
    // $prices_count = Price::count();
    // View::share('prices_count', $prices_count);
    // $professions_count = Profession::count();
    // View::share('professions_count', $professions_count);
    // $roles_count = Role::count();
    // View::share('roles_count', $roles_count);
  }
}
