<?php
/**
 * Functions and definitions
 *
 * Sets up the theme using core decree-core and provides some helper functions using decree-custon-functions.
 * Others are attached to action and
 * filter hooks in WordPress to change core functionality
 *
 * @package Decree
 */

//define theme version
if ( !defined( 'DECREE_THEME_VERSION' ) ) {
	$theme_data = wp_get_theme();

	define ( 'DECREE_THEME_VERSION', $theme_data->get( 'Version' ) );
}

/**
 * Implement the core functions
 */
require trailingslashit( get_template_directory() ) . 'inc/core.php';
