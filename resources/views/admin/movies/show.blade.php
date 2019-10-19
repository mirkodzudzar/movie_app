@extends('layouts.admin')

@section('heading', 'Movie - '.$movie->name)

@section('description', 'Movie - '.$movie->name)

@section('content')
  <div class="table-responsive">
    <table class="table table-bordered table-hover text-center">
      <tr>
        <th colspan="2" class="text-center"><img height="50" src="http://placehold.it/700x200" alt=""></th>
      </tr>
      <tr>
        <th>Id</th>
        <td>{{$movie->id}}</td>
      </tr>
      <tr>
        <th>Name</th>
        <td>{{$movie->name}}</td>
      </tr>
      <tr>
        <th>Time duration</th>
        <td>{{$movie->time_duration}}</td>
      </tr>
      <tr>
        <th>Release date</th>
        <td>{{$movie->release_date}}</td>
      </tr>
      <tr>
        <th>Director(s)</th>
        <td>{{$movie->professions($movie->id, 'director')}}</td>
      </tr>
      <tr>
        <th>Actors(s)</th>
        <td>{{$movie->professions($movie->id, 'actor')}}</td>
      </tr>
      <tr>
        <th>Producer(s)</th>
        <td>{{$movie->professions($movie->id, 'producer')}}</td>
      </tr>
      <tr>
        <th>Writer(s)</th>
        <td>{{$movie->professions($movie->id, 'writer')}}</td>
      </tr>
      <tr>
        <th>Genre</th>
        <td>
          <?php
            $numItems = count($movie->genres()->get());
            $i = 0;
          ?>
          @foreach($movie->genres as $genre)
            @if(++$i === $numItems)
              {{$genre->name}}
            @else
              {{$genre->name.", "}}
            @endif
          @endforeach
        </td>
      </tr>
      <tr>
        <th>Created at</th>
        <td>{{$movie->created_at}}</td>
      </tr>
      <tr>
        <th>Updated at</th>
        <td>{{$movie->updated_at}}</td>
      </tr>
      <tr>
        <!-- delete styles -->
        <th rowspan="2" style="vertical-align : middle; text-align:center;">Edit/Delete actions</th>
        <td>
          <a href="{{ route('admin.movies.edit', $movie->id )}}" class="btn btn-success">Edit</a>
          {{ Form::open(['method' => 'DELETE', 'action' => ['AdminMoviesController@destroy', $movie->id]]) }}
            <div class="form-group">
              {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
            </div>
          {{ Form::close() }}
        </td>
      </tr>
    </table>
  </div>
@endsection
