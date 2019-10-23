@extends('layouts.admin')

@section('title', 'Movie Application - Movies')

@section('search_form')
  {{ Form::open(['method' => 'POST', 'action' => 'AdminMoviesController@index', 'role' => 'search', 'class' => 'form-inline ml-3']) }}
    <div class="input-group input-group-sm">
      {{ Form::text('query', '', ['class' => 'form-control form-control-navbar', 'placeholder' => 'Search for movies', 'aria-label' => 'Search']) }}
      <div class="input-group-append">
        <button class="btn btn-navbar" type="submit">
          <i class="fas fa-search"></i>
        </button>
      </div>
    </div>
  {{ Form::close() }}
@endsection

@section('heading', 'Movies')

@section('description', 'Movies')

@section('content')
@if(isset($details))
<div class="card-body table-responsive p-0">
  <p class="bg-primary">The search results for your query <b> {{$query}} </b> are: </p>
  <table class="table table-hover text-center">
    <thead class="bg-primary">
      <tr>
        <td>Id</td>
        <td>Image</td>
        <td>Movie name</td>
      </tr>
    </thead>
    <tbody>
      @foreach($details as $movie)
        <tr>
          <td>{{$movie->id}}</td>
          <td><img height="50" src="{{$movie->showMovieImage($movie->id)}}" alt=""></td>
          <td><a href="{{route('admin.movies.show', $movie->id)}}">{{$movie->name}}</a></td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
  <!-- When you search for empty string, it will not show a message -->
  @elseif(isset($message))
    <div class="alert alert-danger">
      <p>{{$message}}</p>
    </div>
  @endif
</div>
<div class="card-body table-responsive p-0">
  <table class="table table-hover text-center">
    <thead class="bg-success">
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
          <td>{{$movie->id}}</td>
          <td>{{$movie->likes($movie->id)}}</td>
          <td>{{$movie->dislikes($movie->id)}}</td>
          <td><img height="50" src="{{$movie->showMovieImage($movie->id)}}" alt=""></td>
          <td><a href="{{ route('admin.movies.show', $movie->id) }}">{{$movie->name}}</a></td>
          <td>{{$movie->time_duration}}</td>
          <td>{{$movie->release_date}}</td>
          @foreach($professions as $profession)
            <td>{{$movie->professions($movie->id, $profession->id)}}</td>
          @endforeach
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
          @foreach($professions as $profession)
            <td><a href="{{ route('admin.professions.edit_profession', [$profession->id, $movie->id]) }}" class="btn btn-primary">{{$profession->name}}</a></td>
          @endforeach
          <td><a href="{{ route('admin.movies.edit', $movie->id)}}" class="btn btn-success">Edit</a></td>
          <td>
            {{ Form::open(['method' => 'DELETE', 'action' => ['AdminMoviesController@destroy', $movie->id]]) }}
              <div class="form-group">
                {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
              </div>
            {{ Form::close() }}
          </td>
        </tr>
      @empty
        <tr>
          <th colspan='11'>No movies found.</th>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection
