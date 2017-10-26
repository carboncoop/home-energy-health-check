@extends('master')

@section('pageTitle', 'Create a new assessment')

@section('content')

<div id="submission-create">
    <submission-create
        base-url='{{ URL::to('/') }}'>
    </submission-create>
</div>

@endsection
