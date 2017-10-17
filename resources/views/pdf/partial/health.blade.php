@section('responses-readings')
    <div class="card card-responses p-2 my-2">
        @foreach (array_chunk($healthSchema['readingElements'], 2, true) as $pair)
            <div class="row">
                @foreach ($pair as $field => $label)
                    @if (array_key_exists($field, $assessment))
                        <div class="col col-6">
                            <div class="row">
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
    </div>
@endsection

@foreach ($healthSchema['textareaElements'] as $legend => $group)
    <h3>{{ $legend }}</h3>
    @if ('Temperature Readings' == $legend)
        @yield('responses-readings')
    @endif
    <div class="card card-responses p-2 my-2">
        @foreach ($group as $field => $label)
            @if (array_key_exists($field, $assessment))
                <div class="row">
                    <div class="col col-6">
                        <strong class="response-label">{{ $label }}:</strong>
                    </div>
                    <div class="col col-6">
                        {{ $assessment[$field] }}
                    </div>
                </div>
            @endif
        @endforeach
    </div>
@endforeach
