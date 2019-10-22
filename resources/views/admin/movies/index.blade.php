@extends('layouts.admin')

@section('title', 'Movie Application - Movies')

@section('heading', 'Movies')

@section('description', 'Movies')

@section('content')
<div class="table-responsive">
  <table class="table table-bordered table-hover">
    <thead class="text-center bg-success">
      <th>Id</th>
      <th colspan="2">Like/Dislike</th>
      <th>Image</th>
      <th>Movie name</th>
      <th>Time duration</th>
      <th>Release date</th>
      @foreach($professions as $profession)
        <th>{{$profession->name}}(s)</th>
      @endforeach
      <th>Genre</th>
      <th colspan="{{$professions->count()}}">Edit professions</th>
      <th colspan="2">Edit/Delete actions</th>
    </thead>
    <tbody>
      @forelse($movies as $movie)
        <tr>
          <td class="text-center">{{$movie->id}}</td>
          <td class="text-center">{{$movie->likes($movie->id)}}</td>
          <td class="text-center">{{$movie->dislikes($movie->id)}}</td>
          <td><img height="50" src="{{$movie->showMovieImage($movie->id)}}" alt=""></td>
          <td class="text-center"><a href="{{ route('admin.movies.show', $movie->id) }}">{{$movie->name}}</a></td>
          <td class="text-center">{{$movie->time_duration}}</td>
          <td class="text-center">{{$movie->release_date}}</td>
          @foreach($professions as $profession)
            <td class="text-center">{{$movie->professions($movie->id, $profession->id)}}</td>
          @endforeach
          <td class="text-center">
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
          @foreach($professions as $profession)
            <td><a href="{{ route('admin.professions.edit_profession', [$profession->id, $movie->id]) }}" class="btn btn-primary">{{$profession->name}}</a></td>
          @endforeach
          <td class="text-center"><a href="{{ route('admin.movies.edit', $movie->id)}}" class="btn btn-success">Edit</a></td>
          <td class="text-center">
            {{ Form::open(['method' => 'DELETE', 'action' => ['AdminMoviesController@destroy', $movie->id]]) }}
              <div class="form-group">
                {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
              </div>
            {{ Form::close() }}
          </td>
        </tr>
      @empty
        <tr>
          <th colspan='11' class="text-center">No movies found.</th>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection
