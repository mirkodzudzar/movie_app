@extends('layouts.admin')

@section('heading', 'Edit genre')

@section('description', 'Edit genre')

@section('content')

  {{ Form::model($genre, ['method' => 'PATCH', 'action' => ['AdminGenresController@update', $genre->id], 'class' => 'col-md-12', 'files' => true]) }}
    <div class="form-group">
      {{ Form::label('name', 'Name') }}
      {{ Form::text('name', null, ['class' => 'form-control']) }}
    </div>
    <div class="form-group">
      {{ Form::submit('Edit genre', ['class' => 'btn btn-primary']) }}
    </div>
  {{ Form::close() }}

  {{ Form::open(['method' => 'DELETE', 'action' => ['AdminGenresController@destroy', $genre->id], 'class' => 'col-md-12']) }}
    <div class="form-group">
      {{ Form::submit('Delete genre', ['class' => 'btn btn-danger']) }}
    </div>
  {{ Form::close() }}

@endsection
