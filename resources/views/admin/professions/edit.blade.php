@extends('layouts.admin')

@section('title', 'Movie Application - Edit profession '.$profession->name)

@section('heading', 'Edit profession - '.$profession->name)

@section('description', 'Edit profession - '.$profession->name)

@section('content')

  {{ Form::model($profession, ['method' => 'PATCH', 'action' => ['AdminProfessionsController@update', $profession->id], 'class' => 'col-md-12', 'files' => true]) }}
    <div class="form-group">
      {{ Form::label('name', 'Name') }}
      {{ Form::text('name', null, ['class' => 'form-control']) }}
    </div>
    <div class="form-group">
      {{ Form::submit('Edit profession', ['class' => 'btn btn-primary']) }}
    </div>
  {{ Form::close() }}

  {{ Form::open(['method' => 'DELETE', 'action' => ['AdminProfessionsController@destroy', $profession->id], 'class' => 'col-md-12']) }}
    <div class="form-group">
      {{ Form::submit('Delete profession', ['class' => 'btn btn-danger']) }}
    </div>
  {{ Form::close() }}

@endsection
