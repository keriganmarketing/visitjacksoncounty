<?php

/**
 * Registers the `business_listing` post type.
 */
function business_listing_init() {
	register_post_type( 'venue', array(
		'labels'                => array(
			'name'                  => __( 'Venues', 'wordplate' ),
			'singular_name'         => __( 'Venue', 'wordplate' ),
			'all_items'             => __( 'All Venues', 'wordplate' ),
			'archives'              => __( 'Venue Archives', 'wordplate' ),
			'attributes'            => __( 'Venue Attributes', 'wordplate' ),
			'insert_into_item'      => __( 'Insert into Venue', 'wordplate' ),
			'uploaded_to_this_item' => __( 'Uploaded to this Venue', 'wordplate' ),
			'featured_image'        => _x( 'Featured Image', 'venue', 'wordplate' ),
			'set_featured_image'    => _x( 'Set featured image', 'venue', 'wordplate' ),
			'remove_featured_image' => _x( 'Remove featured image', 'venue', 'wordplate' ),
			'use_featured_image'    => _x( 'Use as featured image', 'venue', 'wordplate' ),
			'filter_items_list'     => __( 'Filter Venues list', 'wordplate' ),
			'items_list_navigation' => __( 'Venues list navigation', 'wordplate' ),
			'items_list'            => __( 'Venues list', 'wordplate' ),
			'new_item'              => __( 'New Venue', 'wordplate' ),
			'add_new'               => __( 'Add New', 'wordplate' ),
			'add_new_item'          => __( 'Add New Venue', 'wordplate' ),
			'edit_item'             => __( 'Edit Venue', 'wordplate' ),
			'view_item'             => __( 'View Venue', 'wordplate' ),
			'view_items'            => __( 'View Venues', 'wordplate' ),
			'search_items'          => __( 'Search Venues', 'wordplate' ),
			'not_found'             => __( 'No Venues found', 'wordplate' ),
			'not_found_in_trash'    => __( 'No Venues found in trash', 'wordplate' ),
			'parent_item_colon'     => __( 'Parent Venue:', 'wordplate' ),
			'menu_name'             => __( 'Venues', 'wordplate' ),
		),
		'public'                => true,
		'hierarchical'          => false,
		'show_ui'               => true,
		'show_in_nav_menus'     => true,
		'supports'              => array( 'title', 'editor' ),
		'has_archive'           => true,
		'rewrite'               => true,
		'query_var'             => true,
		'menu_icon'             => 'dashicons-admin-post',
		'show_in_rest'          => true,
		'rest_base'             => 'venue',
		'rest_controller_class' => 'WP_REST_Posts_Controller',
	) );

}
add_action( 'init', 'business_listing_init' );

/**
 * Sets the post updated messages for the `business_listing` post type.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `business_listing` post type.
 */
function business_listing_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['venue'] = array(
		0  => '', // Unused. Messages start at index 1.
		/* translators: %s: post permalink */
		1  => sprintf( __( 'Venue updated. <a target="_blank" href="%s">View Venue</a>', 'wordplate' ), esc_url( $permalink ) ),
		2  => __( 'Custom field updated.', 'wordplate' ),
		3  => __( 'Custom field deleted.', 'wordplate' ),
		4  => __( 'Venue updated.', 'wordplate' ),
		/* translators: %s: date and time of the revision */
		5  => isset( $_GET['revision'] ) ? sprintf( __( 'Venue restored to revision from %s', 'wordplate' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		/* translators: %s: post permalink */
		6  => sprintf( __( 'Venue published. <a href="%s">View Venue</a>', 'wordplate' ), esc_url( $permalink ) ),
		7  => __( 'Venue saved.', 'wordplate' ),
		/* translators: %s: post permalink */
		8  => sprintf( __( 'Venue submitted. <a target="_blank" href="%s">Preview Venue</a>', 'wordplate' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		/* translators: 1: Publish box date format, see https://secure.php.net/date 2: Post permalink */
		9  => sprintf( __( 'Venue scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Venue</a>', 'wordplate' ),
		date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
		/* translators: %s: post permalink */
		10 => sprintf( __( 'Venue draft updated. <a target="_blank" href="%s">Preview Venue</a>', 'wordplate' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	);

	return $messages;
}
add_filter( 'post_updated_messages', 'business_listing_updated_messages' );

/**
 * Registers the `category` taxonomy,
 * for use with 'venue'.
 */
function category_init() {
	register_taxonomy( 'category', array( 'venue' ), array(
		'hierarchical'      => true,
		'public'            => true,
		'show_in_nav_menus' => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => true,
		'capabilities'      => array(
			'manage_terms'  => 'edit_posts',
			'edit_terms'    => 'edit_posts',
			'delete_terms'  => 'edit_posts',
			'assign_terms'  => 'edit_posts',
		),
		'labels'            => array(
			'name'                       => __( 'Categories', 'wordplate' ),
			'singular_name'              => _x( 'Category', 'taxonomy general name', 'wordplate' ),
			'search_items'               => __( 'Search Categories', 'wordplate' ),
			'popular_items'              => __( 'Popular Categories', 'wordplate' ),
			'all_items'                  => __( 'All Categories', 'wordplate' ),
			'parent_item'                => __( 'Parent Category', 'wordplate' ),
			'parent_item_colon'          => __( 'Parent Category:', 'wordplate' ),
			'edit_item'                  => __( 'Edit Category', 'wordplate' ),
			'update_item'                => __( 'Update Category', 'wordplate' ),
			'view_item'                  => __( 'View Category', 'wordplate' ),
			'add_new_item'               => __( 'New Category', 'wordplate' ),
			'new_item_name'              => __( 'New Category', 'wordplate' ),
			'separate_items_with_commas' => __( 'Separate categories with commas', 'wordplate' ),
			'add_or_remove_items'        => __( 'Add or remove categories', 'wordplate' ),
			'choose_from_most_used'      => __( 'Choose from the most used categories', 'wordplate' ),
			'not_found'                  => __( 'No categories found.', 'wordplate' ),
			'no_terms'                   => __( 'No categories', 'wordplate' ),
			'menu_name'                  => __( 'Categories', 'wordplate' ),
			'items_list_navigation'      => __( 'Categories list navigation', 'wordplate' ),
			'items_list'                 => __( 'Categories list', 'wordplate' ),
			'most_used'                  => _x( 'Most Used', 'category', 'wordplate' ),
			'back_to_items'              => __( '&larr; Back to Categories', 'wordplate' ),
		),
		'show_in_rest'      => true,
		'rest_base'         => 'category',
		'rest_controller_class' => 'WP_REST_Terms_Controller',
	) );

}
add_action( 'init', 'category_init' );

/**
* Sets the post updated messages for the `category` taxonomy.
*
* @param  array $messages Post updated messages.
* @return array Messages for the `category` taxonomy.
*/
function category_updated_messages( $messages ) {

	$messages['category'] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => __( 'Category added.', 'wordplate' ),
		2 => __( 'Category deleted.', 'wordplate' ),
		3 => __( 'Category updated.', 'wordplate' ),
		4 => __( 'Category not added.', 'wordplate' ),
		5 => __( 'Category not updated.', 'wordplate' ),
		6 => __( 'Categories deleted.', 'wordplate' ),
	);

	return $messages;
}
add_filter( 'term_updated_messages', 'category_updated_messages' );


/**
 * Registers the `category` taxonomy,
 * for use with 'venue'.
 */
function location_init() {
	register_taxonomy( 'location', array( 'venue' ), array(
		'hierarchical'      => true,
		'public'            => true,
		'show_in_nav_menus' => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => true,
		'capabilities'      => array(
			'manage_terms'  => 'edit_posts',
			'edit_terms'    => 'edit_posts',
			'delete_terms'  => 'edit_posts',
			'assign_terms'  => 'edit_posts',
		),
		'labels'            => array(
			'name'                       => __( 'Locations', 'wordplate' ),
			'singular_name'              => _x( 'Location', 'taxonomy general name', 'wordplate' ),
			'search_items'               => __( 'Search Locations', 'wordplate' ),
			'popular_items'              => __( 'Popular Locations', 'wordplate' ),
			'all_items'                  => __( 'All Locations', 'wordplate' ),
			'parent_item'                => __( 'Parent Location', 'wordplate' ),
			'parent_item_colon'          => __( 'Parent Location:', 'wordplate' ),
			'edit_item'                  => __( 'Edit Location', 'wordplate' ),
			'update_item'                => __( 'Update Location', 'wordplate' ),
			'view_item'                  => __( 'View Location', 'wordplate' ),
			'add_new_item'               => __( 'New Location', 'wordplate' ),
			'new_item_name'              => __( 'New Location', 'wordplate' ),
			'separate_items_with_commas' => __( 'Separate locations with commas', 'wordplate' ),
			'add_or_remove_items'        => __( 'Add or remove locations', 'wordplate' ),
			'choose_from_most_used'      => __( 'Choose from the most used locations', 'wordplate' ),
			'not_found'                  => __( 'No locations found.', 'wordplate' ),
			'no_terms'                   => __( 'No locations', 'wordplate' ),
			'menu_name'                  => __( 'Locations', 'wordplate' ),
			'items_list_navigation'      => __( 'Locations list navigation', 'wordplate' ),
			'items_list'                 => __( 'Locations list', 'wordplate' ),
			'most_used'                  => _x( 'Most Used', 'location', 'wordplate' ),
			'back_to_items'              => __( '&larr; Back to Locations', 'wordplate' ),
		),
		'show_in_rest'      => true,
		'rest_base'         => 'location',
		'rest_controller_class' => 'WP_REST_Terms_Controller',
	) );

}
add_action( 'init', 'location_init' );

/**
* Sets the post updated messages for the `category` taxonomy.
*
* @param  array $messages Post updated messages.
* @return array Messages for the `category` taxonomy.
*/
function location_updated_messages( $messages ) {

	$messages['location'] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => __( 'Location added.', 'wordplate' ),
		2 => __( 'Location deleted.', 'wordplate' ),
		3 => __( 'Location updated.', 'wordplate' ),
		4 => __( 'Location not added.', 'wordplate' ),
		5 => __( 'Location not updated.', 'wordplate' ),
		6 => __( 'Locations deleted.', 'wordplate' ),
	);

	return $messages;
}
add_filter( 'term_updated_messages', 'location_updated_messages' );

if( function_exists('acf_add_local_field_group') ):

	acf_add_local_field_group(array(
		'key' => 'group_5bb3d48fd4fe4',
		'title' => 'Contact Info',
		'fields' => array(
			array(
				'key' => 'field_5bb3d49a7ebb3',
				'label' => 'Address',
				'name' => 'address',
				'type' => 'textarea',
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '66',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => '',
				'new_lines' => '',
			),
			array(
				'key' => 'field_5bb3e3107f673',
				'label' => 'Main Photo',
				'name' => 'photo',
				'type' => 'image_crop',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '33',
					'class' => '',
					'id' => '',
				),
				'crop_type' => 'hard',
				'target_size' => 'custom',
				'width' => 400,
				'height' => 300,
				'preview_size' => 'medium',
				'force_crop' => 'yes',
				'save_in_media_library' => 'yes',
				'retina_mode' => 'no',
				'save_format' => 'object',
				'library' => 'all',
			),
			
			array(
				'key' => 'spacer',
				'label' => '',
				'name' => '',
				'type' => 'spacer',
				'wrapper' => array(
					'width' => '100',
					'class' => '',
					'id' => '',
				),
			),
			array(
				'key' => 'field_5bb3d50f08640',
				'label' => 'Phone Number',
				'name' => 'phone_number',
				'type' => 'text',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '33',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
			array(
				'key' => 'field_5bb3d53c9c0a1',
				'label' => 'Toll Free Phone Number',
				'name' => 'toll_free_phone_number',
				'type' => 'text',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '33',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
			array(
				'key' => 'field_5bb3d54a9093d',
				'label' => 'Fax Number',
				'name' => 'fax_number',
				'type' => 'text',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '33',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
			array(
				'key' => 'field_5bb3d553694f8',
				'label' => 'Email Address',
				'name' => 'email_address',
				'type' => 'email',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '25',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
			),
			array(
				'key' => 'field_5bb3d565fd977',
				'label' => 'Website',
				'name' => 'website',
				'type' => 'url',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '25',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
			),
			array(
				'key' => 'field_sdvsdvsvawreb',
				'label' => 'Latitude, Longitude',
				'name' => 'gps_coords',
				'type' => 'text',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '25',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
			array(
				'key' => 'field_5cdf548e260d0',
				'label' => 'Display on Adventure Map?',
				'name' => 'display_on_adventure_map',
				'type' => 'true_false',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '25',
					'class' => '',
					'id' => '',
				),
				'message' => '',
				'default_value' => 0,
				'ui' => 1,
				'ui_on_text' => 'Yes',
				'ui_off_text' => 'No',
			),
			array(
				'key' => 'spacer2',
				'label' => '',
				'name' => '',
				'type' => 'spacer',
				'wrapper' => array(
					'width' => '100',
					'class' => '',
					'id' => '',
				),
			),
			array(
				'key' => 'field_5cd46cf2b5039',
				'label' => 'Venue Photos',
				'name' => 'venue_photos',
				'type' => 'gallery',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'min' => '',
				'max' => '',
				'insert' => 'append',
				'library' => 'all',
				'min_width' => '',
				'min_height' => '',
				'min_size' => '',
				'max_width' => '',
				'max_height' => '',
				'max_size' => '',
				'mime_types' => '',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'venue',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => 1,
		'description' => '',
	));
	
endif;

function getBusinessListings($taxonomy = ''){

	$args = [
		'posts_per_page'   => -1,
		'orderby'          => 'menu_order',
		'order'            => 'ASC',
		'post_type'        => 'venue',
		'post_status'      => 'publish' 
	];

	if ( is_array($taxonomy) && count($taxonomy) > 0 ) {
		$categoryarray = [
			'relation' => 'OR'
		];

		foreach($taxonomy as $tax){
			$categoryarray[] = [
				'taxonomy'         => 'category',
				'field'            => 'slug',
				'terms'            => $tax,
				'include_children' => false,
			];
		}

		$args['tax_query'] = $categoryarray;
	}

	$request = get_posts($args);

	$output = [];
	foreach ($request as $item) {
		$item->address = get_field('address',$item->ID);
		$item->phone_number = get_field('phone_number',$item->ID);
		$item->toll_free_phone_number = get_field('toll_free_phone_number',$item->ID);
		$item->fax_number = get_field('fax_number',$item->ID);
		$item->email_address = get_field('email_address',$item->ID);
		$item->website = get_field('website',$item->ID);
		$item->photo = get_field('photo',$item->ID);
		$item->photos = get_field('venue_photos',$item->ID);
		
		$coords = explode(',', get_field('gps_coords', $item->ID));
		if(is_array($coords)){
			$item->latitude = trim($coords[0]);
			$item->longitude = trim($coords[1]);
		}
		
		$output[] = $item;
	}

	return $output;

}

add_action( 'rest_api_init', function () {
	register_rest_route( 'kerigansolutions/v1', '/map', array(
	  'methods' => 'GET',
	  'callback' => 'getVenues',
	) );
} );

add_action( 'rest_api_init', function () {
	register_rest_route( 'kerigansolutions/v1', '/map-categories', array(
	  'methods' => 'GET',
	  'callback' => function() { return get_terms('category'); },
	) );
} );

function getVenues( $request )
{
	$category = $request->get_param( 'category' );
	$listings = getBusinessListings($category);
	$output = [];

	foreach($listings as $listing){
		$output[] = [
			'latitude' => $listing->latitude,
			'longitude' => $listing->longitude,
			'title' => $listing->post_title,
			'address' => $listing->address,
			'link' => get_permalink($listing->ID)
		];
	}

	return rest_ensure_response( $output );
}

function business_listing_shortcode( $atts ) {
	$a = shortcode_atts( array(
		'category' => ''
	), $atts );

	$output = '<div class="row venues">';
	foreach(getBusinessListings($a['category']) as $listing){
		$output .= '
		<div class="col-md-6 col-lg-4 mb-4">
			<div class="card text-center full-height">
				'.($listing->photo != '' ? '<img src="'.$listing->photo['url'].'" alt="'.$listing->photo['alt'].'" class="card-img-top" >' : '').'
				<div class="card-body">
					<p><strong>'.$listing->post_title.'</strong></p>
					'.($listing->address!='' ? '<p>' . nl2br($listing->address) . '</p>' : '' ).'
					<p>
					'.($listing->phone_number!='' ? '<a href="tel:'.$listing->phone_number.'">'.$listing->phone_number.'</a><br>' : '').'
					'.($listing->toll_free_phone_number!='' ? '<a href="tel:'.$listing->toll_free_phone_number.'">'.$listing->toll_free_phone_number.'</a> <small>toll free</small><br>' : '').'
					'.($listing->fax_number!='' ? $listing->fax_number.' <small>fax</small><br>' : '').'
					'.($listing->email_address!='' ? '<a href="mailto:'.$listing->email_address.'">'.$listing->email_address.'</a><br>' : '').'
					'.($listing->website!='' ? '<a href="'.$listing->website.'">visit website</a><br>' : '').'
					</p>
				</div>
			</div>
		</div>
		';
	}
	$output .= '</div>';

	return $output;
}
add_shortcode( 'business_listings', 'business_listing_shortcode' );