<?php
/**
 * Customizer Features Section Controls.
 *
 * @package Lawyeriax
 */

/**
 * Hook Features Section controls to customizer.
 *
 * @param object $wp_customize The wp_customize object.
 */
function lawyeriax_features_customize_register( $wp_customize ) {

	$wp_customize->add_section( 'lawyeriax_features_section', array(
		'description' => esc_html__( 'Edit, add or remove items from the front page features section', 'lawyeriax-lite' ),
		'title'       => esc_html__( 'Features Area', 'lawyeriax-lite' ),
		'priority'    => lawyeriax_get_section_priority( 35, 'lawyeriax_features_section' ),
	) );

	// Pages Drop Downs
	// First
	$wp_customize->add_setting( 'first_feature_box', array(
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'lawyeriax_sanitize_dropdown_pages',
	) );

	$wp_customize->add_control( 'first_feature_box', array(
		'label'   => __( 'First Panel', 'lawyeriax-lite' ),
		'section' => 'lawyeriax_features_section',
		'type'    => 'dropdown-pages',
	) );

	// Second
	$wp_customize->add_setting( 'second_feature_box', array(
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'lawyeriax_sanitize_dropdown_pages',
	) );

	$wp_customize->add_control( 'second_feature_box', array(
		'label'   => __( 'Second Panel', 'lawyeriax-lite' ),
		'section' => 'lawyeriax_features_section',
		'type'    => 'dropdown-pages',
	) );

	// Third
	$wp_customize->add_setting( 'third_feature_box', array(
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'lawyeriax_sanitize_dropdown_pages',
	) );

	$wp_customize->add_control( 'third_feature_box', array(
		'label'   => __( 'Third Panel', 'lawyeriax-lite' ),
		'section' => 'lawyeriax_features_section',
		'type'    => 'dropdown-pages',
	) );

	// Fourth
	$wp_customize->add_setting( 'fourth_feature_box', array(
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'lawyeriax_sanitize_dropdown_pages',
	) );

	$wp_customize->add_control( 'fourth_feature_box', array(
		'label'   => __( 'Fourth Panel', 'lawyeriax-lite' ),
		'section' => 'lawyeriax_features_section',
		'type'    => 'dropdown-pages',
	) );
}

add_action( 'customize_register', 'lawyeriax_features_customize_register' );
