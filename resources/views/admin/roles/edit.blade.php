@extends('layouts.admin')

@section('title', 'Movie Application - Edit role '.$role->name)

@section('heading', 'Edit role - '.$role->name)

@section('description', 'Edit role - '.$role->name)

@section('content')

  {{ Form::model($role, ['method' => 'PATCH', 'action' => ['AdminRolesController@update', $role->id], 'class' => 'col-md-12', 'files' => true]) }}
    <div class="form-group">
      {{ Form::label('name', 'Name') }}
      {{ Form::text('name', null, ['class' => 'form-control']) }}
    </div>
    <div class="form-group">
      {{ Form::submit('Edit role', ['class' => 'btn btn-primary']) }}
    </div>
  {{ Form::close() }}

  {{ Form::open(['method' => 'DELETE', 'action' => ['AdminRolesController@destroy', $role->id], 'class' => 'col-md-12']) }}
    <div class="form-group">
      {{ Form::submit('Delete role', ['class' => 'btn btn-danger']) }}
    </div>
  {{ Form::close() }}

@endsection
