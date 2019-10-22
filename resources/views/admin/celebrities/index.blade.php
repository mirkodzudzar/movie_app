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
<div class="table-responsive">
  <table class="table table-bordered table-hover">
    <thead class="bg-primary">
      <tr>
        <td colspan="3">The search results for <b> {{$query}} </b> are: </td>
      </tr>
    </thead>
    <tbody>
      @foreach($details as $celebrity)
        <tr>
          <td class="text-center">{{$celebrity->id}}</td>
          <td class="text-center"><img height="50" src="{{$celebrity->showCelebrityImage($celebrity->id)}}" alt=""></td>
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
  <div class="table-responsive">
    <table class="table table-bordered table-hover">
      <thead class="text-center bg-success">
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
            <td class="text-center">{{$celebrity->id}}</td>
            <td class="text-center"><img height="50" src="{{$celebrity->showCelebrityImage($celebrity->id)}}" alt=""></td>
            <td><a href="{{ route('admin.celebrities.show', $celebrity->id) }}">{{$celebrity->full_name}}</a></td>
            <td class="text-center">{{$celebrity->professions($celebrity->id)}}</td>
            <td class="text-center">{{$celebrity->date_of_birth}}</td>
            <td class="text-center">{{$celebrity->state_of_birth}}</td>
            <td class="text-center">{{date('Y-m-d', strtotime($celebrity->created_at))}}</td>
            <td class="text-center">{{date('Y-m-d', strtotime($celebrity->updated_at))}}</td>
            <td class="text-center"><a href="{{ route('admin.celebrities.edit', $celebrity->id )}}" class="btn btn-success">Edit</a></td>
            <td class="text-center">
              {{ Form::open(['method' => 'DELETE', 'action' => ['AdminCelebritiesController@destroy', $celebrity->id]]) }}
                <div class="form-group">
                  {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
                </div>
              {{ Form::close() }}
            </td>
          </tr>
        @empty
          <tr>
            <th colspan='11' class="text-center">No celebrities found.</th>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
@endsection
