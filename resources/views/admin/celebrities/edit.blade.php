@extends('layouts.admin')

@section('title', 'Movie Application - Edit celebrity '.$celebrity->full_name)

@section('heading', 'Edit celebrity - '.$celebrity->full_name)

@section('description', 'Edit celebrity - '.$celebrity->full_name)

@section('content')

  {{ Form::model($celebrity, ['method' => 'PATCH', 'action' => ['AdminCelebritiesController@update', $celebrity->id], 'class' => 'col-md-12', 'files' => true]) }}
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
    </div>
    <div class="form-group">
      {{ Form::submit('Edit celebrity', ['class' => 'btn btn-primary']) }}
    </div>
  {{ Form::close() }}

  {{ Form::open(['method' => 'DELETE', 'action' => ['AdminCelebritiesController@destroy', $celebrity->id], 'class' => 'col-md-12']) }}
    <div class="form-group">
      {{ Form::submit('Delete celebrity', ['class' => 'btn btn-danger']) }}
    </div>
  {{ Form::close() }}

@endsection
