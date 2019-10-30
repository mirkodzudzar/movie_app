@extends('layouts.front')

@section('title', 'Movie Application - News')

@section('top')
<div class="jumbotron p-4 p-md-5 text-white rounded bg-dark">
  <div class="col-md-6 px-0">
    <h1 class="display-4 font-italic">{{$latest_news->title}}</h1>
    <p class="lead my-3">{{str_limit($latest_news->content, $limit=250)}}</p>
    <p class="lead mb-0"><a href="{{ route('front.news.show', $latest_news->id) }}" class="text-white font-weight-bold">Continue reading...</a></p>
  </div>
</div>

<div class="row mb-2">
  <div class="col-md-6">
    <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
      <div class="col p-4 d-flex flex-column position-static">
        <strong class="d-inline-block mb-2 text-primary">Movie #1</strong>
        <h3 class="mb-0">{{$top_movie->name}}</h3>
        <div class="mb-1 text-muted">{{$top_movie->release_date}}</div>
        <p class="card-text mb-auto">{{str_limit($latest_movie->description, $limit = 25)}}</p>
        <a href="#" class="stretched-link">Continue reading</a>
      </div>
      <div class="col-auto d-none d-lg-block">
        <img height="180" src="{{$latest_movie->showMovieImage($latest_movie->id)}}" alt="">
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
      <div class="col p-4 d-flex flex-column position-static">
        <strong class="d-inline-block mb-2 text-success">Latest movie</strong>
        <h3 class="mb-0">{{$latest_movie->name}}</h3>
        <div class="mb-1 text-muted">{{$latest_movie->release_date}}</div>
        <p class="mb-auto">{{str_limit($latest_movie->description, $limit = 25)}}</p>
        <a href="#" class="stretched-link">Continue reading</a>
      </div>
      <div class="col-auto d-none d-lg-block">
        <img height="180" src="{{$latest_movie->showMovieImage($latest_movie->id)}}" alt="">
      </div>
    </div>
  </div>
</div>
@endsection

@section('content')
<h3 class="pb-4 mb-4 font-italic border-bottom">
  News
</h3>

@forelse($news as $n)
  <div class="blog-post">
    <h2 class="blog-post-title"><a href="{{ route('front.news.show', $n->id) }}">{{$n->title}}</a></h2>
    <p class="blog-post-meta">{{$n->created_at->diffForHumans()}} by <a href="{{ route('front.users.show', $n->user_id) }}">{{$n->user->full_name}}</a></p>
    <img height="150" src="{{$n->showNewsPhoto($n->id)}}" alt="">
    <p>{{str_limit($n->content, $limit = 250)}}</p>
    <a href="{{ route('front.news.show', $n->id) }}">Continue reading</a>
    <hr>
  </div><!-- /.blog-post -->
@empty
  <h2 class="blog-post-title">No news found.</h2>
@endforelse
{{ $news->links() }}

@auth
  @if(Auth::user()->role_id)
    @if(Auth::user()->isAuthor())
      <h3 class="pb-4 mb-4 font-italic border-bottom" id="create_news">
        Create some news
      </h3>
      {{ Form::open(['method' => 'POST', 'action' => 'NewsController@store', 'class' => 'col-md-12', 'files' => true]) }}
        <div class="form-group">
          {{ Form::label('title', 'Title') }}
          {{ Form::text('title', null, ['class' => 'form-control']) }}
        </div>
        <div class="form-group">
          {{ Form::label('content', 'Content') }}
          {{ Form::textarea('content', null, ['class' => 'form-control']) }}
        </div>
        <div class="form-group">
          {{ Form::label('photo_id', 'Photo:') }}
          {{ Form::file('photo_id', null) }}
        </div>
        <div class="form-group">
          {{ Form::submit('Create news', ['class' => 'btn btn-primary']) }}
        </div>
      {{ Form::close() }}
    @endif
  @endif
@endauth

@endsection
