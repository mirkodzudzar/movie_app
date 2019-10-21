@extends('layouts.admin')

@section('title', 'Movie Application - Roles')

@section('heading', 'Roles')

@section('description', 'Roles')

@section('content')
<div class="table-responsive">
  <table class="table table-bordered table-hover">
    <thead class="text-center bg-success">
      <th>Id</th>
      <th>Name</th>
      <th>Number of users</th>
      <th colspan="2">Created at/Updated at</th>
      <th colspan="2">Edit/Delete actions</th>
    </thead>
    <tbody>
      @forelse($roles as $role)
        <tr>
          <td class="text-center">{{$role->id}}</td>
          <td class="text-center">{{$role->name}}</td>
          <td class="text-center">{{$role->userByRoleCount($role->id)}}</td>
          <td class="text-center">{{date('Y-m-d', strtotime($role->created_at))}}</td>
          <td class="text-center">{{date('Y-m-d', strtotime($role->updated_at))}}</td>
          <td class="text-center"><a href="{{ route('admin.roles.edit', $role->id)}}" class="btn btn-success">Edit</a></td>
          <td class="text-center">
            {{ Form::open(['method' => 'DELETE', 'action' => ['AdminRolesController@destroy', $role->id]]) }}
              <div class="form-group">
                {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
              </div>
            {{ Form::close() }}
          </td>
        </tr>
      @empty
        <tr>
          <th colspan='11' class="text-center">No movies found.</th>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>
<h2>Create new role</h2>
{{ Form::open(['method' => 'POST', 'action' => 'AdminRolesController@store', 'class' => 'col-md-12', 'files' => true]) }}
  <div class="form-group">
    {{ Form::label('name', 'Name') }}
    {{ Form::text('name', null, ['class' => 'form-control']) }}
  </div>
  <div class="form-group">
    {{ Form::submit('Create role', ['class' => 'btn btn-primary']) }}
  </div>
{{ Form::close() }}
@endsection
