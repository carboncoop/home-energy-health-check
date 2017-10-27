@extends('master')

@section('content')
    <div class="generated-pdf-wrapper">
        <div class="container py-5">

            @foreach ($sections as $index => $section)
                <div class="section break-after-me">

                    <h1 class="section-header my-3">
                        {{ $section['title'] }}
                    </h1>

                    @if (0 == $index)
                        <h1 class="display-1">TODO: Branding etc.</h1>
                    @endif

                    @if (3 == $index)
                        @foreach ($parts as $i => $part)
                            @unless (empty($part['improvements']))
                                @if (0 == $i)
                                    <h2 class="part-header no-top my-3">{{ $part['title'] }}</h2>
                                @else
                                    <h2 class="part-header my-3">{{ $part['title'] }}</h2>
                                @endif

                                <div class="lead">
                                    @parsedown($part['description'])
                                </div>

                                <div class="part break-after-me">
                                    @include('pdf.partial.improvements', [
                                        'improvements' => $part['improvements']
                                    ])
                                    @include('pdf.partial.table', [
                                        'improvements' => $part['improvements']
                                    ])
                                </div>
                            @endunless
                        @endforeach
                    @else
                        <div class="my-3">
                            @parsedown($section['body'])
                        </div>
                    @endif

                    @if (1 == $index)
                        @include('pdf.partial.comfort', [
                            'assessment' => $assessment,
                            'comfortSchema' => $formSchema['comfort'],
                        ])
                    @endif

                    @if (2 == $index)
                        @include('pdf.partial.health', [
                            'assessment' => $assessment,
                            'healthSchema' => $formSchema['health'],
                        ])
                    @endif

                    @if (4 == $index)
                        <h1 class="display-1">TODO: Your Support data??</h1>
                    @endif

                </div>

                @if (3 == $index)
                    <div class="section break-after-me">
                        <h1 class="section-header my-3">
                            Assessor Comments
                        </h1>
                        @parsedown($assessment['misc_comments'])
                    </div>
                @endif

            @endforeach

        </div>
    </div>
@endsection
