<?php
/**
 * Public
 *
 * Output for the public side e.g. Public css & js
 *
 * @package      ${PACKAGE}
 * @license      license.txt
 * @copyright    ${YEAR} ${COMPANY}
 * @since        ${VERSION}
 *
 * Please do not edit this file. This file is part of the ${PACKAGE} Framework and all modifications
 * should be made in a child theme.
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// @TODO Escape options output

/*
 * Load inline CSS in the footer
 *
 */
function responsive_II_inline_css() {
	$responsive_II_options = responsive_II_get_options();
	if( !empty( $responsive_II_options['responsive_II_inline_css'] ) ) {
		echo '<!-- Custom CSS Styles -->' . "\n";
		echo '<style type="text/css" media="screen">' . "\n";
		echo esc_html( $responsive_II_options['responsive_II_inline_css'] ) . "\n";
		echo '</style>' . "\n";
	}
}
add_action( 'wp_head', 'responsive_II_inline_css', 110 );

/*
 * Load inline js in the header
 *
 */
function responsive_II_inline_js_head() {
	$responsive_II_options = responsive_II_get_options();
	if( !empty( $responsive_II_options['responsive_II_inline_js_head'] ) ) {
		echo '<!-- Custom Scripts -->' . "\n";
		echo $responsive_II_options['responsive_II_inline_js_head'];
		echo "\n";
	}
}
add_action( 'wp_head', 'responsive_II_inline_js_head' );

/*
 * Load inline js in the footer
 *
 */
function responsive_II_inline_js_footer() {
	$responsive_II_options = responsive_II_get_options();
	if( !empty( $responsive_II_options['responsive_II_inline_js_footer'] ) ) {
		echo '<!-- Custom Scripts -->' . "\n";
		echo $responsive_II_options['responsive_II_inline_js_footer'];
		echo "\n";
	}
}
add_action( 'wp_footer', 'responsive_II_inline_js_footer' );