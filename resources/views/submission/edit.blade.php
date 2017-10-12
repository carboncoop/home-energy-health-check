@extends('master')

@section('content')

<div id="submission-edit">
    <submission-edit
        base-url='{{ URL::to('/') }}'
        :assessment='{{ $json_assessment }}'
        :parts='{{ $json_parts }}'
        :improvements='{{ $json_improvements }}'
        :assessment-improvements='{{ $json_assessment_improvements }}'>
    </submission-edit>
</div>

@endsection
