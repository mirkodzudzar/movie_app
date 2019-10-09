@extends('layouts.admin')

@section('heading', 'Edit user')

@section('description', 'Edit user')

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
    <!-- <div class="form-group">
      {{ Form::label('photo_id', 'Photo:') }}
      {{ Form::file('photo_id', null) }}
    </div> -->
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
