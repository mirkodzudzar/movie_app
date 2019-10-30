@extends('layouts.front')

@section('content')
  <div class="blog-post">
    <h2 class="blog-post-title">{{$news->title}}</h2>
    <p class="blog-post-meta">{{$news->created_at->diffForHumans()}} by <a href="#">{{$news->user->full_name}}</a></p>
    <img height="250" src="{{$news->showNewsPhoto($news->id)}}" alt="">
    <p>{{$news->content}}</p>
  </div><!-- /.blog-post -->
@endsection
