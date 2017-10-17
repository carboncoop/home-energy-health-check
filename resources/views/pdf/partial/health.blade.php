@foreach ($healthSchema['readingElements'] as $field => $label)
    @if (array_key_exists($field, $assessment))
        <div class="card">
            <strong>{{ $label }}:</strong> {{ $assessment[$field] }}
        </div>
    @endif
@endforeach


@foreach ($healthSchema['textareaElements'] as $legend => $group)
    <h2>{{ $legend }}</h2>
    @foreach ($group as $field => $label)
        <div class="card">
            <strong>{{ $label }}:</strong> {{ $assessment[$field] }}
        </div>
    @endforeach
@endforeach
