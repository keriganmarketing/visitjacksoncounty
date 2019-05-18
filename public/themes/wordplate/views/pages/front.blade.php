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

        
        <div class="section events-section" v-lazy:background-image="{src: '/themes/wordplate/assets/images/tealtexture.png'}">
            <div id="anchor" class="gradient gradient-two mb-4"></div>
            <div class="container-fluid">
                <h2 class="heading text-white" >Events & Festivals</h2>
                <div class="row">
                    @include('partials.upcomingevents')
                </div>
            </div>
            <div class="section-button">
                <a href="/events/" class="btn btn-lg btn-outline-white" >All Upcoming Events</a>
            </div>
        </div>
        <div class="gradient gradient-three"></div>
        <main id="main" class="section home-content">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10 col-xl-9">
                        <article class="front text-center">
                            <h1>{{ the_title() }}</h1>
                            {{ the_content() }}
                        </article>
                    </div>
                </div>
            </div>
            <div class="section-button">
                <a href="#" class="btn btn-lg btn-outline-white" >Learn More</a>
            </div>
        </main>

        <div class="gradient gradient-four"></div>
        <div class="section featured-venue-section text-center" >
            <div class="section-content" >
                <p class="featured-headline" >Explore</p>
                <p class="featured-venue-name" >Florida Caverns State Park</p>
                <div class="section-button" >
                    <a href="#" class="btn btn-lg btn-outline-white" >Learn More</a>
                </div>
            </div>
            <div class="section-background" v-parallax=".2" v-lazy:background-image="{src: '/themes/wordplate/assets/images/marianna-caverns.jpg'}" ></div>
        </div>

        <div class="gradient gradient-five"></div>
        <div class="section visitors-guide-section">
            <div class="row align-items-center justify-content-center">
                <div class="col-8 col-sm-auto text-center text-md-left px-5" >
                    <img v-lazy="'/themes/wordplate/assets/images/visitors-guide.jpg'" class="img-fluid" >
                </div>
                <div class="col-12 col-sm-auto text-center text-md-left" >
                    <p class="heading">Official Visitor's Guide</p>
                    <div class="buttons px-2 row justify-content-center justify-content-sm-start" >
                        <a class="col-auto btn btn-lg btn-outline-white mx-2" href="#" ><i class="fa fa-download" ></i> Download PDF</a> <a class="col-auto btn btn-lg btn-outline-white mx-2" href="#" ><i class="fa fa-envelope-o" ></i> Request printed copy</a>
                    </div>
                </div>
            </div>
        </div>

        @include('partials.featureboxes')

        <div class="section getting-here-section" v-lazy:background-image="{src: '/themes/wordplate/assets/images/lbtexture.png'}">
            <div class="container">
                <div class="row justify-content-center align-items-center" >
                    <div class="col-12 col-md-5 text-center section-content" >
                        <p class="heading">Getting Here</p>
                        <a href="https://www.google.com/maps/dir//4318+Lafayette+St,+Marianna,+FL+32446/@30.7775657,-85.2382278,17z/data=!4m8!4m7!1m0!1m5!1m1!1s0x8893205bd7d492a7:0xa75aba43b6f111c7!2m2!1d-85.2360391!2d30.7775657" class="btn btn-lg btn-outline-white my-2" >Directions</a>
                        <p class="client-name">{{ get_bloginfo() }}</p>
                        <p>{!! nl2br(get_field('address', 'option')) !!}</p>
                    </div>
                    <div class="col-10 col-md-7 florida" v-lazy:background-image="{src: '/themes/wordplate/assets/images/florida.png'}">
                        <img class="map-arrow" src="/themes/wordplate/assets/images/arrow.png" >
                        <div class="embed-responsive embed-responsive-1by1"></div>
                    </div>
                </div>
            </div>
        </div>

    @endwhile
@else
    @include('pages.404')
@endif
@endsection