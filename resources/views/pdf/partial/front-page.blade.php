<div class="front-page break-after-me">
    <div class="top-section">
        <div class="container my-5">
            <img class="img-fluid w-25" alt="{{ config('app.assessment_title') }}"
                src="{{ asset('img/plymouth-energy-community-logo.jpg') }}">
            <h1 class="front-page-title my-5">
                {{ config('app.assessment_title') }}
            </h1>
        </div>
    </div>
    <div class="middle-section">
        <img class="img-fluid" src="http://via.placeholder.com/1200x200">
    </div>
    <div class="bottom-section">
        <div class="container my-5">
            @parsedown($section['body'])
        </div>
    </div>
</div>
