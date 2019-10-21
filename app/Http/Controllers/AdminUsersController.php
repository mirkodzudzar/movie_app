<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Photo;
use App\Role;
use App\Storage;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserEditRequest;
use Illuminate\Support\Facades\Session;

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
        //pluck function is using for select option functionality in views
        $roles = Role::pluck('name', 'id')->all();

        return view('admin.users.create', compact('roles'));
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
          //Storing all values from input fields except password
          $input = $request->except('password');
        }
        else
        {
          //Storing all values from input fields
          $input = $request->all();
          $input['password'] = bcrypt($request->password);
        }

        if($file = $request->file('photo_id'))
        {
          $name = time() . $file->getClientOriginalName();
          $file->move('images', $name);
          $photo = Photo::create(['file' => $name]);
          $input['photo_id'] = $photo->id;
        }

        $input['password'] = bcrypt($request->password);
        User::create($input);

        Session::flash('created_user', 'A user '.$request->first_name.' '.$request->last_name.' has been created.');

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

        return view('admin.users.show', compact('user'));
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
        $roles = Role::pluck('name', 'id')->all();

        return view('admin.users.edit', compact('user', 'roles'));
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
          if($user->photo)
          {
            unlink(public_path() . $user->photo->file);
            $user->photo->delete();
          }

          $name = time() . $file->getClientOriginalName();
          $file->move('images', $name);
          $photo = Photo::create(['file' => $name]);
          $input['photo_id'] = $photo->id;
        }
        else
        {
          $input['photo_id'] = $user->photo ? $user->photo->id : 0;
        }

        $user->update($input);
        Session::flash('updated_user', 'A user '.$request->first_name.' '.$request->last_name.' has been updated.');

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
        if($user->photo)
        {
          unlink(public_path() . $user->photo->file);
          $user->photo->delete();
        }

        $user->movies()->detach();
        // $user->role()->dissociate();
        $user->delete();
        Session::flash('deleted_user', 'A user '.$user->first_name.' '.$user->last_name.' has been deleted.');

        return redirect('/admin/users');
    }
}
