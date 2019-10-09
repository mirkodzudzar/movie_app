@extends('layouts.admin')

@section('heading', 'Create new user')

@section('description', 'Create new user')

@section('content')

  {{ Form::open(['method' => 'POST', 'action' => 'AdminUsersController@store', 'class' => 'col-md-12', 'files' => true]) }}
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
      {{ Form::label('photo_id', 'Photo:') }}
      {{ Form::file('photo_id', null) }}
    </div>
    <div class="form-group">
      {{ Form::label('password', 'Password') }}
      {{ Form::password('password', ['class' => 'form-control', 'id' => 'password', 'autocomplete' => 'new-password']) }}
    </div>
    <div class="form-group">
      {{ Form::label('password-confirm', 'Confirm password') }}
      {{ Form::password('password_confirmation', ['class' => 'form-control', 'id' => 'password-confirm', 'autocomplete' => 'new-password']) }}
    </div>
    <div class="form-group">
      {{ Form::submit('Create user', ['class' => 'btn btn-primary']) }}
    </div>
  {{ Form::close() }}

@endsection
