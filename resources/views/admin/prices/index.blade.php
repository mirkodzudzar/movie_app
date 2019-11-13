@extends('layouts.admin')

@section('title', 'Movie Application - Prices of movies')

@section('search_form')
  {{ Form::open(['method' => 'POST', 'action' => 'AdminPricesController@index', 'role' => 'search', 'class' => 'form-inline ml-3']) }}
    <div class="input-group input-group-sm">
      {{ Form::text('query', '', ['class' => 'form-control form-control-navbar', 'placeholder' => 'Search for movies', 'aria-label' => 'Search']) }}
      <div class="input-group-append">
        <button class="btn btn-navbar" type="submit">
          <i class="fas fa-search"></i>
        </button>
      </div>
    </div>
  {{ Form::close() }}
@endsection

@section('heading', "Prices of movies ({$prices_count})")

@section('description', 'Prices of movies')

@section('content')
@if(isset($details))
<div class="card-body table-responsive p-0">
  <p class="bg-primary">The search results for your query <b> {{$query}} </b> are: </p>
  <table class="table table-hover text-center">
    <thead class="bg-primary">
      <tr>
        <td>Id</td>
        <td>Movie name</td>
        <td>Price</td>
      </tr>
    </thead>
    <tbody>
      @foreach($details as $movie)
        <tr>
          <td>{{$movie->id}}</td>
          <td><a href="{{ route('admin.movies.show', $movie->id) }}">{{$movie->name}}</a></td>
          @if($movie->price)
            <td class="bg-success"><a href="{{ route('admin.prices.edit', $movie->id) }}">{{$movie->price['value']}} $</a></td>
          @else
            <td class="bg-danger"><a href="{{ route('admin.prices.edit', $movie->id) }}">unaveilable</a></td>
          @endif
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
<div class="card-body table-responsive p-0">
  <table class="table table-hover text-center">
    <thead class="bg-success">
      <th>Id</th>
      <th>Image</th>
      <th>Name</th>
      <th>Time duration</th>
      <th>Release date</th>
      <th>Genre</th>
      <th>Price</th>
    </thead>
    <tbody>
      @forelse($movies as $movie)
        <tr>
          <td>{{$movie->id}}</td>
          <td><img height="50" src="{{$movie->showMovieImage($movie->id)}}" alt=""></td>
          <td><a href="{{ route('admin.movies.show', $movie->id) }}">{{$movie->name}}</a></td>
          <td>{{$movie->time_duration}}</td>
          <td>{{$movie->release_date}}</td>
          <td>
            <?php
              $counter = 1;
              $genre_count = count($movie->genres()->get());
            ?>
            @foreach($movie->genres as $genre)
              @if($genre_count == $counter)
                {{$genre->name}}
              @else
                {{$genre->name.", "}}
              @endif
              <?php $counter = $counter + 1; ?>
            @endforeach
          </td>

            @if($movie->price)
              <td class="bg-success"><a href="{{ route('admin.prices.edit', $movie->id) }}">{{$movie->price['value']}} $</a></td>
            @else
              <td class="bg-danger"><a href="{{ route('admin.prices.edit', $movie->id) }}">unaveilable</a></td>
            @endif
        </tr>
      @empty
        <tr>
          <th colspan='11'>No movies found.</th>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection
