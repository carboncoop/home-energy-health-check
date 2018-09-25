@foreach ($priorityWorkSchema as $legend => $group)
    <div class="avoid-breaking-me">
        <h3 class="mt-4">{{ $legend }}</h3>
        <div class="card card-responses p-2 my-2">
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
                                        {{ ($assessment[$field . '_yn']) ? 'Yes' : 'No' }}
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
        </div>
    </div>
@endforeach
