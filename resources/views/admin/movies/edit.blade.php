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
    <!-- Edit this code -->
    DIRECTOR NAME
    <!-- <div class="form-group">
      {{ Form::label('photo_id', 'Photo:') }}
      {{ Form::file('photo_id', null) }}
    </div> -->
    <!-- NEED TO WORL ON CHECKBOXES, THER MUST BE A BETTER WAY TO DO THIS -->
    <div class="form-check">
      {!! Form::label('genre', 'Curent genre(s)') !!}<br>
      <?php
        $counter = 1;
        $genre_count = count($movie->genres()->get());
      ?>
      @foreach($movie->genres as $genre)
        @if($genre_count == $counter)
          <b>{{ $genre->name }}</b>
        @else
          <b>{{ $genre->name.", " }}</b>
        @endif
        <?php $counter = $counter + 1; ?>
      @endforeach
      <br><br>
      {!! Form::label('genre', 'Choose another genre(s)') !!}<br>
      @foreach($genres as $genre)
        {{ Form::checkbox('genre[]', $genre->id, false, ['class' => 'form-check-inpit'])}}
        {{ Form::label('$genre->id', $genre->name, ['class' => 'form-check-label'])}}<br>
      @endforeach
    </div>
    <div class="form-group">
      {{ Form::submit('Edit movie', ['class' => 'btn btn-primary']) }}
    </div>
  {{ Form::close() }}

  {{ Form::open(['method' => 'DELETE', 'action' => ['AdminMoviesController@destroy', $movie->id], 'class' => 'col-md-12']) }}
    <div class="form-group">
      {{ Form::submit('Delete movie', ['class' => 'btn btn-danger']) }}
    </div>
  {{ Form::close() }}

@endsection
