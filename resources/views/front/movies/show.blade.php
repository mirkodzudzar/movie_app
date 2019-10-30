@extends('layouts.front')

@section('title', 'Movie Application - '.$movie->name)

@section('content')
  <div class="blog-post">
    <h2 class="blog-post-title">{{$movie->name}}</h2>
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
