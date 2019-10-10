@extends('layouts.admin')

@section('heading', 'Create new movie')

@section('description', 'Create new movie')

@section('content')

  {{ Form::open(['method' => 'POST', 'action' => 'AdminMoviesController@store', 'class' => 'col-md-12', 'files' => true]) }}
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
    <div class="form-check">
      {!! Form::label('genre', 'Genres') !!}<br>
      @foreach($genres as $genre)
        {{ Form::checkbox('genre[]', $genre->id, false, ['class' => 'form-check-inpit'])}}
        {{ Form::label('$genre->id', $genre->name, ['class' => 'form-check-label'])}}<br>
      @endforeach
    </div>
    <div class="form-group">
      {{ Form::submit('Create movie', ['class' => 'btn btn-primary']) }}
    </div>
  {{ Form::close() }}

@endsection
