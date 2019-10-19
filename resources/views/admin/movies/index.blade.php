@extends('layouts.admin')

@section('heading', 'Movies')

@section('description', 'Movies')

@section('content')
<div class="table-responsive">
  <table class="table table-bordered table-hover">
    <thead class="text-center">
      <th>Id</th>
      <th colspan="2">Like/Dislike</th>
      <th>Image</th>
      <th>Movie name</th>
      <th>Time duration</th>
      <th>Release date</th>
      <th>Director(s)</th>
      <th>Actors(s)</th>
      <th>Producer(s)</th>
      <th>Writer(s)</th>
      <th>Genre</th>
      <th colspan="2">Created at/Updated at</th>
      <th colspan="2">Edit/Delete actions</th>
    </thead>
    <tbody>
      @forelse($movies as $movie)
        <tr>
          <td class="text-center">{{$movie->id}}</td>
          <td class="text-center">{{$movie->likes($movie->id)}}</td>
          <td class="text-center">{{$movie->dislikes($movie->id)}}</td>
          <td><img height="50" src="http://placehold.it/700x200" alt=""></td>
          <td class="text-center"><a href="{{ route('admin.movies.show', $movie->id) }}">{{$movie->name}}</a></td>
          <td class="text-center">{{$movie->time_duration}}</td>
          <td class="text-center">{{$movie->release_date}}</td>
          <td class="text-center">{{$movie->professions($movie->id, 'director')}}</td>
          <td class="text-center">{{$movie->professions($movie->id, 'actor')}}</td>
          <td class="text-center">{{$movie->professions($movie->id, 'producer')}}</td>
          <td class="text-center">{{$movie->professions($movie->id, 'writer')}}</td>
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
          <td class="text-center">{{date('Y-m-d', strtotime($movie->created_at))}}</td>
          <td class="text-center">{{date('Y-m-d', strtotime($movie->updated_at))}}</td>
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
