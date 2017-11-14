@extends('pdf.master')

@section('pageTitle')
    {{ config('app.assessment_title') }}
@endsection

@section('content')
    <div class="generated-pdf-wrapper">

            @foreach ($sections as $index => $section)

                @if (0 == $index)
                    @include('pdf.partial.front-page', [

                    ])
                @else
                    <div class="container pb-5 section break-after-me">

                        @if ($index > 0)
                        <h1 class="section-header my-3">
                            {{ $section['title'] }}
                        </h1>
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

                    </div>
                @endif

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
@endsection
