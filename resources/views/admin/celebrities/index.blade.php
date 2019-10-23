@extends('layouts.admin')

@section('title', 'Movie Application - Celebrities')

@section('search_form')
  {{ Form::open(['method' => 'POST', 'action' => 'AdminCelebritiesController@index', 'role' => 'search', 'class' => 'form-inline ml-3']) }}
    <div class="input-group input-group-sm">
      {{ Form::text('query', '', ['class' => 'form-control form-control-navbar', 'placeholder' => 'Search for celebrities', 'aria-label' => 'Search']) }}
      <div class="input-group-append">
        <button class="btn btn-navbar" type="submit">
          <i class="fas fa-search"></i>
        </button>
      </div>
    </div>
  {{ Form::close() }}
@endsection

@section('heading', 'Celebrities')

@section('description', 'Celebrities')

@section('content')
@if(isset($details))
<div class="card-body table-responsive p-0">
  <p class="bg-primary">The search results for your query <b> {{$query}} </b> are: </p>
  <table class="table table-hover text-center">
    <thead class="bg-primary">
      <tr>
        <td>Id</td>
        <td>Image</td>
        <td>Full name (first/last)</td>
      </tr>
    </thead>
    <tbody>
      @foreach($details as $celebrity)
        <tr>
          <td>{{$celebrity->id}}</td>
          <td><img height="50" src="{{$celebrity->showCelebrityImage($celebrity->id)}}" alt=""></td>
          <td><a href="{{ route('admin.celebrities.show', $celebrity->id) }}">{{$celebrity->full_name}}</a></td>
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
        <th>Name (First/Last)</th>
        <th>Profession</th>
        <th>Date of birth</th>
        <th>State of birth</th>
        <th colspan="2">Created at/Updated at</th>
        <th colspan="2">Edit/Delete actions</th>
      </thead>
      <tbody>
        @forelse($celebrities as $celebrity)
          <tr>
            <td>{{$celebrity->id}}</td>
            <td><img height="50" src="{{$celebrity->showCelebrityImage($celebrity->id)}}" alt=""></td>
            <td><a href="{{ route('admin.celebrities.show', $celebrity->id) }}">{{$celebrity->full_name}}</a></td>
            <td>{{$celebrity->professions($celebrity->id)}}</td>
            <td>{{$celebrity->date_of_birth}}</td>
            <td>{{$celebrity->state_of_birth}}</td>
            <td>{{date('Y-m-d', strtotime($celebrity->created_at))}}</td>
            <td>{{date('Y-m-d', strtotime($celebrity->updated_at))}}</td>
            <td><a href="{{ route('admin.celebrities.edit', $celebrity->id )}}" class="btn btn-success">Edit</a></td>
            <td>
              {{ Form::open(['method' => 'DELETE', 'action' => ['AdminCelebritiesController@destroy', $celebrity->id]]) }}
                <div class="form-group">
                  {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
                </div>
              {{ Form::close() }}
            </td>
          </tr>
        @empty
          <tr>
            <th colspan='11'>No celebrities found.</th>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
@endsection
