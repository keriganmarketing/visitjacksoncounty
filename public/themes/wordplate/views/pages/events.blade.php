@extends('layouts.main')
@section('content')

@if (have_posts())
    @while (have_posts())
        {{ the_post() }}
        @include('partials.mast')
        <main role="main" class="pb-5">
            
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-10">
                        <article class="support">
                            {{ the_content() }}
                        </article>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row justify-content-center">
                    @foreach(getEvents() as $event)
                    @include('partials.minievent')
                    @endforeach
                </div>
            </div>

        </main>
    @endwhile
@else
    @include('pages.404')
@endif

@endsection