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

            <h1 class="my-5">SECTION 1: Your Home</h1>
            <h1 class="my-5">SECTION 2: Your Health</h1>
            <h1 class="my-5">SECTION 3: Your Action Plan</h1>
            @foreach ($parts as $part)
                @unless ($part->improvements->isEmpty())
                    <h3 class="my-2">{{ $part->title }}</h3>
                    @include('pdf.partial.table', [
                        'improvements' => $part->improvements
                    ])
                @endunless
            @endforeach

            <h1 class="my-5">SECTION 4: Your Support</h1>


        </div>
    </div>
@endsection
