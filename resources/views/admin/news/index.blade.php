@extends('layouts.admin')

@section('title', 'Movie Application - News')

@section('heading', 'News')

@section('description', 'News')

@section('content')
<div class="card-body table-responsive p-0">
  <table class="table table-hover text-center">
    <thead class="bg-success">
      <th>Id</th>
      <th>Image</th>
      <th>Title</th>
      <th>Content</th>
      <th>Author</th>
      <th>Delete action</th>
    </thead>
    <tbody>
      @forelse($news as $n)
        <tr>
          <td>{{$n->id}}</td>
          <td><img height="50" src="{{$n->showNewsPhoto($n->id)}}" alt=""></td>
          <td><a href="{{ route('front.news.show' ,$n->id) }}">{{$n->title}}</a></td>
          <td>{{str_limit($n->content, $limit = 25, $end = '...')}}</td>
          <td><a href="{{ route('admin.users.show', $n->user->id) }}">{{$n->user->full_name}}</a></td>
          <td>
            {{ Form::open(['method' => 'DELETE', 'action' => ['AdminNewsController@destroy', $n->id]]) }}
              <div class="form-group">
                {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
              </div>
            {{ Form::close() }}
          </td>
        </tr>
      @empty
        <tr>
          <th colspan='9'>No news found.</th>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection
