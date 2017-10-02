@extends('master')

@section('content')

<div id="submission-app">
    <submission
        base-url='{{ URL::to('/') }}'
        :assessment='{{ $assessment }}'
        :parts='{{ $json_parts }}'
        :improvements='{{ $json_improvements }}'>
    </submission>
</div>

@endsection
