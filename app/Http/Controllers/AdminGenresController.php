<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Genre;
use App\Http\Requests\GenreCreateRequest;
use App\Http\Requests\GenreEditRequest;
use Illuminate\Support\Facades\Session;

class AdminGenresController extends Controller
{
    public function index()
    {
      $genres = Genre::all()->sortBy('name');

      return view('admin.genres.index', compact('genres'));

      // $genre = Genre::whereId(1)->first();
      //
      // echo $genre->pivot->movie_id;
    }

    public function store(GenreCreateRequest $request)
    {
      $input = $request->all();
      Genre::create($input);
      Session::flash('created_genre', 'The genre '.$request->name.' has been created.');

      return redirect('admin/genres');
    }

    public function edit($id)
    {
      $genre = Genre::findOrFail($id);

      return view('admin.genres.edit', compact('genre'));
    }

    public function update(GenreEditRequest $request, $id)
    {
        $genre = Genre::findOrFail($id);
        $input = $request->all();
        $genre->update($input);
        Session::flash('updated_genre', 'The genre '.$request->name.' has been updated.');

        return redirect('/admin/genres');
    }

    public function destroy($id)
    {
      $genre = Genre::findOrFail($id);
      $genre->delete();
      Session::flash('deleted_genre', 'The genre '.$genre->name.' has been deleted.');

      return redirect('admin/genres');
    }
}
