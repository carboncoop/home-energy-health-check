@extends('master')


@section('content')
    <style type="text/css">
    .break-after-me {
        overflow: hidden;
        page-break-after: always;
    }
    </style>

    <div class="generated-pdf-wrapper">
        <div class="container py-5">

            @foreach ($sections as $index => $section)
                <div class="section break-after-me">
                    <h1 class="my-5">{{ $section->title }}</h1>
                    <div class="lead">
                        @parsedown($section->body)
                    </div>
                    @if (3 == $index)
                        @foreach ($parts as $part)
                            @unless ($part->improvements->isEmpty())
                                <h3 class="my-2">{{ $part->title }}</h3>
                                @include('pdf.partial.table', [
                                    'improvements' => $part->improvements
                                ])
                            @endunless
                        @endforeach
                    @endif
                </div>
            @endforeach

        </div>
    </div>
@endsection
