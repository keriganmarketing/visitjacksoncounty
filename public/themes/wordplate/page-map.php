<?php
bladerunner('views.pages.map',[
    'headerImage' => (get_field('header_image') ? (get_field('header_image'))['url'] : wp_get_attachment_url(get_theme_mod('home_header_image'))),
    'headerOverlay' => get_field('overlay_color'),
    'headline'    => get_field('headline'),
    'googleapi'   => env('GOOGLE_MAPS_API','')
]);