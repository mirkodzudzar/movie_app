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

@section('heading', 'Professions')

@section('description', 'Professions')

@section('content')
@if(isset($details))
<div class="table-responsive">
  <table class="table table-bordered table-hover">
    <thead class="bg-primary">
      <tr>
        <td colspan="2">The search results for <b> {{$query}} </b> are: </td>
      </tr>
    </thead>
    <tbody>
      @foreach($details as $profession)
        <tr>
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
<div class="table-responsive">
  <table class="table table-bordered table-hover">
    <thead class="text-center bg-success">
      <th>Id</th>
      <th>Name</th>
      <th>Number of celebrities</th>
      <th colspan="2">Created at/Updated at</th>
      <th colspan="2">Edit/Delete actions</th>
    </thead>
    <tbody>
      @forelse($professions as $profession)
        <tr>
          <td class="text-center">{{$profession->id}}</td>
          <td class="text-center">{{$profession->name}}</td>
          <td class="text-center">{{$profession->numberOfCelebrities($profession->id)}}</td>
          <td class="text-center">{{date('Y-m-d', strtotime($profession->created_at))}}</td>
          <td class="text-center">{{date('Y-m-d', strtotime($profession->updated_at))}}</td>
          <td class="text-center"><a href="{{ route('admin.professions.edit', $profession->id)}}" class="btn btn-success">Edit</a></td>
          <td class="text-center">
            {{ Form::open(['method' => 'DELETE', 'action' => ['AdminProfessionsController@destroy', $profession->id]]) }}
              <div class="form-group">
                {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
              </div>
            {{ Form::close() }}
          </td>
        </tr>
      @empty
        <tr>
          <th colspan='11' class="text-center">No professions found.</th>
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
