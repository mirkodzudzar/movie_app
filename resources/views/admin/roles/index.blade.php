@extends('layouts.admin')

@section('title', 'Movie Application - Roles')

@section('search_form')
  {{ Form::open(['method' => 'POST', 'action' => 'AdminRolesController@index', 'role' => 'search', 'class' => 'form-inline ml-3']) }}
    <div class="input-group input-group-sm">
      {{ Form::text('query', '', ['class' => 'form-control form-control-navbar', 'placeholder' => 'Search for roles', 'aria-label' => 'Search']) }}
      <div class="input-group-append">
        <button class="btn btn-navbar" type="submit">
          <i class="fas fa-search"></i>
        </button>
      </div>
    </div>
  {{ Form::close() }}
@endsection

@section('heading', 'Roles')

@section('description', 'Roles')

@section('content')
@if(isset($details))
<div class="table-responsive">
  <table class="table table-bordered table-hover">
    <thead class="bg-primary">
      <tr>
        <td colspan="2">The search results for <b> {{$query}} </b> are: </td>
      </tr>
    </thead>
    <tbody>
      @foreach($details as $role)
        <tr>
          <td><a href="{{ route('admin.roles.edit', $role->id) }}">{{$role->name}}</a></td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
  <!-- When you search for empty string, it will not show a message -->
  @elseif(isset($message))
    <div class="alert alert-danger">
      <p>{{$message}}</p>
    </div>
  @endif
</div>
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
          <th colspan='11' class="text-center">No roles found.</th>
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
