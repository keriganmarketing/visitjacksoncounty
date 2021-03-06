<div 
    class="main-header-image shadow"
    >
    <kma-slider class="slider-container" ></kma-slider>
    <div class="slider-content" v-parallax=".7" >
        <div class="container">
            <div 
                class="overlay-content"
            >
            {!! apply_filters('the_content', (get_post(get_theme_mod('overlay_content')))->post_content) !!}
            </div>
        </div>
    </div>
    @if(get_theme_mod('use_overlay_text'))
        <div 
            class="overlay"
            style="
                background-color: {{ get_theme_mod('overlay_color') }};
                opacity: {{ get_theme_mod('overlay_opacity') }};
            "
        ></div>
    @endif
</div>
<div class="down text-center" >
    <a class="down-arrow" v-scroll-to="'#anchor'" ><i class="fa fa-chevron-down" aria-hidden="true"></i></a>
</div>