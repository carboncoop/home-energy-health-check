

@foreach ($comfortSchema['rateOneToFour'] as $field => $label)
    <div class="card">
        <strong>{{ $label }}:</strong> {{ $assessment[$field] }}
    </div>
@endforeach

@foreach ($comfortSchema['threeWayToggles'] as $field => $obj)
    <div class="card">
        <strong>{{ $obj['label'] }}:</strong> {{ $assessment[$field] }}
    </div>
@endforeach

@foreach ($comfortSchema['otherInfo'] as $field => $label)
    <div class="card">
        <strong>{{ $label }}:</strong> {{ $assessment[$field] }}
    </div>
@endforeach
