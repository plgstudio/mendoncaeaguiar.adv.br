<?php
/**
 * Customizer News Section Controls.
 *
 * @package Lawyeriax
 */

/**
 * Hook News Section controls to customizer.
 *
 * @param object $wp_customize The wp_customize object.
 */
function lawyeriax_news_customize_register( $wp_customize ) {

	$wp_customize->add_section( 'lawyeriax_news_section', array(
		'title'       => esc_html__( 'Latest News', 'lawyeriax-lite' ),
		'description' => esc_html__( 'Latest News Content', 'lawyeriax-lite' ),
		'priority'    => lawyeriax_get_section_priority( 40, 'lawyeriax_news_section' ),
	) );

	/*
	=============================================================================
		Heading
	=============================================================================
	*/

	$wp_customize->add_setting( 'news_heading', array(
		'default'           => esc_html__( 'Latest News', 'lawyeriax-lite' ),
		'sanitize_callback' => 'lawyeriax_sanitize_text',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'news_heading', array(
		'label'    => esc_html__( 'Section Heading', 'lawyeriax-lite' ),
		'section'  => 'lawyeriax_news_section',
		'priority' => 2,
	) );
}

add_action( 'customize_register', 'lawyeriax_news_customize_register' );
