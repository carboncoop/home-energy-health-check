@extends('master')

@section('content')
    <div class="container">
        <div class="my-4 p-4 card">
            <h1>PECHAT - Alpha Test Version</h1>

            <p>Right now, there's two things you can do here:</p>

            <ol class="list-group">
                <li class="list-group-item">
                    <a href="{{ url('admin') }}">Log in to the administration area.</a>
                </li>
                <li class="list-group-item">
                    <a href="{{ url('submit/create') }}">Create a new assessment.</a>
                </li>
                <li class="list-group-item">
                    <p>Edit and submit existing assessments:</p>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Assessment Date</th>
                                <th>Homeowner</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($assessments as $assessment)
                            <tr>
                                <td>{{ $assessment->assessment_date }}</td>
                                <td>{{ $assessment->homeowner_name }}</td>
                                <td><a href="{{ action('SubmissionController@edit', [
                                    'id' => $assessment->id
                                ]) }}">Edit</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </li>

            </ol>

        </div>
    </div>
@endsection
