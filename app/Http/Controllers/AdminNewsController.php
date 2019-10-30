<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;
use Illuminate\Support\Facades\Session;

class AdminNewsController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
      $this->middleware('administrator');
    }

    public function index()
    {
      $news = News::all();

      return view('admin.news.index', compact('news'));
    }

    public function destroy($id)
    {
      $news = News::findOrFail($id);
      if($news->photo)
      {
        unlink(public_path() . $news->photo->file);
        $news->photo->delete();
      }
      $news->delete();
      Session::flash('deleted_news', 'News has been deleted.');

      return redirect('admin/news');
    }
}
