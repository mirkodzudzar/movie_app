@extends('layouts.front')

@section('title', 'Movie Application - '.$celebrity->full_name)

@section('content')
  <div class="blog-post">
    <h2 class="blog-post-title">{{$celebrity->full_name}}</h2>
    <p class="blog-post-meta">{{$celebrity->showProfessions($celebrity->id)}}</p>
    <p class="blog-post-meta">Date of birth: {{$celebrity->date_of_birth}}</p>
    <p class="blog-post-meta">State of birth: {{$celebrity->state_of_birth}}</p>
    <img height="250" src="{{$celebrity->showCelebrityImage($celebrity->id)}}" alt="">
    <ol>
      @foreach($professions as $profession)
        <li class="blog-post-meta"><b>{{$profession->name}}</b> : {{$celebrity->celebritiesMovies($celebrity->id, $profession->id)}}</li>
      @endforeach
    </ol>
    @foreach($celebrity->images as $image)
      <img height="50" src="{{$image ? $image->file : App\Image::noImage()}}" alt="">
    @endforeach
  </div><!-- /.blog-post -->
@endsection
