@extends('master')

@section('content')

<div id="submission-app">
    <submission
        base-url='{{ URL::to('/') }}'
        :assessment='{{ $assessment }}'
        :sections='{{ $json_sections }}'
        :improvements='{{ $json_improvements }}'>
    </submission>
</div>

@endsection
