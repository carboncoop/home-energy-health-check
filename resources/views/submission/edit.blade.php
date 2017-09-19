@extends('master')

@section('content')

<div class="container">
    <div id="app">
        <submission :sections='{{ $json_sections }}'
            :improvements='{{ $json_improvements }}'>
        </submission>
    </div>
</div>

@if (2==3)
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
            <div class="card">
                <div class="form-group">
                    {{ Form::label('improvement.'.$improvement->id.'.status', 'Something you have') }}
                    {{ Form::radio('improvement.'.$improvement->id.'.status', 'have') }}
                </div>
                <div class="form-group">
                    {{ Form::label('improvement.'.$improvement->id.'.status', 'Something you need') }}
                    {{ Form::radio('improvement.'.$improvement->id.'.status', 'need') }}
                </div>
            </div>
        @endforeach
    @endforeach

    {{ Form::submit() }}

    {!! Form::close() !!}

</div>
@endif
@endsection
