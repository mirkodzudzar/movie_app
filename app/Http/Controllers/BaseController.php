<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Genre;
use Illuminate\Support\Facades\View;

class BaseController extends Controller
{
  public function __construct()
  {
    $genres = Genre::all();
    View::share('genres', $genres);
  }
}
