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
    <div class="table-responsive">
      {{ Form::label('genres', 'Genres') }}
      <table class="table table-bordered table-hover">
        <thead class="text-center">
            <th class="bg-success" colspan="{{count($genres)}}">Genres</th>
        </thead>
        <tbody>
          <tr>
            @foreach($genres as $genre)
            <td>
              {{ Form::checkbox('genre[]', $genre->id, false, ['class' => 'form-check-inpit'])}}
              {{ Form::label('$genre->id', $genre->name, ['class' => 'form-check-label'])}}
            @endforeach
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- <div class="form-group">
      {{ Form::label('photo_id', 'Photo:') }}
      {{ Form::file('photo_id', null) }}
    </div> -->
    <div class="form-group">
      {{ Form::submit('Create movie', ['class' => 'btn btn-primary']) }}
    </div>
  {{ Form::close() }}

@endsection
