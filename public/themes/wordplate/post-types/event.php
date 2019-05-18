<?php

/**
 * Registers the `event` post type.
 */
function event_init() {
	register_post_type( 'event', array(
		'labels'                => array(
			'name'                  => __( 'Events', 'wordplate' ),
			'singular_name'         => __( 'Event', 'wordplate' ),
			'all_items'             => __( 'All Events', 'wordplate' ),
			'archives'              => __( 'Event Archives', 'wordplate' ),
			'attributes'            => __( 'Event Attributes', 'wordplate' ),
			'insert_into_item'      => __( 'Insert into Event', 'wordplate' ),
			'uploaded_to_this_item' => __( 'Uploaded to this Event', 'wordplate' ),
			'featured_image'        => _x( 'Featured Image', 'event', 'wordplate' ),
			'set_featured_image'    => _x( 'Set featured image', 'event', 'wordplate' ),
			'remove_featured_image' => _x( 'Remove featured image', 'event', 'wordplate' ),
			'use_featured_image'    => _x( 'Use as featured image', 'event', 'wordplate' ),
			'filter_items_list'     => __( 'Filter Events list', 'wordplate' ),
			'items_list_navigation' => __( 'Events list navigation', 'wordplate' ),
			'items_list'            => __( 'Events list', 'wordplate' ),
			'new_item'              => __( 'New Event', 'wordplate' ),
			'add_new'               => __( 'Add New', 'wordplate' ),
			'add_new_item'          => __( 'Add New Event', 'wordplate' ),
			'edit_item'             => __( 'Edit Event', 'wordplate' ),
			'view_item'             => __( 'View Event', 'wordplate' ),
			'view_items'            => __( 'View Events', 'wordplate' ),
			'search_items'          => __( 'Search Events', 'wordplate' ),
			'not_found'             => __( 'No Events found', 'wordplate' ),
			'not_found_in_trash'    => __( 'No Events found in trash', 'wordplate' ),
			'parent_item_colon'     => __( 'Parent Event:', 'wordplate' ),
			'menu_name'             => __( 'Events', 'wordplate' ),
		),
		'public'                => true,
		'hierarchical'          => false,
		'show_ui'               => true,
		'show_in_nav_menus'     => true,
		'supports'              => array( 'title', 'editor' ),
		'has_archive'           => true,
		'rewrite'               => true,
		'query_var'             => true,
		'menu_position'         => null,
		'menu_icon'             => 'dashicons-admin-post',
		'show_in_rest'          => true,
		'rest_base'             => 'event',
		'rest_controller_class' => 'WP_REST_Posts_Controller',
	) );

}
add_action( 'init', 'event_init' );

/**
 * Sets the post updated messages for the `event` post type.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `event` post type.
 */
function event_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['event'] = array(
		0  => '', // Unused. Messages start at index 1.
		/* translators: %s: post permalink */
		1  => sprintf( __( 'Event updated. <a target="_blank" href="%s">View Event</a>', 'wordplate' ), esc_url( $permalink ) ),
		2  => __( 'Custom field updated.', 'wordplate' ),
		3  => __( 'Custom field deleted.', 'wordplate' ),
		4  => __( 'Event updated.', 'wordplate' ),
		/* translators: %s: date and time of the revision */
		5  => isset( $_GET['revision'] ) ? sprintf( __( 'Event restored to revision from %s', 'wordplate' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		/* translators: %s: post permalink */
		6  => sprintf( __( 'Event published. <a href="%s">View Event</a>', 'wordplate' ), esc_url( $permalink ) ),
		7  => __( 'Event saved.', 'wordplate' ),
		/* translators: %s: post permalink */
		8  => sprintf( __( 'Event submitted. <a target="_blank" href="%s">Preview Event</a>', 'wordplate' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		/* translators: 1: Publish box date format, see https://secure.php.net/date 2: Post permalink */
		9  => sprintf( __( 'Event scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Event</a>', 'wordplate' ),
		date_i18n( __( 'M j, Y @ G:i', 'wordplate' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
		/* translators: %s: post permalink */
		10 => sprintf( __( 'Event draft updated. <a target="_blank" href="%s">Preview Event</a>', 'wordplate' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	);

	return $messages;
}
add_filter( 'post_updated_messages', 'event_updated_messages' );

if( function_exists('acf_add_local_field_group') ):

	acf_add_local_field_group(array(
		'key' => 'group_5cd4706d9923d',
		'title' => 'Event Settings',
		'fields' => array(
			array(
				'key' => 'field_5cd47085875ff',
				'label' => 'Start',
				'name' => 'start',
				'type' => 'date_picker',
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '33',
					'class' => '',
					'id' => '',
				),
				'display_format' => 'F j, Y',
				'return_format' => 'Ymd',
				'first_day' => 0,
			),
			array(
				'key' => 'field_5cd4733d87600',
				'label' => 'End',
				'name' => 'end',
				'type' => 'date_picker',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '33',
					'class' => '',
					'id' => '',
				),
				'display_format' => 'F j, Y',
				'return_format' => 'Ymd',
				'first_day' => 1,
			),
			array(
				'key' => 'field_5cd4736987601',
				'label' => 'Time',
				'name' => 'time',
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
				'key' => 'field_5cd477706c3a2',
				'label' => 'Main Photo',
				'name' => 'main_photo',
				'type' => 'image',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '33',
					'class' => '',
					'id' => '',
				),
				'return_format' => 'array',
				'preview_size' => 'medium',
				'library' => 'all',
				'min_width' => '',
				'min_height' => '',
				'min_size' => '',
				'max_width' => '',
				'max_height' => '',
				'max_size' => '',
				'mime_types' => '',
			),
			array(
				'key' => 'field_5cd473aa87602',
				'label' => 'Location',
				'name' => 'location',
				'type' => 'google_map',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '66',
					'class' => '',
					'id' => '',
				),
				'center_lat' => '30.776472',
				'center_lng' => '-85.238694',
				'zoom' => '',
				'height' => '200',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'event',
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
	
	acf_add_local_field_group(array(
		'key' => 'group_5cd474b7ad239',
		'title' => 'Recurring Event Settings',
		'fields' => array(
			array(
				'key' => 'field_5cd474c7e9145',
				'label' => 'Recurring Period',
				'name' => 'recurring_period',
				'type' => 'radio',
				'instructions' => 'Does this event repeat on a regular basis?',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '33',
					'class' => '',
					'id' => '',
				),
				'choices' => array(
					'none' => 'None',
					'everyday' => 'Everyday',
					'weekly' => 'Weekly',
					'monthly' => 'Monthly',
				),
				'allow_null' => 0,
				'other_choice' => 0,
				'save_other_choice' => 0,
				'default_value' => '',
				'layout' => 'vertical',
				'return_format' => 'value',
			),

			array(
				'key' => 'field_5cd47684e0523',
				'label' => 'What Week',
				'name' => 'what_week',
				'type' => 'checkbox',
				'instructions' => 'Select the week(s) that this event is held each month.',
				'required' => 0,
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_5cd474c7e9145',
							'operator' => '==',
							'value' => 'monthly',
						),
					),
				),
				'wrapper' => array(
					'width' => '33',
					'class' => '',
					'id' => '',
				),
				'choices' => array(
					1 => 'First',
					2 => 'Second',
					3 => 'Third',
					4 => 'Fourth',
					5 => 'Fifth',
				),
				'allow_custom' => 0,
				'save_custom' => 0,
				'default_value' => array(
				),
				'layout' => 'vertical',
				'toggle' => 0,
				'return_format' => 'value',
			),

			array(
				'key' => 'field_5cd4754be9146',
				'label' => 'What Days',
				'name' => 'what_days',
				'type' => 'checkbox',
				'instructions' => 'Select the day(s) that this event is held each week.',
				'required' => 0,
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_5cd474c7e9145',
							'operator' => '!=',
							'value' => 'none',
						),
						array(
							'field' => 'field_5cd474c7e9145',
							'operator' => '!=',
							'value' => 'everyday',
						),
					),
				),
				'wrapper' => array(
					'width' => '33',
					'class' => '',
					'id' => '',
				),
				'choices' => array(
					'sunday' => 'Sunday',
					'monday' => 'Monday',
					'tuesday' => 'Tuesday',
					'wednesday' => 'Wednesday',
					'thursday' => 'Thursday',
					'friday' => 'Friday',
					'saturday' => 'Saturday',
				),
				'allow_custom' => 0,
				'save_custom' => 0,
				'default_value' => array(
				),
				'layout' => 'vertical',
				'toggle' => 0,
				'return_format' => 'array',
			),
			
			array(
				'key' => 'spacer_svkub9243fgbiukusbv',
				'label' => '',
				'name' => '',
				'type' => 'spacer',
				'wrapper' => array(
					'width' => '100',
					'class' => '',
					'id' => '',
				),
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'event',
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

	function my_acf_google_map_api( $api ){
	
		$api['key'] = env('GOOGLE_MAPS_API', '123456');;
		return $api;
		
	}
	
	add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');


	function getEvents($limit = -1){
		$today     = date('Ymd');

		$args = [
			'posts_per_page'   => $limit,
			'orderby'          => 'menu_order',
			'order'            => 'ASC',
			'post_type'        => 'event',
			'post_status'      => 'publish',
			'meta_query'       => array(
				'relation' => 'OR',
				array(
					'key'     => 'end',
					'value'   => $today,
					'compare' => '>='
				),
				array(
					'key'     => 'recurring_period',
					'value'   => 'none',
					'compare' => '!='
				)
			) 
		];
	
		$request = get_posts($args);
	
		$output = [];
		foreach ($request as $item) {
			$item->event_start = get_field('start',$item->ID);
			$item->event_end = get_field('end',$item->ID);
			$item->event_time = get_field('time',$item->ID);
			$item->main_photo = get_field('main_photo',$item->ID);
			$item->location = get_field('location',$item->ID);
			$item->recurring_period = get_field('recurring_period',$item->ID);
			$item->what_week = get_field('what_week',$item->ID);
			$item->what_day = get_field('what_days',$item->ID);

			if ($item->event_start < $today + 1) {
                $item->event_start = advanceDate($item->event_start, $item->recurring_period);
            }
	
			$output[] = $item;
		}
	
		return orderEvents($output);
	
	}

	function advanceDate($start, $recurring)
    {
        $today     = date('Ymd');
        $date      = DateTime::createFromFormat('Ymd', $start, new DateTimeZone('America/Chicago'));
        $todayDate = DateTime::createFromFormat('Ymd', $today, new DateTimeZone('America/Chicago'));
        $weekDay   = date('l', strtotime($start));
        $thisDay   = date('d', strtotime($start));
        $thisMonth = date('F', strtotime($start));
        $thisYear  = date('Y', strtotime($start));
        $newDate   = $start;

        if ($recurring == 'weekly') {
            $newDate = $todayDate->modify('next ' . $weekDay);
            $newDate = $newDate->format('Ymd');
        }
        if ($recurring == 'monthly') {

            $week = $this->getWeek($start);
            if ($week == 1) {
                $week = 'First';
            }
            if ($week == 2) {
                $week = 'Second';
            }
            if ($week == 3) {
                $week = 'Third';
            }
            if ($week == 4) {
                $week = 'Fourth';
            }
            if ($week == 5) {
                $week = 'Fifth';
            }

            $dateString = $week . ' ' . $weekDay . ' of next month';
            $newDate    = $todayDate->modify($dateString)->format('Ymd');
        }

        return $newDate;
	}
	
	function orderEvents($inputArray)
    {
        $sorter      = [];
        $returnArray = [];
        reset($inputArray);

        foreach ($inputArray as $key => $var) {
            $sorter[$key] = $var->event_start;
        }
        asort($sorter);
        foreach ($sorter as $key => $var) {
            $returnArray[$key] = $inputArray[$key];
        }

        return $returnArray;
    }