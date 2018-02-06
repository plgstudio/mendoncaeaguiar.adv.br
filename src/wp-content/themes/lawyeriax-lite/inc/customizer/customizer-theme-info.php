<?php
/**
 * Theme info customizer controls.
 *
 * @package Lawyeriax
 */
/**
 * Hook Theme Info section to customizer.
 *
 * @param object $wp_customize The wp_customize object.
 */
function lawyeriax_theme_info_customize_register( $wp_customize ) {

	require_once( get_template_directory() . '/inc/class/theme-info/class-lawyeriax-info.php' );

	$wp_customize->add_section('lawyeriax_theme_info', array(
		'title' => __( 'Theme info', 'lawyeriax-lite' ),
		'priority' => 0,
	) );
	$wp_customize->add_setting('lawyeriax_theme_info', array(
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'lawyeriax_lite_sanitize_text',
	) );

	$wp_customize->add_control( new LawyeriaX_Info( $wp_customize, 'lawyeriax_theme_info', array(
		'section'  => 'lawyeriax_theme_info',
		'priority' => 10,
		'links'    => array(
			array(
				'name' => __( 'View Demo','lawyeriax-lite' ),
				'link' => esc_url( 'https://themeisle.com/demo/?theme=LawyeriaX%20Lite' ),
			),
			array(
				'name' => __( 'Free VS Pro','lawyeriax-lite' ),
				'link' => esc_url( 'http://docs.themeisle.com/article/528-what-is-the-difference-between-lawyeriax-lite-and-lawyeriax-pro' ),
			),
			array(
				'name' => __( 'Leave a review','lawyeriax-lite' ),
				'link' => esc_url( 'https://wordpress.org/support/theme/lawyeriax-lite/reviews/#new-post' ),
			),
		),
	) ) );
}
add_action( 'customize_register', 'lawyeriax_theme_info_customize_register' );

/**
 *  Customizer info
 */
require_once get_template_directory() . '/inc/class/customizer-info/class-singleton-customizer-info-section.php';
