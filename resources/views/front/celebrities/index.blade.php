@extends('layouts.front')

@section('title', 'Movie Application - Celebrities')

@section('content')
<h3 class="pb-4 mb-4 font-italic border-bottom">
  Celebrities
</h3>

@forelse($celebrities as $celebrity)
  <div class="blog-post">
    <h2 class="blog-post-title"><a href="{{ route('front.celebrities.show', $celebrity->id) }}">{{$celebrity->full_name}}</a></h2>
    <p class="blog-post-meta">{{$celebrity->professions($celebrity->id)}}</p>
    <img height="150" src="{{$celebrity->showCelebrityImage($celebrity->id)}}" alt="">
    <hr>
  </div><!-- /.blog-post -->
@empty
  <h2 class="blog-post-title">No celebrities found.</h2>
@endforelse
{{ $celebrities->links() }}

@endsection
