@extends('layouts.admin')

@section('heading', 'Create new celebrity')

@section('description', 'Create new celebrity')

@section('content')

  {{ Form::open(['method' => 'POST', 'action' => 'AdminCelebritiesController@store', 'class' => 'col-md-12', 'files' => true]) }}
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
    <!-- <div class="form-group">
      {{ Form::label('photo_id', 'Photo:') }}
      {{ Form::file('photo_id', null) }}
    </div> -->
    <div class="form-group">
      {{ Form::submit('Create celebrity', ['class' => 'btn btn-primary']) }}
    </div>
  {{ Form::close() }}

@endsection
