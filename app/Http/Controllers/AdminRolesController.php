<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\Http\Requests\RoleCreateRequest;
use App\Http\Requests\RoleEditRequest;
use Illuminate\Support\Facades\Session;

class AdminRolesController extends Controller
{
    public function index()
    {
      $roles = Role::all()->sortBy('name');

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
