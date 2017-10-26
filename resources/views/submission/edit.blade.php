@extends('master')

@section('pageTitle', 'Edit and submit an assessment')

@section('content')

<div id="submission-edit">
    <submission-edit
        base-url='{{ URL::to('/') }}'
        :form-schema='{{ $json_form_schema }}'
        :assessment='{{ $json_assessment }}'
        :parts='{{ $json_parts }}'
        :improvements='{{ $json_improvements }}'
        :assessment-improvements='{{ $json_assessment_improvements }}'>
    </submission-edit>
</div>

@endsection
