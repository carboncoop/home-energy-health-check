@extends('master')

@section('content')
  <div class="container">

    {{ Form::model($improvement, [
      'action' => ['ImprovementsController@store', $improvement->id]
    ]) }}

    <div class="form-group">
      {{ Form::label('title', 'Title') }}
      {{ Form::text('title', null, ['class' => 'form-control']) }}
    </div>

    <div class="form-group">
      {{ Form::label('description', 'Description') }}
      {{ Form::textarea('description', null, ['class' => 'form-control']) }}
    </div>

    <div class="form-group">
      {{ Form::label('estimated_cost', 'Estimated Cost') }}
      {{ Form::text('estimated_cost', null, ['class' => 'form-control']) }}
    </div>

  </div>
@endsection
