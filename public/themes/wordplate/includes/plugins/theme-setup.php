<?php
/*
 * This file is used to automatically create default nav menus.
 * 
 * 
 */

if(is_admin()){
    add_action('after_setup_theme', 'create_default_nav_locations'); // Install default nav locations
}

function create_default_nav_locations() {
    register_nav_menus([
        'main-navigation'   => __('Main Top Navigation', 'wordplate'),
        'mini-navigation'   => __('Mini Top Navigation', 'wordplate'),
        'shop-mobile-navigation' => __('Shop Mobile Navigation', 'wordplate'),
        'done-mobile-navigation' => __('Dine Mobile Navigation', 'wordplate'),
        'play-mobile-navigation' => __('Play Mobile Navigation', 'wordplate'),
        'stay-mobile-navigation' => __('Stay Mobile Navigation', 'wordplate'),
    ]);
}

// website menu data-only
function website_menu( $menuID ){

    $data = wp_get_nav_menu_items($menuID);
    $tempArray = [];
    $output = [];

    if(!is_array($data)){
        return '';
    }

    foreach($data as $key => $item){
        if($item->menu_item_parent == 0){
            $item->children = [];
            $tempArray[$item->ID] = $item;
        }else{
            $tempArray[$item->menu_item_parent]->children[] = $item;
        }
    }

    foreach($tempArray as $key => $item){
        $item->title = htmlspecialchars_decode($item->title);
        $item->classes = implode(' ', $item->classes);
        $output[$item->menu_order] = $item;
    }

    return json_encode($output);
}

function custom_admin_css() {
    echo '<style type="text/css">
    .wp-block { max-width: 1000px; }
    </style>';
    }
add_action('admin_head', 'custom_admin_css');