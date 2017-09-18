@extends('master')

@section('content')
  <div class="container">

    {!! Form::model($report, [
      'method' => 'PUT',
      'route' => ['reports.update', $report->id],
    ]) !!}

      <div class="form-group">
        {{ Form::label('title', 'Some field that doesn\'t exist yet') }}
        {{ Form::text('title', null, ['class' => 'form-control']) }}
      </div>

      {{ Form::submit() }}

    {!! Form::close() !!}

  </div>
@endsection
