@extends('layouts.front')

@section('title', 'Movie Application - Movies')

@section('content')
<h3 class="pb-4 mb-4 font-italic border-bottom">
  Your ratings
</h3>

<div class="card-body table-responsive border rounded shadow-sm h-md-250 position-relative bg-white">
  <table class="table table-hover text-center">
    <thead>
      <th>Id</th>
      <th colspan="2">Like/Dislike</th>
      <th>Image</th>
      <th>Movie name</th>
      <th>Time duration</th>
      <th>Release date</th>
      <th>Genre</th>
    </thead>
    <tbody>
      @if($movies != null)
        @forelse($movies as $movie)
          <tr>
            <td>{{$movie->id}}</td>
            <td><a href="{{ route('front.movies.like', $movie->id) }}">{{$movie->thumbsUp($movie->id, Auth::user()->id)}}</a>{{$movie->likes($movie->id)}}</td>
            <td><a href="{{ route('front.movies.dislike', $movie->id) }}">{{$movie->thumbsDown($movie->id, Auth::user()->id)}}</a>{{$movie->dislikes($movie->id)}}</td>
            <td><img height="50" src="{{$movie->showMovieImage($movie->id)}}" alt=""></td>
            <td><a href="{{ route('front.movies.show', $movie->id) }}">{{$movie->name}}</a></td>
            <td>{{$movie->time_duration}}</td>
            <td>{{$movie->release_date}}</td>
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
        @empty
          <tr>
            <th colspan='11'>No movies found.</th>
          </tr>
        @endforelse
      @else
        <tr>
          <th colspan='11'>No movies found.</th>
        </tr>
      @endif
    </tbody>
  </table>
</div>

@endsection
