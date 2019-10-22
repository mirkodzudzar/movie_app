@extends('layouts.admin')

@section('title', 'Movie Application - Genres')

@section('search_form')
  {{ Form::open(['method' => 'POST', 'action' => 'AdminGenresController@index', 'role' => 'search', 'class' => 'form-inline ml-3']) }}
    <div class="input-group input-group-sm">
      {{ Form::text('query', '', ['class' => 'form-control form-control-navbar', 'placeholder' => 'Search for genres', 'aria-label' => 'Search']) }}
      <div class="input-group-append">
        <button class="btn btn-navbar" type="submit">
          <i class="fas fa-search"></i>
        </button>
      </div>
    </div>
  {{ Form::close() }}
@endsection

@section('heading', 'Genres')

@section('description', 'Genres')

@section('content')
@if(isset($details))
<div class="table-responsive">
  <table class="table table-bordered table-hover">
    <thead class="bg-primary">
      <tr>
        <td>The search results for <b> {{$query}} </b> are: </td>
      </tr>
    </thead>
    <tbody>
      @foreach($details as $genre)
        <tr>
          <td><a href="{{route('admin.genres.edit', $genre->id)}}">{{$genre->name}}</a></td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
  <!-- When you search for empty string, it will not show a message -->
  @elseif(isset($message))
    <div class="alert alert-danger">
      <p>{{$message}}</p>
    </div>
  @endif
</div>
<div class="table-responsive">
  <table class="table table-bordered table-hover">
    <thead class="text-center bg-success">
      <th>Id</th>
      <th>Name</th>
      <th>Number of movies</th>
      <th colspan="2">Created at/Updated at</th>
      <th colspan="2">Edit/Delete actions</th>
    </thead>
    <tbody>
      @forelse($genres as $genre)
        <tr>
          <td class="text-center">{{$genre->id}}</td>
          <td class="text-center">{{$genre->name}}</td>
          <td class="text-center">{{$genre->movieByGenreCount($genre->id)}}</td>
          <td class="text-center">{{date('Y-m-d', strtotime($genre->created_at))}}</td>
          <td class="text-center">{{date('Y-m-d', strtotime($genre->updated_at))}}</td>
          <td class="text-center"><a href="{{ route('admin.genres.edit', $genre->id)}}" class="btn btn-success">Edit</a></td>
          <td class="text-center">
            {{ Form::open(['method' => 'DELETE', 'action' => ['AdminGenresController@destroy', $genre->id]]) }}
              <div class="form-group">
                {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
              </div>
            {{ Form::close() }}
          </td>
        </tr>
      @empty
        <tr>
          <th colspan='11' class="text-center">No genres found.</th>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>
<h2>Create new genre</h2>
{{ Form::open(['method' => 'POST', 'action' => 'AdminGenresController@store', 'class' => 'col-md-12', 'files' => true]) }}
  <div class="form-group">
    {{ Form::label('name', 'Name') }}
    {{ Form::text('name', null, ['class' => 'form-control']) }}
  </div>
  <div class="form-group">
    {{ Form::submit('Create genre', ['class' => 'btn btn-primary']) }}
  </div>
{{ Form::close() }}
@endsection
