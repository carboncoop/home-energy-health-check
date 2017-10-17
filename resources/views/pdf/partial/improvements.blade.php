@foreach ($improvements as $imp)
    <div class="card card-responses my-2 avoid-breaking-me">

        <div class="card-body p-2">
            <h3>{{ $imp['title'] }}</h3>
            {{ $imp['description'] }}

            @if (array_key_exists('value', $imp))
                <div class="">
                    {{ strtoupper($imp['value']) }}
                </div>
            @endif
        </div>

    </div>
@endforeach
