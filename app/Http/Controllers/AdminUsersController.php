<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Photo;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserEditRequest;
use Illuminate\Support\Facades\Session;
use File;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all()->sortBy('last_name');

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreateRequest $request)
    {
        if(trim($request->password) == '')
        {
          $input = $request->except('password');
        }
        else
        {
          $input = $request->all();
          $input['password'] = bcrypt($request->password);
        }

        $input['password'] = bcrypt($request->password);
        $user = User::create($input);

        if($file = $request->file('photo_id'))
        {

          $name = time() . $file->getClientOriginalName();

          $file->move('images', $name);

          $user->photos()->create(['path' => $name]);

        }
        else
        {
          $user->photos()->create(['path' => 'no_image']);
        }

        Session::flash('created_user', 'The user '.$request->first_name.' '.$request->last_name.' has been created.');

        return redirect('/admin/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        foreach($user->photos as $photo)
        {

          $photo = $photo->path;

        }

        return view('admin.users.show', compact('user', 'photo'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserEditRequest $request, $id)
    {
        $user = User::findOrFail($id);

        if(trim($request->password) == '')
        {
          $input = $request->except('password');
        }
        else
        {
          $input = $request->all();
          $input['password'] = bcrypt($request->password);
        }

        if($file = $request->file('photo_id'))
        {
          foreach($user->photos as $photo)
          {
            if($photo->path != 'no_image')
            {
              unlink(public_path('images') .'\\' . $photo->path);
            }

            $photo->delete();
          }

          $name = time() . $file->getClientOriginalName();
          $file->move('images', $name);
          $user->photos()->create(['path' => $name]);
        }
        // else
        // {
        //   $user->photos()->create(['path' => 'no_image']);
        // }

        $user->update($input);
        Session::flash('updated_user', 'The user '.$request->first_name.' '.$request->last_name.' has been updated.');

        return redirect('/admin/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        foreach($user->photos as $photo)
        {
          if($photo->path != 'no_image')
          {
            unlink(public_path('images') .'\\' . $photo->path);
          }

          $photo->delete();
        }

        $user->delete();
        Session::flash('deleted_user', 'The user '.$user->first_name.' '.$user->last_name.' has been deleted.');

        return redirect('/admin/users');
    }
}
