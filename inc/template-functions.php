<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Karma
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function karma_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'karma_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function karma_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'karma_pingback_header' );

// Custom Query
if(!function_exists('karma_wp_query')){ 
	function karma_wp_query($ppp, $taxonomy, $field, $terms ){
	
		$args = array(
			'post_type' => 'product', 
			'post_status' => 'publish',
			);
	
			$args['posts_per_page'] = $ppp;
			$args['tax_query'][0]['taxonomy'] = $taxonomy;
			$args['tax_query'][0]['field'] = $field;
			$args['tax_query'][0]['terms'] = $terms;
	
			$quaried_products = new WP_Query($args);
	
			return $quaried_products;
	} 
}


