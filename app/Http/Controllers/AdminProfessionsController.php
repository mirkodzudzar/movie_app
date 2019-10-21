<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profession;
use App\Movie;
use App\Celebrity;
use App\Http\Requests\ProfessionCreateRequest;
use App\Http\Requests\ProfessionEditRequest;
use App\Http\Requests\ProfessionEditProfessionRequest;
use Illuminate\Support\Facades\Session;
use DB;

class AdminProfessionsController extends Controller
{
  public function index()
  {
    $professions = Profession::all()->sortBy('name');

    return view('admin.professions.index', compact('professions'));
  }

  public function store(ProfessionCreateRequest $request)
  {
    $input = $request->all();
    Profession::create($input);
    Session::flash('created_profession', 'The profession '.$request->name.' has been created.');

    return redirect('admin/professions');
  }

  public function edit($id)
  {
    $profession = Profession::findOrFail($id);

    return view('admin.professions.edit', compact('profession'));
  }

  public function update(ProfessionEditRequest $request, $id)
  {
      $profession = Profession::findOrFail($id);
      $input = $request->all();
      $profession->update($input);
      Session::flash('updated_profession', 'The profession '.$request->name.' has been updated.');

      return redirect('/admin/professions');
  }

  public function destroy($id)
  {
    $profession = Profession::findOrFail($id);
    $profession->delete();
    Session::flash('deleted_profession', 'The profession '.$profession->name.' has been deleted.');

    return redirect('admin/professions');
  }

  public function editProfession($id, $movieId)
  {
    $profession = Profession::findOrFail($id);
    $movie = movie::findOrFail($movieId);
    $celebrities = Celebrity::all();
    $celebrity_movie = DB::table('celebrity_movie')->where('movie_id', $movieId)->where('profession_id', $id)->first();

    return view('admin.professions.edit_profession', compact('profession', 'celebrities', 'movie', 'celebrity_movie'));
  }

  public function updateProfession(ProfessionEditProfessionRequest $request, $id, $movie_id)
  {
    $profession = Profession::findOrFail($id);
    $input = $request->all();
    $movie = Movie::findOrFail($movie_id);
    if($request->celebrity == null)
    {
      $movie->celebrities()->wherePivot('profession_id', $id)->detach();
    }
    else
    {
      $movie->celebrities()->wherePivot('profession_id', $id)->detach();
      //Attaching genres to the created movie, inserting values in genre_movie table
      $movie->celebrities()->attach($request->celebrity, ['profession_id' => $id]);
    }

    $movie->update($input);
    Session::flash('updated_profession', 'The '.$profession->name.' of a movie '.$movie->name.' has been updated.');
    return redirect('admin/movies');
  }
}
