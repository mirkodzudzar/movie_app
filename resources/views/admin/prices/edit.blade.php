@extends('layouts.admin')

@section('heading', 'Edit price')

@section('description', 'Edit price')

@section('content')

  {{ Form::model($price, ['method' => 'PATCH', 'action' => ['AdminPricesController@update', $price->id], 'class' => 'col-md-12', 'files' => true]) }}
    <div class="form-group">
      {{ Form::label('value', 'Value') }}
      {{ Form::text('value', null, ['class' => 'form-control']) }}
    </div>
    <div class="form-group">
      {{ Form::submit('Edit price', ['class' => 'btn btn-primary']) }}
    </div>
  {{ Form::close() }}

  {{ Form::open(['method' => 'DELETE', 'action' => ['AdminPricesController@destroy', $price->id], 'class' => 'col-md-12']) }}
    <div class="form-group">
      {{ Form::submit('Delete price', ['class' => 'btn btn-danger']) }}
    </div>
  {{ Form::close() }}

@endsection
