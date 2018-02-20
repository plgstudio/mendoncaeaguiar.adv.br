<?php
/**
 * The template for adding Hero Content Settings in Customizer
 *
 * @package Decree
 */

$wp_customize->add_section( 'decree_hero_content', array(
	'panel' => 'decree_theme_options',
	'title' => esc_html__( 'Hero Content', 'decree' ),
) );

$wp_customize->add_setting( 'decree_theme_options[hero_content_option]', array(
	'default'           => $defaults['hero_content_option'],
	'sanitize_callback' => 'decree_sanitize_select',
) );

$wp_customize->add_control( 'decree_theme_options[hero_content_option]', array(
	'choices'  => decree_section_visibility_options(),
	'label'    => esc_html__( 'Enable on', 'decree' ),
	'section'  => 'decree_hero_content',
	'settings' => 'decree_theme_options[hero_content_option]',
	'type'     => 'select',
) );

$wp_customize->add_setting( 'decree_theme_options[hero_content_number]', array(
	'default'           => $defaults['hero_content_number'],
	'sanitize_callback' => 'decree_sanitize_number_range',
) );

$wp_customize->add_control( 'decree_theme_options[hero_content_number]' , array(
		'active_callback' => 'decree_is_hero_content_active',
		'description'     => esc_html__( 'Save and refresh the page if No. of Hero Content is changed', 'decree' ),
		'input_attrs'     => array(
			'style' => 'width: 45px;',
			'min'   => 0,
		),
		'label'           => esc_html__( 'No of Hero Content', 'decree' ),
		'section'         => 'decree_hero_content',
		'settings'        => 'decree_theme_options[hero_content_number]',
		'type'            => 'number',
		)
);

$wp_customize->add_setting( 'decree_theme_options[hero_content_enable_title]', array(
	'default'           => $defaults['hero_content_enable_title'],
	'sanitize_callback' => 'decree_sanitize_checkbox',
) );

$wp_customize->add_control(  'decree_theme_options[hero_content_enable_title]', array(
	'active_callback' => 'decree_is_hero_content_active',
	'label'           => esc_html__( 'Check to Enable Title', 'decree' ),
	'section'         => 'decree_hero_content',
	'settings'        => 'decree_theme_options[hero_content_enable_title]',
	'type'            => 'checkbox',
) );

$wp_customize->add_setting( 'decree_theme_options[hero_content_show]', array(
	'default'           => $defaults['hero_content_show'],
	'sanitize_callback' => 'decree_sanitize_select',
) );

$wp_customize->add_control( 'decree_theme_options[hero_content_show]', array(
	'active_callback' => 'decree_is_hero_content_active',
	'choices'         => decree_featured_content_show(),
	'label'           => esc_html__( 'Display Content', 'decree' ),
	'section'         => 'decree_hero_content',
	'settings'        => 'decree_theme_options[hero_content_show]',
	'type'            => 'select',
) );

for ( $i = 1; $i <= $options['hero_content_number'] ; $i++ ) {
	//page content
	$wp_customize->add_setting( 'decree_theme_options[hero_content_page_' . $i . ']', array(
			'sanitize_callback'	=> 'decree_sanitize_page',
	) );

	$wp_customize->add_control( 'decree_hero_content_page_' . $i, array(
		'active_callback' => 'decree_is_hero_content_active',
		'label'           => esc_html__( 'Page', 'decree' ) . ' ' . $i,
		'section'         => 'decree_hero_content',
		'settings'        => 'decree_theme_options[hero_content_page_' . $i . ']',
		'type'            => 'dropdown-pages',
	) );
}
