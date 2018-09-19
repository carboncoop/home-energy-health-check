<div class="front-page break-after-me">
    <div class="top-section">
        <div class="container p-3">
            <img class="img-fluid img-logo" alt="{{ config('app.assessment_title') }}"
                src="{{ asset('img/HHLogo_High_resolution.jpg') }}">
            <h1 class="front-page-title my-4">
                {{ config('app.assessment_title') }}
            </h1>
        </div>
    </div>
    <div class="middle-section">

    </div>
    <div class="bottom-section">
        <div class="container p-3">
            @parsedown($section['body'])
        </div>
    </div>
</div>
