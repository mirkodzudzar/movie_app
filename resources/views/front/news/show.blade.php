@extends('layouts.front')

@section('content')
  <div class="blog-post border rounded flex-md-row mb-4 shadow-sm h-md-250 position-relative bg-white p-3">
    <h2 class="blog-post-title">{{$news->title}}</h2>
    <p class="blog-post-meta">{{$news->created_at->diffForHumans()}} by <a href="{{ route('front.users.show', $news->user_id) }}">{{$news->user->full_name}}</a></p>
    <img height="250" src="{{$news->showNewsPhoto($news->id)}}" alt="">
    <p>{{$news->content}}</p>
  </div><!-- /.blog-post -->
@endsection
