@extends('master')

@section('content')
  <div class="container">

    {!! Form::model($report, [
      'method' => 'PUT',
      'route' => ['submit.update', $report->id],
    ]) !!}

    @foreach ($sections as $section)
        <h2>{{ $section->title }}</h2>
        @foreach ($section->improvements as $improvement)
            <h4>{{ $improvement->title }}</h4>
            <span>{{ $improvement->description }}</span>
        @endforeach
    @endforeach

    {{ Form::submit() }}

    {!! Form::close() !!}

  </div>
@endsection
