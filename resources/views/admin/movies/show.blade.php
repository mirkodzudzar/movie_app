@extends('layouts.admin')

@section('heading', $movie->name)

@section('description', $movie->name)

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
        <th>Director</th>
        <td>{{$movie->director->first_name." ".$movie->director->last_name}}</td>
      </tr>
      <tr>
        <th>Genre</th>
        <td>
          <?php
            $counter = 1;
            $genre_count = count($movie->genres()->get());
          ?>
          @foreach($movie->genres as $genre)
            @if($genre_count == $counter)
              {{$genre->name}}
            @else
              {{$genre->name.", "}}
            @endif
            <?php $counter = $counter + 1; ?>
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
        <!-- delete styles later -->
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
