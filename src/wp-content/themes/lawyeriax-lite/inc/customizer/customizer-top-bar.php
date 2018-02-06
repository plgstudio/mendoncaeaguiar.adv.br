<?php
/**
 * Customizer Controls for the Top Bar of the website.
 *
 * @package Lawyeriax
 */

/**
 * Hook Theme Info section to customizer.
 *
 * @param object $wp_customize The wp_customize object.
 */
function lawyeriax_top_bar_customize_register( $wp_customize ) {

	/* TOP BAR AREA  */
	$wp_customize->add_section( 'lawyeriax_top_bar_section', array(
		'title'       => __( 'Top Bar', 'lawyeriax-lite' ),
		'description' => __( 'Top Bar Content', 'lawyeriax-lite' ),
		'priority'    => 30,
	) );

	/*
	=============================================================================
		Toggle
	=============================================================================
	*/

	$wp_customize->add_setting( 'lawyeriax_top_bar_hide', array(
		'sanitize_callback' => 'lawyeriax_sanitize_checkbox',
		'default'           => true,
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'lawyeriax_top_bar_hide', array(
		'type'     => 'checkbox',
		'label'    => __( 'Disable top bar', 'lawyeriax-lite' ),
		'section'  => 'lawyeriax_top_bar_section',
		'priority' => 1,
	) );

	/*
	=============================================================================
		Social icons
	=============================================================================
	*/

	$wp_customize->add_setting('lawyeriax_top_bar_social_icons', array(
		'sanitize_callback' => 'lawyeriax_sanitize_repeater',
	));

	$wp_customize->add_control(new LawyeriaX_General_Repeater($wp_customize, 'lawyeriax_top_bar_social_icons', array(
		'label'                    => esc_html__( 'Social Links', 'lawyeriax-lite' ),
		'description'              => esc_html__( 'Edit, add or remove social links from the top bar', 'lawyeriax-lite' ),
		'section'                  => 'lawyeriax_top_bar_section',
		'priority'                 => 2,
		'lawyeriax_icon_control'   => true,
		'lawyeriax_link_control'   => true,
	)));

	/*
	=============================================================================
		Phone number
	=============================================================================
	*/

	$wp_customize->add_setting('lawyeriax_top_bar_phone_number', array(
		'sanitize_callback' => 'lawyeriax_sanitize_text',
	));

	$wp_customize->add_control('lawyeriax_top_bar_phone_number', array(
		'label'       => esc_html__( 'Phone Number', 'lawyeriax-lite' ),
		'section'     => 'lawyeriax_top_bar_section',
		'priority'    => 3,
	));

	/*
	=============================================================================
		Email address
	=============================================================================
	*/

	$wp_customize->add_setting('lawyeriax_top_bar_email_address', array(
		'sanitize_callback' => 'lawyeriax_sanitize_text',
	));

	$wp_customize->add_control('lawyeriax_top_bar_email_address', array(
		'label'       => esc_html__( 'Email Address', 'lawyeriax-lite' ),
		'section'     => 'lawyeriax_top_bar_section',
		'priority'    => 4,
	));

}
add_action( 'customize_register', 'lawyeriax_top_bar_customize_register' );
