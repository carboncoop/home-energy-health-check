@foreach ($priorityWorkSchema as $legend => $group)
    <div class="avoid-breaking-me">
        <h3 class="mt-4">{{ $legend }}</h3>
        <div class="card card-responses p-2 my-2">
            @include ('pdf.partial.inc.yesNoRow', $group)
        </div>
    </div>
@endforeach
