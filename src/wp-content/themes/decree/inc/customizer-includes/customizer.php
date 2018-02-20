<?php
/**
 * The main template for implementing Theme/Customizer Options
 *
 * @package Decree
 */

/**
 * Implements Decree theme options into Theme Customizer.
 *
 * @param object $wp_customize Theme Customizer object.
 * @return void
 *
 * @since Decree 0.1
 */
function decree_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport			= 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport	= 'postMessage';

	$options  = decree_get_theme_options();

	$defaults = decree_get_default_theme_options();

	// Custom Controls.
	require trailingslashit( get_template_directory() ) . 'inc/customizer-includes/custom-controls.php';

	// Move title_tagline (added to Site Title and Tagline section in Theme Customizer).
	$wp_customize->add_setting( 'decree_theme_options[move_title_tagline]', array(
			'default'			=> $defaults['move_title_tagline'],
		'sanitize_callback' => 'decree_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'decree_theme_options[move_title_tagline]', array(
		'label'    => esc_html__( 'Check to move Site Title and Tagline before logo', 'decree' ),
		'priority' => 103,
		'section'  => 'title_tagline',
		'settings' => 'decree_theme_options[move_title_tagline]',
		'type'     => 'checkbox',
	) );

	// Header Options (added to Header section in Theme Customizer).
	require trailingslashit( get_template_directory() ) . 'inc/customizer-includes/header-options.php';

	// Theme Options.
	require trailingslashit( get_template_directory() ) . 'inc/customizer-includes/theme-options.php';

	// Portfolio.
	require trailingslashit( get_template_directory() ) . 'inc/customizer-includes/portfolio.php';

	// Featured Content Setting.
	require trailingslashit( get_template_directory() ) . 'inc/customizer-includes/featured-content.php';

	// Featured Slider.
	require trailingslashit( get_template_directory() ) . 'inc/customizer-includes/featured-slider.php';

	// Social Links.
	require trailingslashit( get_template_directory() ) . 'inc/customizer-includes/social-icons.php';

	// Hero Content.
	require trailingslashit( get_template_directory() ) . 'inc/customizer-includes/hero-content.php';

	// Team.
	require trailingslashit( get_template_directory() ) . 'inc/customizer-includes/team.php';

	// Promotion Headline.
	require trailingslashit( get_template_directory() ) . 'inc/customizer-includes/promotion-headline.php';

	// Testimonial.
	require trailingslashit( get_template_directory() ) . 'inc/customizer-includes/testimonial.php';

	// Logo Slider.
	require trailingslashit( get_template_directory() ) . 'inc/customizer-includes/logo-slider.php';

	// Reset all settings to default.
	$wp_customize->add_section( 'decree_reset_all_settings', array(
		'description'	=> esc_html__( 'Caution: Reset all settings to default. Refresh the page after save to view full effects.', 'decree' ),
		'priority' 		=> 900,
		'title'    		=> esc_html__( 'Reset all settings', 'decree' ),
	) );

	$wp_customize->add_setting( 'decree_theme_options[reset_all_settings]', array(
			'default'			=> $defaults['reset_all_settings'],
		'sanitize_callback' => 'decree_sanitize_checkbox',
		'transport'			=> 'postMessage',
	) );

	$wp_customize->add_control( 'decree_theme_options[reset_all_settings]', array(
		'label'    => esc_html__( 'Check to reset all settings to default', 'decree' ),
		'section'  => 'decree_reset_all_settings',
		'settings' => 'decree_theme_options[reset_all_settings]',
		'type'     => 'checkbox',
	) );
	// Reset all settings to default end

	//Important Links
	$wp_customize->add_section( 'important_links', array(
		'priority' 		=> 999,
		'title'   	 	=> esc_html__( 'Important Links', 'decree' ),
	) );

	/**
	 * Has dummy Sanitizaition function as it contains no value to be sanitized
	 */
	$wp_customize->add_setting( 'important_links', array(
		'sanitize_callback'	=> 'sanitize_text_field',
	) );

	$wp_customize->add_control( new decree_Important_Links( $wp_customize, 'important_links', array(
		'label'   	=> esc_html__( 'Important Links', 'decree' ),
		 'section'  	=> 'important_links',
		'settings' 	=> 'important_links',
		'type'     	=> 'important_links',
	) ) );
}
add_action( 'customize_register', 'decree_customize_register' );


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously for Decree.
 * And flushes out all transient data on preview
 *
 * @since Decree 0.1
 */
function decree_customize_preview() {
	wp_enqueue_script( 'decree_customizer', get_template_directory_uri() . '/js/customizer.min.js', array( 'customize-preview' ), '20120827', true );

	//Flush transients
	decree_flush_transients();
}
add_action( 'customize_preview_init', 'decree_customize_preview' );


/**
 * Custom scripts and styles on customize.php for Decree.
 *
 * @since Decree 0.1
 */
function decree_customize_scripts() {
	wp_enqueue_script( 'decree_customizer_custom', get_template_directory_uri() . '/js/customizer-custom-scripts.min.js', array( 'customize-controls', 'iris', 'underscore', 'wp-util' ), '20150630', true );

	$decree_data = array(
		'reset_message' => esc_html__( 'Refresh the customizer page after saving to view reset effects', 'decree' ),
	);

	// Send list of color variables as object to custom customizer js.
	wp_localize_script( 'decree_customizer_custom', 'decree_data', $decree_data );
}
add_action( 'customize_controls_enqueue_scripts', 'decree_customize_scripts' );



function decree_sort_sections_list( $wp_customize ) {
	foreach ( $wp_customize->sections() as $section_key => $section_object ) {
		if ( false !== strpos( $section_key, 'decree_' ) && 'decree_reset_all_settings' !== $section_key && 'decree_important_links' !== $section_key && 'decree_menu_options' !== $section_key ) {
			$options[] = $section_key;
		}
	}

	sort( $options );

	$priority = 1;
	foreach ( $options as  $option ) {
		$wp_customize->get_section( $option )->priority	= $priority++;
	}
}
add_action( 'customize_register', 'decree_sort_sections_list' );

/**
 * Function to reset date with respect to condition
 *
 * @since Decree 0.1
 *
 */
function decree_reset_data() {
	$options  = decree_get_theme_options();

	if ( $options['reset_all_settings'] ) {
		remove_theme_mods();

		// Flush out all transients	on reset.
		decree_flush_transients();

		return;
	}
}
add_action( 'customize_save_after', 'decree_reset_data' );

// Active callbacks for customizer.
require trailingslashit( get_template_directory() ) . 'inc/customizer-includes/active-callbacks.php';


// Sanitize functions for customizer.
require trailingslashit( get_template_directory() ) . 'inc/customizer-includes/sanitize-functions.php';

// Add Upgrade to Pro Button.
require trailingslashit( get_template_directory() ) . 'inc/customizer-includes/upgrade-button/class-customize.php';
