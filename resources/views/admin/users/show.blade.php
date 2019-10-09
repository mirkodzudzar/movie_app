@extends('layouts.admin')

@section('heading', $user->first_name.' '.$user->last_name)

@section('description', $user->first_name.' '.$user->last_name)

@section('content')
  <div class="table-responsive">
    <table class="table table-bordered table-hover text-center">
      <tr>
        <th colspan="2" class="text-center"><img height="100" src="{{ asset('images/'.$photo) }}"></th>
      </tr>
      <tr>
        <th>Id</th>
        <td>{{$user->id}}</td>
      </tr>
      <tr>
        <th>First name</th>
        <td>{{$user->first_name}}</td>
      </tr>
      <tr>
        <th>Last name</th>
        <td>{{$user->last_name}}</td>
      </tr>
      <tr>
        <th>Username</th>
        <td>{{$user->username}}</td>
      </tr>
      <tr>
        <th>Email</th>
        <td>{{$user->email}}</td>
      </tr>
      <tr>
        <th>Created at</th>
        <td>{{$user->created_at}}</td>
      </tr>
      <tr>
        <th>Updated at</th>
        <td>{{$user->updated_at}}</td>
      </tr>
      <tr>
        <!-- change to dinamic -->
        <th>Change role({{$user->role['name']}})</th>
        <td>
          @if($user->role['name'] == 'administrator')
          <a href="" class="btn btn-primary">Subscriber</a>
          @else
          <a href="" class="btn btn-primary">Admin</a>
          @endif
        </td>
      </tr>
      <tr>
        <!-- delete styles later -->
        <th rowspan="2" style="vertical-align : middle; text-align:center;">Edit/Delete actions</th>
        <td>
          <a href="{{ route('admin.users.edit', $user->id )}}" class="btn btn-success">Edit</a>
          {{ Form::open(['method' => 'DELETE', 'action' => ['AdminUsersController@destroy', $user->id]]) }}
            <div class="form-group">
              {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
            </div>
          {{ Form::close() }}
        </td>
      </tr>
    </table>
  </div>
@endsection
