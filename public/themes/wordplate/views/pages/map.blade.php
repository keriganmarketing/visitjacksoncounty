@extends('layouts.main')
@section('content')

@if (have_posts())
    @while (have_posts())
        {{ the_post() }}
        @include('partials.mast')
        <main role="main">
            <div class="map-container h-100">
                <location-map :zoom="11" :latitude="30.766116" :longitude="-85.237469" api="{{ $googleapi }}"></map>
                {{-- <location-map :zoom="11" :latitude="30.766116" :longitude="-85.237469" ></map> --}}
            </div>
        </main>
    @endwhile
@else
    @include('pages.404')
@endif

@endsection