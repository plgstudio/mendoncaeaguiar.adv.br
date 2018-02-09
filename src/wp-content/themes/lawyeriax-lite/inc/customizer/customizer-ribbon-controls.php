<?php
/**
 * Customizer Ribbon Section Controls.
 *
 * @package Lawyeriax
 */

/**
 * Hook Ribbon Section controls to customizer.
 *
 * @param object $wp_customize The wp_customize object.
 */
function lawyeriax_ribbon_customize_register( $wp_customize ) {

	$wp_customize->add_section( 'lawyeriax_ribbon_section', array(
		'title'       => esc_html__( 'Ribbon Section', 'lawyeriax-lite' ),
		'description' => esc_html__( 'Ribbon section settings', 'lawyeriax-lite' ),
		'priority'    => 35,
	) );

	/*
	=============================================================================
		Tagline
	=============================================================================
	*/

	$wp_customize->add_setting( 'lawyeriax_ribbon_tagline', array(
		'default'           => esc_html__( 'The safety of the people shall be the highest law.', 'lawyeriax-lite' ),
		'sanitize_callback' => 'lawyeriax_sanitize_text',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'lawyeriax_ribbon_tagline', array(
		'label'    => esc_html__( 'Ribbon Tagline', 'lawyeriax-lite' ),
		'section'  => 'lawyeriax_ribbon_section',
		'priority' => lawyeriax_get_section_priority( 10, 'lawyeriax_ribbon_section' ),
	) );
}

add_action( 'customize_register', 'lawyeriax_ribbon_customize_register' );
