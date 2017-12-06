@foreach ($improvements as $index => $imp)

    <div class="card card-responses improvement my-4 avoid-breaking-me">

        <div class="card-body p-0">

            <div class="row">
                <div class="col col-8">
                    <h2 class="improvement-header mb-0">
                        <strong>{{ $index + 1 }}.</strong> {!! $imp['title'] !!}
                    </h2>
                </div>
                <div class="col col-4">
                    @if ('need' == $imp['value'])
                        <div class="improvement-value improvement-need pr-2 ml-auto">
                            <i class="pl-2 fa fa-lg fa-check" aria-hidden="true"></i>
                            <strong>Something to Consider.</strong>
                        </div>
                    @elseif ('have' == $imp['value'])
                        <div class="improvement-value improvement-have pr-2 ml-auto">
                            <i class="pl-2 fa fa-lg fa-check" aria-hidden="true"></i>
                            <strong>Something you have.</strong>
                        </div>
                    @endif
                </div>
            </div>

            @parsedown($imp['description'])
        </div>

    </div>

@endforeach
