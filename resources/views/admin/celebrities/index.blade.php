@extends('layouts.admin')

@section('heading', 'Celebrities')

@section('description', 'Celebrities')

@section('content')
  <div class="table-responsive">
    <table class="table table-bordered table-hover">
      <thead class="text-center">
        <th>Id</th>
        <th>Image</th>
        <th>First name</th>
        <th>Last name</th>
        <th>Profession</th>
        <th>Created at</th>
        <th>Updated at</th>
        <th colspan="2">Edit/Delete actions</th>
      </thead>
      <tbody>
        @forelse($celebrities as $celebrity)
          <tr>
            <td class="text-center">{{$celebrity->id}}</td>
            <td><img height="50" src="http://placehold.it/700x200" alt=""></td>
            <td>{{$celebrity->first_name}}</td>
            <td><a href="{{ route('admin.celebrities.show', $celebrity->id) }}">{{$celebrity->last_name}}</a></td>
            <td class="text-center">
              <?php
                $counter = 1;
                $profession_count = count($celebrity->professions()->get());
              ?>
              @foreach($celebrity->professions as $profession)
                @if($profession_count == $counter)
                  {{$profession->name}}
                @else
                  {{$profession->name.", "}}
                @endif
                <?php $counter = $counter + 1; ?>
              @endforeach
            </td>
            <td class="text-center">{{$celebrity->created_at}}</td>
            <td class="text-center">{{$celebrity->updated_at}}</td>
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
