<div class="front-page break-after-me">
    <div class="top-section">
        <div class="container p-3">
            <img class="img-fluid img-logo" alt="{{ config('app.assessment_title') }}"
                src="{{ asset('img/plymouth-energy-community-logo.jpg') }}">
            <h1 class="front-page-title my-4">
                {{ config('app.assessment_title') }}
            </h1>
        </div>
    </div>
    <div class="middle-section">
        <img class="img-fluid" src="http://via.placeholder.com/1200x400">
    </div>
    <div class="bottom-section">
        <div class="container p-3">
            @parsedown($section['body'])
        </div>
    </div>
</div>
