@extends('layouts.admin')

@section('title', 'Movie Application - Edit user '.$user->full_name)

@section('heading', 'Edit user - '.$user->full_name)

@section('description', 'Edit user - '.$user->full_name)

@section('content')

  {{ Form::model($user, ['method' => 'PATCH', 'action' => ['AdminUsersController@update', $user->id], 'class' => 'col-md-12', 'files' => true]) }}
    <div class="form-group">
      {{ Form::label('first_name', 'First name') }}
      {{ Form::text('first_name', null, ['class' => 'form-control']) }}
    </div>
    <div class="form-group">
      {{ Form::label('last_name', 'Last name') }}
      {{ Form::text('last_name', null, ['class' => 'form-control']) }}
    </div>
    <div class="form-group">
      {{ Form::label('date_of_birth', 'Date of birth') }}
      {{ Form::date('date_of_birth', null, ['class' => 'form-control']) }}
    </div>
    <div class="form-group">
      {{ Form::label('state_of_birth', 'State of birth') }}
      {{ Form::text('state_of_birth', null, ['class' => 'form-control']) }}
    </div>
    <div class="form-group">
      {{ Form::label('username', 'Username') }}
      {{ Form::text('username', null, ['class' => 'form-control']) }}
    </div>
    <div class="form-group">
      {{ Form::label('email', 'Email') }}
      {{ Form::email('email', null, ['class' => 'form-control']) }}
    </div>
    <div class="form-group">
      {{ Form::label('role_id', 'Role') }}
      {{ Form::select('role_id', $roles, null, ['class' => 'form-control']) }}
    </div>
    <div class="form-group">
      {{ Form::label('photo_id', 'Photo:') }}
      <img height="150" src="{{$user->photo ? $user->photo->file : App\Photo::noPhoto()}}" alt="">
      {{ Form::file('photo_id', null) }}
    </div>
    <div class="form-group">
      {{ Form::label('password', 'Password') }}
      {{ Form::password('password', ['class' => 'form-control']) }}
    </div>
    <div class="form-group">
      {{ Form::label('password-confirm', 'Confirm password') }}
      {{ Form::password('password_confirmation', ['class' => 'form-control', 'id' => 'password-confirm', 'autocomplete' => 'new-password']) }}
    </div>
    <div class="form-group">
      {{ Form::submit('Edit user', ['class' => 'btn btn-primary']) }}
    </div>
  {{ Form::close() }}

  {{ Form::open(['method' => 'DELETE', 'action' => ['AdminUsersController@destroy', $user->id], 'class' => 'col-md-12']) }}
    <div class="form-group">
      {{ Form::submit('Delete user', ['class' => 'btn btn-danger']) }}
    </div>
  {{ Form::close() }}

@endsection
