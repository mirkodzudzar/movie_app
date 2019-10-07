@extends('layouts.admin')

@section('heading', 'Users')

@section('description', 'Users')

@section('content')
  <div class="table-responsive">
    <table class="table table-bordered table-hover">
      <thead class="text-center">
        <th>Id</th>
        <th>First name</th>
        <th>Last name</th>
        <th>Username</th>
        <th>Email</th>
        <th>Created at</th>
        <th>Updated at</th>
        <th colspan="2">Change role</th>
        <th colspan="2">Edit/Delete actions</th>
      </thead>
      <tbody>
        @foreach($users as $user)
          <tr>
            <td class="text-center">{{$user->id}}</td>
            <td>{{$user->first_name}}</td>
            <td><a href="{{ route('admin.users.show', $user->id) }}">{{$user->last_name}}</a></td>
            <td>{{$user->username}}</td>
            <td>{{$user->email}}</td>
            <td class="text-center">{{$user->created_at}}</td>
            <td class="text-center">{{$user->updated_at}}</td>
            <td class="text-center"><a href="" class="btn btn-primary">Admin</a></td>
            <td class="text-center"><a href="" class="btn btn-primary">Subscriber</a></td>
            <td class="text-center"><a href="{{ route('admin.users.edit', $user->id )}}" class="btn btn-success">Edit</a></td>
            <td class="text-center">
              {{ Form::open(['method' => 'DELETE', 'action' => ['AdminUsersController@destroy', $user->id]]) }}
                <div class="form-group">
                  {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
                </div>
              {{ Form::close() }}
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection