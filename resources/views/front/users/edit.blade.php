@extends('layouts.front')

@section('title', 'Movie Application - '.$user->full_name)

@section('content')
  {{ Form::model($user, ['method' => 'PATCH', 'action' => ['UsersController@update', $user->id], 'class' => 'col-md-12', 'files' => true]) }}
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
    <img height="150" src="{{$user->photo ? $user->photo->file : App\Photo::noPhoto()}}" alt="">
    <div class="form-group">
      {{ Form::label('photo_id', 'Photo:') }}
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
      {{ Form::submit('Edit profile', ['class' => 'btn btn-primary']) }}
    </div>
  {{ Form::close() }}
@endsection
