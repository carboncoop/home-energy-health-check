@extends('master')

@section('content')
    <div class="container">
        <div class="my-4 p-4 card">
            <h1>Hello, world!</h1>

            <p>Right now, there's two things you can do here:</p>

            <ol class="list-group">
                <li class="list-group-item">
                    <a href="{{ url('admin') }}">Log in to the administration area.</a>
                </li>
                <li class="list-group-item">
                    <a href="{{ url('submit/1/edit') }}">See an example of the assessment form.</a>
                </li>
            </ol>

        </div>
    </div>
@endsection
