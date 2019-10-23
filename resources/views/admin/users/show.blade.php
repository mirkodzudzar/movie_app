@extends('layouts.admin')

@section('title', 'Movie Application - User '.$user->full_name)

@section('heading', 'User - '.$user->full_name)

@section('description', 'User - '.$user->full_name)

@section('content')
  <div class="card-body table-responsive p-0">
    <table class="table table-hover">
      <tr>
        <th colspan="2"><img height="50" src="{{$user->photo ? $user->photo->file : App\Photo::noPhoto()}}" alt=""></th>
      </tr>
      <tr>
        <th>Id</th>
        <td>{{$user->id}}</td>
      </tr>
      <tr>
        <th>First name</th>
        <td>{{$user->first_name}}</td>
      </tr>
      <tr>
        <th>Last name</th>
        <td>{{$user->last_name}}</td>
      </tr>
      <tr>
        <th>Username</th>
        <td>{{$user->username}}</td>
      </tr>
      <tr>
        <th>Email</th>
        <td>{{$user->email}}</td>
      </tr>
      <tr>
        <th>Date of birth</th>
        <td>{{$user->date_of_birth}}</td>
      </tr>
      <tr>
        <th>State of birth</th>
        <td>{{$user->state_of_birth}}</td>
      </tr>
      <tr>
        <th>Created at</th>
        <td>{{$user->created_at}}</td>
      </tr>
      <tr>
        <th>Updated at</th>
        <td>{{$user->updated_at}}</td>
      </tr>
      <tr>
        <!-- change to dinamic -->
        <th>Role</th>
        <td>{{$user->role['name']}}</td>
      </tr>
      <tr>
        <!-- delete styles later -->
        <th rowspan="2">Edit/Delete actions</th>
        <td>
          <a href="{{ route('admin.users.edit', $user->id )}}" class="btn btn-success">Edit</a>
          {{ Form::open(['method' => 'DELETE', 'action' => ['AdminUsersController@destroy', $user->id]]) }}
            <div class="form-group">
              {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
            </div>
          {{ Form::close() }}
        </td>
      </tr>
    </table>
  </div>
@endsection
