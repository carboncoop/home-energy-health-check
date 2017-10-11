@extends('master')

@section('content')

<div id="submission-edit">
    <submission-edit
        base-url='{{ URL::to('/') }}'
        :assessment='{{ $assessment }}'
        :parts='{{ $json_parts }}'
        :improvements='{{ $json_improvements }}'>
    </submission-edit>
</div>

@endsection
