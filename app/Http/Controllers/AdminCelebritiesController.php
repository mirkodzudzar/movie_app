<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Celebrity;
use App\Http\Requests\CelebrityCreateRequest;
use App\Http\Requests\CelebrityEditRequest;
use Illuminate\Support\Facades\Session;

class AdminCelebritiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $celebrities = Celebrity::all()->sortBy('last_name');

        return view('admin.celebrities.index', compact('celebrities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.celebrities.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CelebrityCreateRequest $request)
    {
      $input = $request->all();
      Celebrity::create($input);
      Session::flash('created_celebrity', 'A celebrity '.$request->first_name.' '.$request->last_name.' has been created.');

      return redirect('/admin/celebrities');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $celebrity = Celebrity::findOrFail($id);

        return view('admin.celebrities.show', compact('celebrity'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $celebrity = Celebrity::findOrFail($id);

        return view('admin.celebrities.edit', compact('celebrity'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CelebrityEditRequest $request, $id)
    {
        $celebrity = Celebrity::findOrFail($id);
        $input = $request->all();
        $celebrity->update($input);
        Session::flash('updated_celebrity', 'A celebrity '.$request->first_name.' '.$request->last_name.' has been updated');

        return redirect('admin/celebrities');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $celebrity = Celebrity::findOrFail($id);
      $celebrity->movies()->detach();
      $celebrity->delete();
      Session::flash('deleted_celebrity', 'A celebrity '.$celebrity->first_name.' '.$celebrity->last_name.' has been deleted.');

      return redirect('/admin/celebrities');
    }
}
