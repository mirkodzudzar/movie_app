@extends('layouts.admin')

@section('heading', 'Movies')

@section('description', 'Movies')

@section('content')
<div class="table-responsive">
  <table class="table table-bordered table-hover">
    <thead class="text-center">
      <th>Id</th>
      <th>Image</th>
      <th>Name</th>
      <th>Time duration</th>
      <th>Release date</th>
      <th>Director</th>
      <th>Genre</th>
      <th>Created at</th>
      <th>Updated at</th>
      <th colspan="2">Edit/Delete actions</th>
    </thead>
    <tbody>
      @forelse($movies as $movie)
        <tr>
          <td class="text-center">{{$movie->id}}</td>
          <td><img height="50" src="http://placehold.it/700x200" alt=""></td>
          <td class="text-center"><a href="{{ route('admin.movies.show', $movie->id) }}">{{$movie->name}}</a></td>
          <td class="text-center">{{$movie->time_duration}}</td>
          <td class="text-center">{{$movie->release_date}}</td>
          <td class="text-center">{{$movie->director->first_name.' '.$movie->director->last_name}}</td>
          <td class="text-center">
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
          <td class="text-center">{{$movie->created_at}}</td>
          <td class="text-center">{{$movie->updated_at}}</td>
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
