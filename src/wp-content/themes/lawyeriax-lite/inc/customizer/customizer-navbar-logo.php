<?php
/**
 * Customizer Controls Navbar Logo.
 *
 * @package Lawyeriax
 */

/**
 * Hook Navbar logo controls to customizer.
 *
 * @param object $wp_customize The wp_customize object.
 */
function lawyeriax_navbar_logo_customize_register( $wp_customize ) {

	if ( ! function_exists( 'the_custom_logo' ) ) {
		$wp_customize->add_setting( 'lawyeriax_navbar_logo', array(
			'default'           => get_template_directory_uri() . '/images/logo.png',
			'sanitize_callback' => 'esc_url_raw',
		) );

		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'lawyeriax_navbar_logo', array(
			'label'    => esc_html__( 'Logo', 'lawyeriax-lite' ),
			'section'  => 'title_tagline',
			'priority' => 7,
		) ) );
	}
}

add_action( 'customize_register', 'lawyeriax_navbar_logo_customize_register' );
