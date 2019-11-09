@extends('layouts.admin')

@section('title', 'Movie Application - Images')

@section('heading', 'Images')

@section('description', 'Images')

@section('content')
<div class="card-body table-responsive p-0">
  {{ Form::label('celebrity_image', 'Images of celebrities', ['id' => 'celebrities']) }}
  <table class="table table-hover text-center">
    <thead class="bg-success">
        <th >Id</th>
        <th>Image</th>
        <th>Celebrity</th>
        <th colspan="2">Created/Updated at</th>
        <th>Delete actions</th>
      </thead>
      <tbody>
        @forelse($celebrities as $celebrity)
          @foreach($celebrity->images as $image)
            <tr>
              <td>{{$image->id}}</td>
              <td><img height="50" src="{{$image->file}}" alt=""></td>
              <td><a href="{{ route('admin.celebrities.show', $celebrity->id) }}">{{$celebrity->full_name}}</a></td>
              <td>{{$image->created_at}}</td>
              <td>{{$image->updated_at}}</td>
              <td>
                {{ Form::open(['method' => 'DELETE', 'action' => ['AdminImagesController@destroyCelebrityImage', $image->id, $celebrity->id]]) }}
                  <div class="form-group">
                    {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
                  </div>
                {{ Form::close() }}
              </td>
            </tr>
          @endforeach
        @empty
          <tr>
            <th colspan='11'>No images for celebrities found.</th>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div class="card-body table-responsive p-0">
    {{ Form::label('movie_image', 'Images of movies', ['id' => 'movies']) }}
    <table class="table table-hover text-center">
      <thead class="bg-success">
        <th>Id</th>
        <th>Image</th>
        <th>Movie</th>
        <th colspan="2">Created/Updated at</th>
        <th>Delete actions</th>
      </thead>
      <tbody>
        @forelse($movies as $movie)
          @foreach($movie->images as $image)
            <tr>
              <td>{{$image->id}}</td>
              <td><img height="50" src="{{$image->file}}" alt=""></td>
              <td><a href="{{ route('admin.movies.show', $movie->id) }}">{{$movie->name}}</a></td>
              <td>{{$image->created_at}}</td>
              <td>{{$image->updated_at}}</td>
              <td>
                {{ Form::open(['method' => 'DELETE', 'action' => ['AdminImagesController@destroyMovieImage', $image->id, $movie->id]]) }}
                  <div class="form-group">
                    {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
                  </div>
                {{ Form::close() }}
              </td>
            </tr>
          @endforeach
        @empty
          <tr>
            <th colspan='11'>No images for movies found.</th>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
  {{ Form::open(['method' => 'POST', 'action' => 'AdminImagesController@store', 'class' => 'col-md-12', 'files' => true]) }}
  <div class="card-body table-responsive p-0" id="create_image">
    {{ Form::label('create_image', 'Create new image', ['id' => 'movies']) }}
    <table class="table table-hover">
        <thead class="bg-success">
          <th>Chose image</th>
          <th>Chose movie</th>
          <th>Chose celebrity/celebrities</th>
        </thead>
        <tbody>
          <tr>
            <td rowspan="{{$celebrities->count()+2}}">
              {{ Form::label('image_id', 'Image:') }}
              {{ Form::file('image_id', null) }}
            </td>
          </tr>
          <tr>
            <td rowspan="{{$celebrities->count()+2}}">
              {{ Form::label('movie_id', 'Movie') }}
              {{ Form::select('movie_id', $select_movies, null, ['class' => 'form-control', 'placeholder' => 'Please Select']) }}
            </td>
              @foreach($celebrities as $celebrity)
                <tr>
                  <!-- getFullNameAttribute -->
                  <td>
                    {{ Form::checkbox('celebrity[]', $celebrity->id, false, ['class' => 'form-check-inpit'])}}
                    {{ Form::label('$celebrity->id', $celebrity->full_name, ['class' => 'form-check-label'])}}
                  </td>
                </tr>
              @endforeach
            </td>
          </tr>
        </tbody>
      </table>
      <div class="form-group">
        {{ Form::submit('Create image', ['class' => 'btn btn-primary']) }}
      </div>
    </div>
  {{ Form::close() }}
@endsection
