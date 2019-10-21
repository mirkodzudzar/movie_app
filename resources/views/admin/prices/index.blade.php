@extends('layouts.admin')

@section('title', 'Movie Application - Prices of movies')

@section('heading', 'Prices of movies')

@section('description', 'Prices of movies')

@section('content')
<div class="table-responsive">
  <table class="table table-bordered table-hover">
    <thead class="text-center bg-success">
      <th>Id</th>
      <th>Image</th>
      <th>Name</th>
      <th>Time duration</th>
      <th>Release date</th>
      @foreach($professions as $profession)
        <th>{{$profession->name}}(s)</th>
      @endforeach
      <th>Genre</th>
      <th>Price</th>
    </thead>
    <tbody>
      @forelse($movies as $movie)
        <tr>
          <td class="text-center">{{$movie->id}}</td>
          <td><img height="50" src="http://placehold.it/700x200" alt=""></td>
          <td class="text-center"><a href="{{ route('admin.movies.show', $movie->id) }}">{{$movie->name}}</a></td>
          <td class="text-center">{{$movie->time_duration}}</td>
          <td class="text-center">{{$movie->release_date}}</td>
          @foreach($professions as $profession)
            <td class="text-center">{{$movie->professions($movie->id, $profession->id)}}</td>
          @endforeach
          <td class="text-center">
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
              <td class="text-center bg-success"><a href="{{ route('admin.prices.edit', $movie->id) }}">{{$movie->price['value']}} $</a></td>
            @else
              <td class="text-center bg-danger"><a href="{{ route('admin.prices.edit', $movie->id) }}">unaveilable</a></td>
            @endif
        </tr>
      @empty
        <tr>
          <th colspan='11' class="text-center">No movies found.</th>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection
