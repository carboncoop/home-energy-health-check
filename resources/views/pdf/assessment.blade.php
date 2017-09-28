@extends('master')

@section('content')
    <style type="text/css">
    .break-after-me {
        overflow: hidden;
        page-break-after: always;
    }
    </style>

    <div class="generated-pdf-wrapper">
        <div class="container">

            <table class="my-4 table">
                <thead>
                    <tr>
                        <th>&nbsp;</th>
                        <th>Assessor's Comment</th>
                        <th>Estimated Cost</th>
                        <th>Benefits / Savings</th>
                        <th>Who can do this work></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($improvements as $imp)
                        <tr>
                            <td>{{ $imp->title }}</td>
                            <td>{{ $imp->assessor_comment }}</td>
                            <td>{{ $imp->estimated_cost }}</td>
                            <td>{{ $imp->benefits }}</td>
                            <td>{{ $imp->who_can_do }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
@endsection
