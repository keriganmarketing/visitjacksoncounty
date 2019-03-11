<header class="top">
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
                        <svg version="1.1" width="25" height="25" xmlns="http://www.w3.org/2000/svg"    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                            viewBox="0 0 54 54" style="enable-background:new 0 0 54 54;" fill="currentColor" class="d-block mr-2" xml:space="preserve">
                            <circle cx="7" cy="47" r="7"/>
                            <circle cx="27" cy="47" r="7"/>
                            <circle cx="47" cy="47" r="7"/>
                            <circle cx="7" cy="27" r="7"/>
                            <circle cx="27" cy="27" r="7"/>
                            <circle cx="47" cy="27" r="7"/>
                            <circle cx="7" cy="7" r="7"/>
                            <circle cx="27" cy="7" r="7"/>
                            <circle cx="47" cy="7" r="7"/>
                        </svg>
                        WP<strong>GEN</strong>
                        {{-- {{ get_bloginfo() }} --}}
                    </a>
                @endif
            </div>
            
            <div class="flex-grow-1">
                <div class="contact-nav py-2">
                    <a class="mail top-button" href="mailto:{{ get_field('email', 'option') }}"><i class="fa fa-envelope d-inline-block mx-2" aria-hidden="true"></i><span class="d-none d-md-inline-block">{{ get_field('email', 'option') }}</span></a>
                    <a class="call top-button" href="tel:{{ get_field('phone', 'option') }}"><i class="fa fa-phone d-inline-block mx-2" aria-hidden="true"></i><span class="d-none d-md-inline-block">{{ get_field('phone', 'option') }}</span></a>
                    <button v-on:click="toggleMenu" class="d-xl-none btn btn-secondary btn-sm" type="button" data-toggle="collapse" data-target="#mobilemenu" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                        MENU <i
                                class="fa" 
                                v-bind:class="{
                                    'fa-bars': !mobileMenuOpen,
                                    'fa-times': mobileMenuOpen
                                }"
                                aria-hidden="true"
                            ></i>
                    </button>
                </div>
                
                <div class="main-navigation collapse navbar-collapse">
                    <main-menu v-bind:main-nav="{{ website_menu('main-navigation') }}" class="navbar-nav ml-auto"></main-menu>
                </div>
            </div>
        </div>
    </div>
</header>
<div v-if="mobileMenuOpen" class="mobile-menu align-items-center" ref="mobileMenuContainer" v-bind:class="{ 'open': this.mobileMenuOpen }" >
    <mobile-menu v-bind:mobile-nav="{{ website_menu('mobile-navigation') }}" class="navbar-nav m-auto" ></mobile-menu>
</div>