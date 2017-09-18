@extends('master')

@section('content')
  <div class="container">

    {!! Form::model($report, [
      'method' => 'PUT',
      'route' => ['submit.update', $report->id],
    ]) !!}

    {{ Form::submit() }}

    {!! Form::close() !!}

  </div>
@endsection
