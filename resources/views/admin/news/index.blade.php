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
      <th colspan="2">Edit/Delete actions</th>
      <th colspan="2">Approve/Un-approve actions</th>
    </thead>
    <tbody>
      @forelse($news as $news)
        <tr>
          <td>{{$news->id}}</td>
          <td></td>
          <td>{{$news->title}}</td>
          <td>{{str_limit($news->content, $limit = 25, $end = '...')}}</td>
          <td>{{$news->user->full_name}}</td>
          <td><a href="" class="btn btn-success">Edit</a></td>
          <td>Delete</td>
          <td>Approve</td>
          <td>Un-approve</td>
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
