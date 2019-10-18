<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profession;
use App\Http\Requests\ProfessionCreateRequest;
use App\Http\Requests\ProfessionEditRequest;
use Illuminate\Support\Facades\Session;

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
}
