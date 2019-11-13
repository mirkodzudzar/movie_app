<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;
use App\Movie;
use App\Profession;
use App\Photo;
use DB;
use App\Http\Requests\NewsCreateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class NewsController extends BaseController
{
    public function __construct()
    {
      parent::__construct();
      $this->middleware('auth', ['only' => 'store']);
      $this->middleware('author', ['only' => 'store']);
    }

    public function index()
    {
      $news = News::orderBy('created_at', 'desc')->paginate(5);
      $latest_news = News::orderBy('created_at', 'desc')->first();
      $latest_movie = Movie::orderBy('release_date', 'desc')->first();

      return view('front.news.index', compact('news', 'latest_news', 'latest_movie'));
    }

    public function store(NewsCreateRequest $request)
    {
      $input = $request->all();
      $input['user_id'] = Auth::user()->id;

      if($file = $request->file('photo_id'))
      {
        $name = time() . $file->getClientOriginalName();
        $file->move('images', $name);
        $photo = Photo::create(['file' => $name]);
        $input['photo_id'] = $photo->id;
      }

      News::create($input);

      Session::flash('created_news', 'Some news with title "'.$request->title.'" has been created.');

      return redirect('/news');
    }

    public function show($id)
    {
      $news = News::findOrFail($id);

      return view('front.news.show', compact('news'));
    }
}
