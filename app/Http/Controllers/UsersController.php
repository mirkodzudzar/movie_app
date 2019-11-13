<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Profession;
use App\News;

class UsersController extends BaseController
{
  public function __construct()
  {
    parent::__construct();
  }

  public function show($id)
  {
      $user = User::findOrFail($id);
      $news = News::where('user_id', $id)->orderBy('created_at', 'desc')->paginate(5);;

      return view('front.users.show', compact('user', 'news'));
  }

  public function edit($id)
  {
      $user = User::findOrFail($id);

      return view('front.users.edit', compact('user'));
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

      return redirect('/users');
  }
}
