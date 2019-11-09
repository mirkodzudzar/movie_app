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
<div class="card-body table-responsive p-0">
  <p class="bg-primary">The search results for your query <b> {{$query}} </b> are: </p>
  <table class="table table-hover text-center">
    <thead class="bg-primary">
      <tr>
        <td>Id</td>
        <td>Role name</td>
      </tr>
    </thead>
    <tbody>
      @foreach($details as $role)
        <tr>
          <td>{{$role->id}}</td>
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
<div class="card-body table-responsive p-0">
  <table class="table table-hover text-center">
    <thead class="bg-success">
      <th>Id</th>
      <th>Name</th>
      <th>Number of users</th>
      <th colspan="2">Created at/Updated at</th>
      <th colspan="2">Edit/Delete actions</th>
    </thead>
    <tbody>
      @forelse($roles as $role)
        <tr>
          <td>{{$role->id}}</td>
          <td><a href="{{ route('admin.roles.show', $role->id) }}">{{$role->name}}</a></td>
          <td>{{$role->userByRoleCount($role->id)}}</td>
          <td>{{date('Y-m-d', strtotime($role->created_at))}}</td>
          <td>{{date('Y-m-d', strtotime($role->updated_at))}}</td>
          <td><a href="{{ route('admin.roles.edit', $role->id)}}" class="btn btn-success">Edit</a></td>
          <td>
            {{ Form::open(['method' => 'DELETE', 'action' => ['AdminRolesController@destroy', $role->id]]) }}
              <div class="form-group">
                {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
              </div>
            {{ Form::close() }}
          </td>
        </tr>
      @empty
        <tr>
          <th colspan='11'>No roles found.</th>
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
