@extends('master')

@section('content')

<div id="submission-create">
    <submission-create
        base-url='{{ URL::to('/') }}'>
    </submission-create>
</div>

@endsection
