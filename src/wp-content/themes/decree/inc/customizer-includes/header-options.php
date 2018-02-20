<?php
/**
* The template for adding Additional Header Option in Customizer
*
* @package Decree
*/

// Header Options
$wp_customize->add_setting( 'decree_theme_options[enable_featured_header_image]', array(
	'default'			=> $defaults['enable_featured_header_image'],
	'sanitize_callback' => 'decree_sanitize_select',
) );

$wp_customize->add_control( 'decree_theme_options[enable_featured_header_image]', array(
		'choices'  	=> decree_enable_featured_header_image_options(),
		'label'		=> esc_html__( 'Enable on ', 'decree' ),
		'section'   => 'header_image',
        'settings'  => 'decree_theme_options[enable_featured_header_image]',
        'type'	  	=> 'select',
) );

$wp_customize->add_setting( 'decree_theme_options[featured_image_size]', array(
	'default'			=> $defaults['featured_image_size'],
	'sanitize_callback' => 'decree_sanitize_select',
) );

$wp_customize->add_control( 'decree_theme_options[featured_image_size]', array(
		'choices'  	=> decree_image_sizes_options(),
		'label'		=> esc_html__( 'Page/Post Featured Header Image Size', 'decree' ),
		'section'   => 'header_image',
		'settings'  => 'decree_theme_options[featured_image_size]',
		'type'	  	=> 'select',
) );

$wp_customize->add_setting( 'decree_theme_options[featured_header_image_alt]', array(
	'default'			=> $defaults['featured_header_image_alt'],
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'decree_theme_options[featured_header_image_alt]', array(
		'label'		=> esc_html__( 'Featured Header Image Alt/Title Tag ', 'decree' ),
		'section'   => 'header_image',
        'settings'  => 'decree_theme_options[featured_header_image_alt]',
        'type'	  	=> 'text',
) );

$wp_customize->add_setting( 'decree_theme_options[featured_header_image_url]', array(
	'default'			=> $defaults['featured_header_image_url'],
	'sanitize_callback' => 'esc_url_raw',
) );

$wp_customize->add_control( 'decree_theme_options[featured_header_image_url]', array(
		'label'		=> esc_html__( 'Featured Header Image Link URL', 'decree' ),
		'section'   => 'header_image',
        'settings'  => 'decree_theme_options[featured_header_image_url]',
        'type'	  	=> 'text',
) );

$wp_customize->add_setting( 'decree_theme_options[featured_header_image_base]', array(
	'default'	=> $defaults['featured_header_image_url'],
	'sanitize_callback' => 'decree_sanitize_checkbox',
) );

$wp_customize->add_control( 'decree_theme_options[featured_header_image_base]', array(
	'label'    	=> esc_html__( 'Check to Open Link in New Window/Tab', 'decree' ),
	'section'  	=> 'header_image',
	'settings' 	=> 'decree_theme_options[featured_header_image_base]',
	'type'     	=> 'checkbox',
) );
// Header Options End
