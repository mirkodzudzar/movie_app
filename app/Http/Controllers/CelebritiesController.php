<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profession;
use App\Celebrity;

class CelebritiesController extends BaseController
{
    public function __construct()
    {
      parent::__construct();
    }

    public function index()
    {
      $celebrities = Celebrity::orderBy('created_at', 'desc')->paginate(5);

      return view('front.celebrities.index', compact('celebrities'));
    }

    public function show($id)
    {
      $professions = Profession::all();
      $celebrity = Celebrity::findOrFail($id);
      $movies = $celebrity->movies()->wherePivot('celebrity_id', $id)->orderBy('created_at', 'desc')->paginate(5);

      return view('front.celebrities.show', compact('celebrity', 'movies', 'professions'));
    }
}
