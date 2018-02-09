<?php
/**
 * Customizer Controls for Header.
 *
 * @package Lawyeriax
 */

/**
 * Hook Theme Info section to customizer.
 *
 * @param object $wp_customize The wp_customize object.
 */
function lawyeriax_header_customize_register( $wp_customize ) {

	$wp_customize->get_section( 'header_image' )->priority = 31;
	$wp_customize->get_section( 'header_image' )->title    = __( 'Header', 'lawyeriax-lite' );

	/**
	 * Control for header title
	 */
	$wp_customize->add_setting( 'lawyeriax_bigtitle_title', array(
		'sanitize_callback' => 'lawyeriax_sanitize_text',
	) );

	$wp_customize->add_control( 'lawyeriax_bigtitle_title', array(
		'label'    => esc_html__( 'Title', 'lawyeriax-lite' ),
		'section'  => 'header_image',
		'priority' => 20,
	) );

	/**
	 * Control for header text
	 */
	$wp_customize->add_setting( 'lawyeriax_bigtitle_text', array(
		'sanitize_callback' => 'lawyeriax_sanitize_text',
	) );

	$wp_customize->add_control( 'lawyeriax_bigtitle_text', array(
		'label'    => esc_html__( 'Text', 'lawyeriax-lite' ),
		'section'  => 'header_image',
		'priority' => 25,
	) );

	/**
	 * Control for button text
	 */
	$wp_customize->add_setting( 'lawyeriax_bigtitle_button_text', array(
		'sanitize_callback' => 'lawyeriax_sanitize_text',
	) );
	$wp_customize->add_control( 'lawyeriax_bigtitle_button_text', array(
		'label'    => esc_html__( 'Button text', 'lawyeriax-lite' ),
		'section'  => 'header_image',
		'priority' => 30,
	) );

	/**
	 * Control for button link
	 */
	$wp_customize->add_setting( 'lawyeriax_bigtitle_button_link', array(
		'sanitize_callback' => 'esc_url',
	) );
	$wp_customize->add_control( 'lawyeriax_bigtitle_button_link', array(
		'label'    => esc_html__( 'Button URL', 'lawyeriax-lite' ),
		'section'  => 'header_image',
		'priority' => 35,
	) );

	/**
	 * Control for slider shortcode
	 */
	$wp_customize->add_setting( 'lawyeriax_slider_shortcode', array(
		'sanitize_callback' => 'lawyeriax_sanitize_text',
	) );

	$lawyeriax_lite_slider_descr = '';

	if ( ! class_exists( 'WordPress_Nivo_Slider_Lite' ) ) {
		$lawyeriax_lite_slider_descr = sprintf(
			__( 'We recommend you install %1$s to get one of the most advanced slider plugin.', 'lawyeriax-lite' ),
			sprintf( '<a href="' . esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=nivo-slider-lite' ), 'install-plugin_nivo-slider-lite' ) ) . '" rel="nofollow">%s</a>', esc_html__( 'Nivo Slider Lite Plugin', 'lawyeriax-lite' ) )
		);
	}

	$wp_customize->add_control( 'lawyeriax_slider_shortcode', array(
		'label'       => esc_html__( 'Slider ', 'lawyeriax-lite' ),
		'description' => $lawyeriax_lite_slider_descr,
		'section'     => 'header_image',
		'priority'    => 40,
	) );
}

add_action( 'customize_register', 'lawyeriax_header_customize_register' );
