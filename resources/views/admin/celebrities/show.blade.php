@extends('layouts.admin')

@section('title', 'Movie Application - Celebrity '.$celebrity->full_name)

@section('heading', 'Celebrity - '.$celebrity->full_name)

@section('description', 'Celebrity - '.$celebrity->full_name)

@section('content')
  <div class="table-responsive">
    <table class="table table-bordered table-hover text-center">
      <tr>
        <th colspan="2" class="text-center">
          @foreach($celebrity->images as $image)
            <img height="50" src="{{$image ? $image->file : App\Image::noImage()}}" alt="">
          @endforeach
        </th>
      </tr>
      <tr>
        <th>Id</th>
        <td>{{$celebrity->id}}</td>
      </tr>
      <tr>
        <th>First name</th>
        <td>{{$celebrity->first_name}}</td>
      </tr>
      <tr>
        <th>Last name</th>
        <td>{{$celebrity->last_name}}</td>
      </tr>
      <tr>
        <th>Date of birth</th>
        <td>{{$celebrity->date_of_birth}}</td>
      </tr>
      <tr>
        <th>State of birth</th>
        <td>{{$celebrity->state_of_birth}}</td>
      </tr>
      <tr>
        <th>Created at</th>
        <td>{{$celebrity->created_at}}</td>
      </tr>
      <tr>
        <th>Updated at</th>
        <td>{{$celebrity->updated_at}}</td>
      </tr>
      <tr>
        <!-- delete styles later -->
        <th rowspan="2" style="vertical-align : middle; text-align:center;">Edit/Delete actions</th>
        <td>
          <a href="{{ route('admin.celebrities.edit', $celebrity->id )}}" class="btn btn-success">Edit</a>
          {{ Form::open(['method' => 'DELETE', 'action' => ['AdminCelebritiesController@destroy', $celebrity->id]]) }}
            <div class="form-group">
              {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
            </div>
          {{ Form::close() }}
        </td>
      </tr>
    </table>
  </div>
@endsection
