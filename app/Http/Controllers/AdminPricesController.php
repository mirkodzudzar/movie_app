<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;

class AdminPricesController extends Controller
{
    public function index()
    {
      $movies = Movie::all();

      return view('admin.prices.index', compact('movies'));
    }
}
