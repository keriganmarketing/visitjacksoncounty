<?php

declare(strict_types=1);

require template_path('includes/ThemeControl.php');
require('post-types/venue.php');
require('post-types/event.php');

$wordplate = new ThemeControl();

// Set theme defaults.
add_action('after_setup_theme', function () {
    // Disable the admin toolbar.
    show_admin_bar(false);

    add_theme_support('post-thumbnails');
    add_theme_support( 'custom-logo', [
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => ['site-title', 'site-description'],
    ] );
    add_theme_support('title-tag');
    add_theme_support('html5', [
        'caption',
        'comment-form',
        'comment-list',
        'gallery',
        'search-form',
        'widgets',
    ]);
    add_theme_support( 'post-formats', [
        // 'aside',
        'gallery',
        'image',
        'status',
        'quote', 
        'video'
    ]);
});

// Enqueue and register scripts the right way.
add_action('wp_enqueue_scripts', function () {
    if(!is_admin()){
        wp_deregister_script('jquery');
    }
    wp_enqueue_style('wordplate', mix('styles/main.css'), [], null);
    wp_register_script('wordplate', mix('scripts/app.js'), '', '', true);
    wp_enqueue_script('wordplate', mix('scripts/app.js'), '', '', true);
});

// Custom Blade Cache Path
add_filter('bladerunner/cache/path', function () {
    return '../../uploads/.cache';
});

function getVideoImageFromEmbed($postContent){
    if($postContent == ''){
        return false;
    }
    preg_match('/src="(.*?)"/', $postContent, $video);

    print_r($video);
    $videoParts = explode('/',$video[2]);
    return 'https://img.youtube.com/vi/'.$videoParts[3].'/maxresdefault.jpg';
}

// Add og:video meta tag for episodes and videos
function yoast_add_og_video() {
    if ( get_post_format() == 'video' ) {
        $post = get_post();
        preg_match('/\[embed(.*)](.*)\[\/embed]/', $post->post_content, $video);
        $videoParts = explode('/',$video[2]);
        echo '<meta property="og:video" content="' .  $video[2] . '" />', "\n";
        echo '<meta property="og:video:secure_url" content="' .  str_replace('http://','https://' , $video[2]) . '" />', "\n";
        echo '<meta property="og:video:height" content="1080" />', "\n";
        echo '<meta property="og:video:width" content="1920" />', "\n";
        //echo '<meta property="og:image" content="https://img.youtube.com/vi/'.$videoParts[3].'/maxresdefault.jpg" />', "\n";
    }
}
add_action( 'wpseo_opengraph', 'yoast_add_og_video', 10, 1 );

add_filter('wpseo_opengraph_image', function () {
    if ( get_post_format() == 'video' ) {
        $post = get_post();
        return getVideoImageFromEmbed($post->post_content);
    }
});
