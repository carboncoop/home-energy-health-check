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
            @foreach ($sections as $section)
                @unless ($section->improvements->isEmpty())
                    <h3 class="my-2">{{ $section->title }}</h3>
                    @include('pdf.part.table', [
                        'improvements' => $section->improvements
                    ])
                @endunless
            @endforeach
        </div>
    </div>
@endsection
