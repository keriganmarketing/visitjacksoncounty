<div class="header-image support" {{ ($headerImage != '' ? 'style="background-image: url('.$headerImage.' )"' : null) }} >
    <div class="container">
        <div class="text-center support">
            <h1 class="text-white display-3">{{ $headline != '' ? $headline : the_title() }}</h1>
        </div>
    </div>
    @if($headerOverlay != '')
        <div class="overlay" style="background-color: {{ $headerOverlay }};"></div>
    @endif
</div>