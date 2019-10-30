@extends('layouts.front')

@section('title', 'Movie Application - '.$genre->name)

@section('content')
<h3 class="pb-4 mb-4 font-italic border-bottom">
  Movies by genre - {{$genre->name}}
</h3>

@forelse($movies as $movie)
  <div class="blog-post">
    <h2 class="blog-post-title"><a href="{{ route('front.movies.show', $movie->id) }}">{{$movie->name}}</a></h2>
    <i class="far fa-thumbs-up">{{$movie->likes($movie->id)}}</i>
    <i class="far fa-thumbs-down">{{$movie->dislikes($movie->id)}}</i>
    <p class="blog-post-meta">
    <?php
      $numItems = count($movie->genres()->get());
      $i = 0;
    ?>
    @foreach($movie->genres as $genre)
      @if(++$i === $numItems)
        <a href="{{ route('front.genres.show', $genre->id) }}">{{$genre->name}}</a>
      @else
        <a href="{{ route('front.genres.show', $genre->id) }}">{{$genre->name}}</a>,
      @endif
    @endforeach
    </p>
    <p class="blog-post-meta">Duration: {{$movie->time_duration}}, release date: {{$movie->release_date}}</p>
    <img height="150" src="{{$movie->showMovieImage($movie->id)}}" alt="">
    <p>{{str_limit($movie->description, $limit = 250)}}</p>
    <hr>
  </div><!-- /.blog-post -->
@empty
  <h2 class="blog-post-title">No news found.</h2>
@endforelse
{{ $movies->links() }}

@endsection
