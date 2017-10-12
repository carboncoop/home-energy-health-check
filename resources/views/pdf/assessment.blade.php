@extends('master')


@section('content')
    <style type="text/css">
    .break-after-me {
        overflow: hidden;
        page-break-after: always;
    }
    .break-after-me:last-child {
        page-break-after: avoid;
    }
    </style>

    <div class="generated-pdf-wrapper">
        <div class="container py-5">

            @foreach ($sections as $index => $section)
                <div class="section break-after-me">

                    <h1 class="my-5">{{ $section['title'] }}</h1>

                    @if (0 == $index)
                        <h1 class="display-1">TODO: Branding etc.</h1>
                    @endif

                    @if (3 == $index)
                        <h1 class="display-1">TODO: tidy up data</h1>
                        @foreach ($parts as $part)
                            @unless (empty($part['improvements']))
                                <h3 class="my-2">{{ $part['title'] }}</h3>
                                @include('pdf.partial.table', [
                                    'improvements' => $part['improvements']
                                ])
                            @endunless
                        @endforeach
                    @else
                        <div class="my-3">
                            @parsedown($section['body'])
                        </div>
                    @endif

                    @if (1 == $index)
                        <h1 class="display-1">TODO: Your Home data</h1>
                    @endif

                    @if (2 == $index)
                        @include('pdf.partial.health', [
                            'assessment' => $assessment,
                            'fields' => $healthFields
                        ])
                    @endif

                    @if (4 == $index)
                        <h1 class="display-1">TODO: Your Support data??</h1>
                    @endif

                </div>
            @endforeach

        </div>
    </div>
@endsection
