@extends('layouts.front')

@section('title', 'Movie Application - '.$movie->name)

@section('content')
  <div class="blog-post border rounded flex-md-row mb-4 shadow-sm h-md-250 position-relative bg-white p-3">
    <h2 class="blog-post-title">{{$movie->name}}</h2>
    @guest
      <i class="far fa-thumbs-up">{{$movie->likes($movie->id)}}</i>
      <i class="far fa-thumbs-down">{{$movie->dislikes($movie->id)}}</i>
    @else
      <a href="{{ route('front.movies.like', $movie->id) }}">{{$movie->thumbsUp($movie->id, Auth::user()->id)}}</a>{{$movie->likes($movie->id)}}
      <a href="{{ route('front.movies.dislike', $movie->id) }}">{{$movie->thumbsDown($movie->id, Auth::user()->id)}}</a>{{$movie->dislikes($movie->id)}}
    @endguest
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
    <p class="blog-post-meta">Price: <b>{{$movie->price ? $movie->price->value.' $' : 'unavailable'}}</b></p>
    <img height="250" src="{{$movie->showMovieImage($movie->id)}}" alt="">
    <ol>
      @foreach($professions as $profession)
        <li class="blog-post-meta"><b>{{$profession->name}}(s)</b> : {{$movie->professions($movie->id, $profession->id)}}</li>
      @endforeach
    </ol>
    <p>{{$movie->description}}</p>
    @foreach($movie->images as $image)
      <img height="50" src="{{$image ? $image->file : App\Image::noImage()}}" alt="">
    @endforeach
  </div><!-- /.blog-post -->
@endsection
