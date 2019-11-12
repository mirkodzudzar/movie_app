@extends('layouts.admin')

@section('title', 'Movie Application - Users')

@section('search_form')
  {{ Form::open(['method' => 'POST', 'action' => 'AdminUsersController@index', 'role' => 'search', 'class' => 'form-inline ml-3']) }}
    <div class="input-group input-group-sm">
      {{ Form::text('query', '', ['class' => 'form-control form-control-navbar', 'placeholder' => 'Search for users', 'aria-label' => 'Search']) }}
      <div class="input-group-append">
        <button class="btn btn-navbar" type="submit">
          <i class="fas fa-search"></i>
        </button>
      </div>
    </div>
  {{ Form::close() }}
@endsection

@section('heading', 'Users')

@section('description', 'Users')

@section('content')
@if(isset($details))
<div class="card-body table-responsive p-0">
  <p class="bg-primary">The search results for your query <b> {{$query}} </b> are: </p>
  <table class="table table-hover text-center">
    <thead class="bg-primary">
      <tr>
        <td>Id</td>
        <td>Image</td>
        <td>Full name (first/last)</td>
      </tr>
    </thead>
    <tbody>
      @foreach($details as $user)
        <tr>
          <td>{{$user->id}}</td>
          <td><img height="50" src="{{$user->photo ? $user->photo->file : App\Photo::noPhoto()}}" alt=""></td>
          <td><a href="{{ route('admin.users.show', $user->id) }}">{{$user->full_name}}</a></td>
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
        @forelse($users as $user)
          <tr>
            <td>{{$user->id}}</td>
            <td><img height="50" src="{{$user->photo ? $user->photo->file : App\Photo::noPhoto()}}" alt=""></td>
            <td><a href="{{ route('admin.users.show', $user->id) }}">{{$user->full_name}}</a></td>
            <td>{{$user->username}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->date_of_birth}}</td>
            <td>{{$user->state_of_birth}}</td>
            <td><a href="{{ route('admin.roles.show', $user->role['id']) }}">{{$user->role['name']}}</a></td>
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
