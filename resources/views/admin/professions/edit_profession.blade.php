@extends('layouts.admin')

@section('heading', '/')

@section('description', '/')

@section('content')

  {{ Form::model([$profession->id, $movie->id], ['method' => 'PATCH', 'action' => ['AdminProfessionsController@updateProfession', $profession->id, $movie->id], 'class' => 'col-md-12', 'files' => true]) }}
    <div class="table-responsive">
      {{ Form::label('profession', 'Professions') }}
      <table class="table table-bordered table-hover">
        <thead class="text-center">
            <th class="bg-success">{{$profession->name}}</th>
            {{Form::hidden('profession_id', $profession->id)}}
        </thead>
        <tbody>
          @foreach($celebrities as $celebrity)
            <tr>
              <!-- getFullNameAttribute -->
              <td>
                {{ Form::checkbox('celebrity[]', $celebrity->id, $celebrity->checkingCelebrity($movie->id, $celebrity->id, $profession->id), ['class' => 'form-check-inpit'])}}
                {{ Form::label('$celebrity->id', $celebrity->full_name, ['class' => 'form-check-label'])}}
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="form-group">
      {{ Form::submit('Edit movie', ['class' => 'btn btn-primary']) }}
    </div>
  {{ Form::close() }}

@endsection
