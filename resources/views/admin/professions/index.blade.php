@extends('layouts.admin')

@section('title', 'Movie Application - Professions')

@section('search_form')
  {{ Form::open(['method' => 'POST', 'action' => 'AdminProfessionsController@index', 'role' => 'search', 'class' => 'form-inline ml-3']) }}
    <div class="input-group input-group-sm">
      {{ Form::text('query', '', ['class' => 'form-control form-control-navbar', 'placeholder' => 'Search for professions', 'aria-label' => 'Search']) }}
      <div class="input-group-append">
        <button class="btn btn-navbar" type="submit">
          <i class="fas fa-search"></i>
        </button>
      </div>
    </div>
  {{ Form::close() }}
@endsection

@section('heading', "Professions ({$professions_count})")

@section('description', 'Professions')

@section('content')
@if(isset($details))
<div class="card-body table-responsive p-0">
  <p class="bg-primary">The search results for your query <b> {{$query}} </b> are: </p>
  <table class="table table-hover text-center">
    <thead class="bg-primary">
      <tr>
        <td>Id</td>
        <td>Profession name</td>
      </tr>
    </thead>
    <tbody>
      @foreach($details as $profession)
        <tr>
          <td>{{$profession->id}}</td>
          <td><a href="{{ route('admin.professions.edit', $profession->id) }}">{{$profession->name}}</a></td>
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
      <th>Name</th>
      <th>Number of celebrities</th>
      <th colspan="2">Created at/Updated at</th>
      <th colspan="2">Edit/Delete actions</th>
    </thead>
    <tbody>
      @forelse($professions as $profession)
        <tr>
          <td>{{$profession->id}}</td>
          <td>{{$profession->name}}</td>
          <td>{{$profession->numberOfCelebrities($profession->id)}}</td>
          <td>{{date('Y-m-d', strtotime($profession->created_at))}}</td>
          <td>{{date('Y-m-d', strtotime($profession->updated_at))}}</td>
          <td><a href="{{ route('admin.professions.edit', $profession->id)}}" class="btn btn-success">Edit</a></td>
          <td>
            {{ Form::open(['method' => 'DELETE', 'action' => ['AdminProfessionsController@destroy', $profession->id]]) }}
              <div class="form-group">
                {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
              </div>
            {{ Form::close() }}
          </td>
        </tr>
      @empty
        <tr>
          <th colspan='11'>No professions found.</th>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>
<h2>Create new genre</h2>
{{ Form::open(['method' => 'POST', 'action' => 'AdminProfessionsController@store', 'class' => 'col-md-12', 'files' => true]) }}
  <div class="form-group">
    {{ Form::label('name', 'Name') }}
    {{ Form::text('name', null, ['class' => 'form-control']) }}
  </div>
  <div class="form-group">
    {{ Form::submit('Create profession', ['class' => 'btn btn-primary']) }}
  </div>
{{ Form::close() }}
@endsection
