@extends('layouts.admin')

@section('heading', 'Edit movie')

@section('description', 'Edit movie')

@section('content')

  {{ Form::model($movie, ['method' => 'PATCH', 'action' => ['AdminMoviesController@update', $movie->id], 'class' => 'col-md-12', 'files' => true]) }}
    <div class="form-group">
      {{ Form::label('name', 'Name') }}
      {{ Form::text('name', null, ['class' => 'form-control']) }}
    </div>
    <div class="form-group">
      {{ Form::label('description', 'Description') }}
      {{ Form::textarea('description', null, ['class' => 'form-control']) }}
    </div>
    <div class="form-group">
      {{ Form::label('time_duration', 'Time duration') }}
      {{ Form::text('time_duration', null, ['class' => 'form-control', 'placeholder' => 'h:m:s']) }}
    </div>
    <div class="form-group">
      {{ Form::label('release_date', 'Release date') }}
      {{ Form::date('release_date', null, ['class' => 'form-control']) }}
    </div>
    <div class="form-group">
      {!! Form::label('director_id', 'Director') !!}
      {!! Form::select('director_id', $directors, null, ['class' => 'form-control']) !!}
    </div>
    <!-- <div class="form-group">
      {{ Form::label('photo_id', 'Photo:') }}
      {{ Form::file('photo_id', null) }}
    </div> -->
    <div class="form-group">
      {{ Form::label('genre_id', 'Genre') }}
      {{ Form::select('genre_id', $genres, null, ['class' => 'form-control'])}}
    </div>
    <div class="form-group">
      {{ Form::submit('Edit movie', ['class' => 'btn btn-primary']) }}
    </div>
    {{ Form::open(['method' => 'DELETE', 'action' => ['AdminMoviesController@destroy', $movie->id]]) }}
      <div class="form-group">
        {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
      </div>
    {{ Form::close() }}
  {{ Form::close() }}

@endsection
