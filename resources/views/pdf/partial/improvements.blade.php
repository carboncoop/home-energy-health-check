@foreach ($improvements as $index => $imp)
    <div class="card card-responses my-2 avoid-breaking-me">

        <div class="card-body p-2">

            <div class="d-flex flex-row justify-content-between">
                <h3><strong>{{ $index + 1 }}.</strong> {{ $imp['title'] }}</h3>

                @if (array_key_exists('value', $imp))

                    @if ('need' == $imp['value'])
                        <div class="improvement-value improvement-need pr-2 ml-auto">
                            <i class="pl-2 fa fa-lg fa-exclamation-circle" aria-hidden="true"></i>
                            <strong>Something you need.</strong>
                        </div>
                    @elseif ('have' == $imp['value'])
                        <div class="improvement-value improvement-have pr-2 ml-auto">
                            <i class="pl-2 fa fa-lg fa-check-circle" aria-hidden="true"></i>
                            <strong>Something you have.</strong>
                        </div>
                    @endif

                @endif
            </div>

            {{ $imp['description'] }}
        </div>

    </div>
@endforeach
