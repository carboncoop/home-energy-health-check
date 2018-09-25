@foreach (array_chunk($group, 2, true) as $pair)
    <div class="row response-row">
        @foreach ($pair as $field => $label)
            <div class="col col-6">
                <div class="row padded-row">
                    <div class="col col-6">
                        <strong class="response-label">{{ $label }}:</strong>
                    </div>
                    <div class="col col-6">
                        @if (array_key_exists($field . '_yn', $assessment))
                            @if ($assessment[$field . '_yn'] == 1)
                                <strong class="yes">Yes</strong>
                            @elseif ($assessment[$field . '_yn'] == 0)
                                <strong class="no">No</strong>
                            @endif
                        @endif
                        @if (array_key_exists($field . '_comment', $assessment))
                            <br>{{ $assessment[$field . '_comment'] }}
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endforeach
