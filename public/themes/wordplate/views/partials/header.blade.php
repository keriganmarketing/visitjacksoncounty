<header class="top">
    <div class="mobile-mini-nav d-sm-none bg-primary text-white text-center" >
        <a href="/visitors-guide/">visitor’s guide</a>   |  <a href="/contact/" >Contact</a>  |  <a @click="openSearch()" >Search <i class="fa fa-search"></i></a>
    </div>
    <div role="navigation" class="topnav navbar navbar-expand-xl" >
        <div class="container d-flex justify-content-center justify-content-md-between">
            <div class="text-center" >
                @if(get_theme_mod( 'custom_logo' ))
                    <a class="logo d-flex mx-auto" href="/">
                        <img 
                            src="{{ esc_url( 
                                wp_get_attachment_image_url(
                                    get_theme_mod( 'custom_logo' ), 
                                    'full' 
                                ) ) }}" 
                            alt=""
                            class="img-fluid"
                        >
                    </a>
                @else
                    <a class="logo d-flex mx-auto align-items-center display-4" href="/">
                        {{ get_bloginfo() }}
                    </a>
                @endif
            </div>
            
            <div class="flex-grow-1 d-none d-sm-block ">
                <div class="mini-navigation d-flex w-100" >
                    <main-menu v-bind:main-nav="{{ website_menu('mini-navigation') }}" class="navbar-nav mx-auto mr-md-0"></main-menu>
                </div>
                <div class="main-navigation d-flex w-100">
                    <main-menu v-bind:main-nav="{{ website_menu('main-navigation') }}" class="navbar-nav mx-auto mr-md-0"></main-menu>
                </div>
            </div>
        </div>
    </div>
    <div class="mobile-main-nav d-flex w-100 d-sm-none bg-primary text-white text-center" >
        <a href="#" class="nav-item col py-2 text-white" >Shop</a>
        <a href="#" class="nav-item col py-2 text-white" >Dine</a>
        <a href="#" class="nav-item col py-2 text-white" >Play</a>
        <a href="#" class="nav-item col py-2 text-white" >Stay</a>
    </div>
    <div class="gradient gradient-one"></div>
</header>
<div v-if="playMenuOpen" class="mobile-menu align-items-center bg-primary" >
</div>