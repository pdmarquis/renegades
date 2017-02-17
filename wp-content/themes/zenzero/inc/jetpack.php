<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package zenzero
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function zenzero_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'    => 'zenzero_infinite_scroll_render',
		'footer'    => 'page',
	) );
	add_theme_support( 'jetpack-responsive-videos' );
}
add_action( 'after_setup_theme', 'zenzero_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function zenzero_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		get_template_part( 'content', get_post_format() );
	}
} // end function zenzero_infinite_scroll_render
