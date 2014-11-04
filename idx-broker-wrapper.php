<?php


/**
 * Register Dynamic Wrapper Custom Post Type
 */
function idxbroker_dynamic_wrappers() {

	$labels = array(
		'name'                => _x( 'Dynamic Wrappers', 'Post Type General Name', 'idxbroker' ),
		'singular_name'       => _x( 'Dynamic Wrapper', 'Post Type Singular Name', 'idxbroker' ),
		'menu_name'           => __( 'Dynamic Wrappers', 'idxbroker' ),
		'parent_item_colon'   => __( 'Parent Wrapper:', 'idxbroker' ),
		'all_items'           => __( 'All Dynamic Wrappers', 'idxbroker' ),
		'view_item'           => __( 'View Wrapper', 'idxbroker' ),
		'add_new_item'        => __( 'Create New Wrapper', 'idxbroker' ),
		'add_new'             => __( 'Create a Dynamic Wrapper', 'idxbroker' ),
		'edit_item'           => __( 'Edit Wrapper', 'idxbroker' ),
		'update_item'         => __( 'Update Wrapper', 'idxbroker' ),
		'search_items'        => __( 'Search Wrappers', 'idxbroker' ),
		'not_found'           => __( 'No Wrapper Found', 'idxbroker' ),
		'not_found_in_trash'  => __( 'No Wrapper Found in Trash', 'idxbroker' ),
	);
	$rewrite = array(
		'slug'                => '/idx/wrapper',
		'with_front'          => false,
		'pages'               => true,
		'feeds'               => false,
	);
	$args = array(
		'label'               => __( 'Dynamic Wrappers', 'idxbroker' ),
		'description'         => __( 'A dynamic wrapper for IDX Broker. ', 'idxbroker' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'revisions' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => false,
		'show_in_nav_menus'   => false,
		'show_in_admin_bar'   => true,
		// 'menu_position'       => 100,
		// 'menu_icon'           => '',
		'can_export'          => true,
		'has_archive'         => false,
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'rewrite'             => $rewrite,
		'capability_type'     => 'page',
	);
	register_post_type( 'idxbroker-wrapper', $args );

}

// Hook into the 'init' action
add_action( 'init', 'idxbroker_dynamic_wrappers' );


/**
 * Basic Wrapper Setup - Hide Admin Bar
 */
add_action('wp_print_styles', 'idxwrapper_setup');

function idxwrapper_setup() {
if ( 'idxbroker-wrapper' == get_post_type() ) {

 	show_admin_bar( false ); // Disable WordPress Adminbar
 	wp_dequeue_style('debug-bar'); // Remove WP Adminbar CSS
 	wp_dequeue_script('debug-bar');
 	wp_dequeue_style('admin-bar'); // Remove WP Adminbar CSS
 	wp_dequeue_script('admin-bar');
 	wp_dequeue_style('dashicons'); // Remove WP Dash Icons
 	wp_dequeue_style('boxes'); // Remove Yoast SEO Boxes CSS
 	wp_deregister_script( 'comment-reply' );
 	}
}


/**
 * IDX Wrapper Start Stop Tags
 */
function idxbroker_wrapper_startstop_tags() {
	if ( 'idxbroker-wrapper' == get_post_type() ) {
		echo '<div id="idxStart" style="display: none;"></div><div id="idxStop" style="display: none;"></div>';
	}
}
add_filter('the_content', 'idxbroker_wrapper_startstop_tags');


/**
 * IDX Wrapper HTML Tag (Useful for Troubleshooting)
 */
function setup_idxbroker_dynamic_wrapper_tag() {
	if ( 'idxbroker-wrapper' == get_post_type() ) {
		echo "\n<!-- IDX Broker Dynamic Wrapper (" . get_the_title() .") -->\n\n";
	}
}
add_action('wp_head', 'setup_idxbroker_dynamic_wrapper_tag');


/**
 * Custom Body classes for IDX Wrappers
 */
add_filter('body_class','setup_idxbroker_wpbody_class_names');
function setup_idxbroker_wpbody_class_names( $classes) {
	if ( 'idxbroker-wrapper' == get_post_type() ) {
    		return array('idxbroker idxbroker-dynamic-wrapper dynamic-wrapper-'.get_the_title().'' );
    	} else {  }
}


/**
 * IDX Broker CSS Tag (Determines when to load IDX CSS)
 */
function setup_idxbroker_wrapper_css() {
	if ( 'idxbroker-wrapper' == get_post_type() ) {
		echo "\n<!-- IDX CSS -->\n\n"; // IDX Broker detection comment
	}
}
add_action('wp_print_styles', 'setup_idxbroker_wrapper_css');

