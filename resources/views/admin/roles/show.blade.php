@extends('layouts.admin')

@section('title', "Movie Application - {$role->name}s")

@section('heading', "{$role->name}s")

@section('description', "{$role->name}s")

@section('content')
<div class="card-body table-responsive p-0">
  <table class="table table-hover text-center">
    <thead class="bg-success">
        <th>Id</th>
        <th>Image</th>
        <th>Name (First/Last)</th>
        <th>Username</th>
        <th>Email</th>
        <th>Date of birth</th>
        <th>State of birth</th>
        <th>Role</th>
        <th colspan="2">Created at/Updated at</th>
        <th colspan="2">Edit/Delete actions</th>
      </thead>
      <tbody>
        @forelse($role->users as $user)
          <tr>
            <td>{{$user->id}}</td>
            <td><img height="50" src="{{$user->photo ? $user->photo->file : App\Photo::noPhoto()}}" alt=""></td>
            <td><a href="{{ route('admin.users.show', $user->id) }}">{{$user->full_name}}</a></td>
            <td>{{$user->username}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->date_of_birth}}</td>
            <td>{{$user->state_of_birth}}</td>
            <td>{{$user->role['name']}}</td>
            <td>{{date('Y-m-d', strtotime($user->created_at))}}</td>
            <td>{{date('Y-m-d', strtotime($user->updated_at))}}</td>
            <td><a href="{{ route('admin.users.edit', $user->id )}}" class="btn btn-success">Edit</a></td>
            <td>
              {{ Form::open(['method' => 'DELETE', 'action' => ['AdminUsersController@destroy', $user->id]]) }}
                <div class="form-group">
                  {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
                </div>
              {{ Form::close() }}
            </td>
          </tr>
        @empty
          <tr>
            <th colspan='11'>No users found.</th>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
@endsection
