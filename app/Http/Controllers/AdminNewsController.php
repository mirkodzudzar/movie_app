<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;

class AdminNewsController extends Controller
{
    public function __construct()
    {
      $this->middleware('administrator');
    }

    public function index()
    {
      $news = News::all();

      return view('admin.news.index', compact('news'));
    }
}
