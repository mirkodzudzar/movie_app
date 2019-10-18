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
    <!-- <div class="form-group">
      {{ Form::label('photo_id', 'Photo:') }}
      {{ Form::file('photo_id', null) }}
    </div> -->
    <div class="table-responsive">
      {{ Form::label('genres', 'Change genre(s)') }}
      <table class="table table-bordered table-hover">
        <thead class="text-center">
            <th class="bg-success" colspan="{{count($genres)}}">Genres</th>
        </thead>
        <tbody>
          <tr>
            @foreach($genres as $genre)
              <td>
                {{ Form::checkbox('genre[]', $genre->id, $genre->checking($movie->id, $genre->id), ['class' => 'form-check-inpit'])}}
                {{ Form::label('$genre->id', $genre->name, ['class' => 'form-check-label'])}}
              @endforeach
              </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="table-responsive">
      {{ Form::label('profession', 'Professions') }}
      <table class="table table-bordered table-hover">
        <thead class="text-center">
          @foreach($professions as $profession)
            <th class="bg-success">{{$profession->name}}</th>
          @endforeach
        </thead>
        <tbody>
          @foreach($celebrities as $celebrity)
            <tr>
              <!-- getFullNameAttribute -->
              <td>
                {{ Form::checkbox('celebrity[]', $celebrity->id, false, ['class' => 'form-check-inpit'])}}
                {{ Form::label('$celebrity->id', $celebrity->full_name, ['class' => 'form-check-label'])}}
              </td>
              <td>
                {{ Form::checkbox('celebrity[]', $celebrity->id, false, ['class' => 'form-check-inpit'])}}
                {{ Form::label('$celebrity->id', $celebrity->full_name, ['class' => 'form-check-label'])}}
              </td>
              <td>
                {{ Form::checkbox('celebrity[]', $celebrity->id, false, ['class' => 'form-check-inpit'])}}
                {{ Form::label('$celebrity->id', $celebrity->full_name, ['class' => 'form-check-label'])}}
              </td>
              <td>
                {{ Form::checkbox('celebrity[]', $celebrity->id, false, ['class' => 'form-check-inpit'])}}
                {{ Form::label('$celebrity->id', $celebrity->full_name, ['class' => 'form-check-label'])}}
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
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
