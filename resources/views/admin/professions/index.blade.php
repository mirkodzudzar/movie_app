@extends('layouts.admin')

@section('heading', 'Professions')

@section('description', 'Professions')

@section('content')
<div class="table-responsive">
  <table class="table table-bordered table-hover">
    <thead class="text-center">
      <th>Id</th>
      <th>Name</th>
      <th>Number of celebrities</th>
      <th>Created at</th>
      <th>Updated at</th>
      <th colspan="2">Edit/Delete actions</th>
    </thead>
    <tbody>
      @forelse($professions as $profession)
        <tr>
          <td class="text-center">{{$profession->id}}</td>
          <td class="text-center">{{$profession->name}}</td>
          <td class="text-center">{{$profession->actorByProfessionCount($profession->id)}}</td>
          <td class="text-center">{{$profession->created_at}}</td>
          <td class="text-center">{{$profession->updated_at}}</td>
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
          <th colspan='11' class="text-center">No movies found.</th>
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
