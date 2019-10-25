@extends('layouts.front')

@section('top')
<div class="jumbotron p-4 p-md-5 text-white rounded bg-dark">
  <div class="col-md-6 px-0">
    <h1 class="display-4 font-italic">{{$latest_news->title}}</h1>
    <p class="lead my-3">{{str_limit($latest_news->content, $limit=250)}}</p>
    <p class="lead mb-0"><a href="#" class="text-white font-weight-bold">Continue reading...</a></p>
  </div>
</div>

<div class="row mb-2">
  <div class="col-md-6">
    <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
      <div class="col p-4 d-flex flex-column position-static">
        <strong class="d-inline-block mb-2 text-primary">Movie #1</strong>
        <h3 class="mb-0">Featured post</h3>
        <div class="mb-1 text-muted">Nov 12</div>
        <p class="card-text mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
        <a href="#" class="stretched-link">Continue reading</a>
      </div>
      <div class="col-auto d-none d-lg-block">
        <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
      <div class="col p-4 d-flex flex-column position-static">
        <strong class="d-inline-block mb-2 text-success">Latest movie</strong>
        <h3 class="mb-0">{{$latest_movie->name}}</h3>
        <div class="mb-1 text-muted">{{$latest_movie->release_date}}</div>
        <p class="mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
        <a href="#" class="stretched-link">Continue reading</a>
      </div>
      <div class="col-auto d-none d-lg-block">
        <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>
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
    <h2 class="blog-post-title">{{$n->title}}</h2>
    <p class="blog-post-meta">{{$n->created_at->diffForHumans()}} by <a href="#">{{$n->user->full_name}}</a></p>
    <img height="150" src="{{$n->showNewsPhoto($n->id)}}" alt="">
    <p>{{str_limit($n->content, $limit = 250)}}</p>
    <a href="#" class="stretched-link">Continue reading</a>
    <hr>
  </div><!-- /.blog-post -->
@empty
  <h2 class="blog-post-title">No news found.</h2>
@endforelse
{{ $news->links() }}
@endsection
