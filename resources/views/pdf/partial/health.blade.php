@foreach ($fields as $field)
    @if (array_key_exists($field, $assessment))
        <div class="card">
            <strong>{{ $field }}:</strong> {{ $assessment[$field] }}
        </div>
    @endif
@endforeach
