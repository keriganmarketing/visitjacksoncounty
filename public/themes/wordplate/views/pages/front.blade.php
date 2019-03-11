@extends('layouts.main')

@section('content')
@if (have_posts())
    @while (have_posts())
        {{ the_post() }}
                
        @if(get_theme_mod('header_feature') == 'slider')
            @include('partials.slider')
        @endif

        @if(get_theme_mod('header_feature') == 'main-image')
            @include('partials.headerimage')
        @endif

        @if(get_theme_mod('header_feature') == 'background-video')
            @include('partials.video')
        @endif
        
        @if($headshot != '')
        <div class="headshot d-flex justify-content-center" >
            <img src="{{ $headshot }}" class="rounded-circle shadow">
        </div>
        @endif

        @include('partials.featureboxes')

        <main role="main">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10 col-xl-9">
                        <article class="front pb-4 text-center">
                            <header class="pt-1">
                                <h1>{{ the_title() }}</h1>
                            </header>
                            
                            {{ the_content() }}

                        </article>
                    </div>
                </div>
            </div>
        </main>

    @endwhile
@else
    @include('pages.404')
@endif
@endsection