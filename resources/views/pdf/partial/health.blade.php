@section('responses-readings')
    @foreach (array_chunk($healthSchema['readingElements'], 2, true) as $pair)
        <div class="row response-row">
            @foreach ($pair as $field => $label)
                @if (array_key_exists($field, $assessment))
                    <div class="col col-6">
                        <div class="row padded-row">
                            <div class="col col-6">
                                <strong class="response-label">{{ $label }}:</strong>
                            </div>
                            <div class="col col-6">
                                {{ $assessment[$field] }}
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    @endforeach
@endsection

@foreach ($healthSchema['textareaElements'] as $legend => $group)
    <div class="avoid-breaking-me">
        <h3 class="mt-4">{{ $legend }}</h3>
        <div class="card card-responses p-2 my-2">
            @if ('Temperature & Air Quality Readings' == $legend)
                @yield('responses-readings')
            @endif
            @foreach (array_chunk($group, 2, true) as $pair)
                @if (array_key_exists($field, $assessment))
                    <div class="row response-row">
                        @foreach ($pair as $field => $label)
                            <div class="col col-6">
                                <div class="row padded-row">
                                    <div class="col col-6">
                                        <strong class="response-label">{{ $label }}:</strong>
                                    </div>
                                    <div class="col col-6">
                                        {{ $assessment[$field] }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            @endforeach
        </div>
    </div>
@endforeach

@foreach ($healthSchema['yesNoElements'] as $legend => $group)
    <h3 class="mt-4">{{ $legend }}</h3>
    <div class="card card-responses p-2 my-2">
        @include('pdf.partial.inc.yesNoRow', $group)
    </div>
@endforeach
