<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\Http\Requests\RoleCreateRequest;
use App\Http\Requests\RoleEditRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

class AdminRolesController extends Controller
{
    public function __construct()
    {
      $this->middleware('administrator');
    }

    public function index()
    {
      $roles = Role::all()->sortBy('name');
      $query = Input::get('query');

      if($query != '')
      {
        $role = Role::where('name', 'LIKE', '%' . $query . '%')->get();
        if(count($role) > 0)
        {
          return view('admin.roles.index', compact('roles'))->withDetails($role)->withQuery($query);
        }

        return view('admin.roles.index', compact('roles'))->withMessage('No roles found!');
      }

      return view('admin.roles.index', compact('roles'));
    }

    public function store(RoleCreateRequest $request)
    {
      $input = $request->all();
      Role::create($input);
      Session::flash('created_role', 'The role '.$request->name.' has been created.');

      return redirect('admin/roles');
    }

    public function edit($id)
    {
      $role = Role::findOrFail($id);

      return view('admin.roles.edit', compact('role'));
    }

    public function update(RoleEditRequest $request, $id)
    {
        $role = Role::findOrFail($id);
        $input = $request->all();
        $role->update($input);
        Session::flash('updated_role', 'The role '.$request->name.' has been updated.');

        return redirect('/admin/roles');
    }

    public function destroy($id)
    {
      $role = Role::findOrFail($id);
      $role->delete();
      Session::flash('deleted_role', 'The role '.$role->name.' has been deleted.');

      return redirect('admin/roles');
    }
}
