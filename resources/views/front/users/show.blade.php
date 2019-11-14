@extends('layouts.front')

@section('title', 'Movie Application - News by '.$user->full_name)

@section('content')
<h3 class="pb-4 mb-4 font-italic border-bottom">
  News by {{$user->full_name}}
</h3>

@forelse($news as $n)
  <div class="blog-post border rounded flex-md-row mb-4 shadow-sm h-md-250 position-relative bg-white p-3">
    <h2 class="blog-post-title">{{$n->title}}</h2>
    <p class="blog-post-meta">{{$n->created_at->diffForHumans()}}</p>
    <img height="150" src="{{$n->showNewsPhoto($n->id)}}" alt="">
    <p>{{str_limit($n->content, $limit = 250)}}</p>
    <a href="{{ route('front.news.show', $n->id) }}">Continue reading</a>
  </div><!-- /.blog-post -->
@empty
  <h2 class="blog-post-title">No news found.</h2>
@endforelse
{{ $news->links() }}

@endsection
