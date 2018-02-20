<?php
/**
* The template for adding additional theme options in Customizer
*
* @package Decree
*/

$wp_customize->add_section( 'decree_promotion_headline', array(
	'panel' => 'decree_theme_options',
	'title' => esc_html__( 'Promotion Headline', 'decree' ),
) );

$wp_customize->add_setting( 'decree_theme_options[promo_head_option]', array(
	'default'			=> $defaults['promo_head_option'],
	'sanitize_callback' => 'decree_sanitize_select',
) );

$wp_customize->add_control( 'decree_theme_options[promo_head_option]', array(
	'choices'  	=> decree_section_visibility_options(),
	'label'    	=> esc_html__( 'Enable on', 'decree' ),
	'section'  	=> 'decree_promotion_headline',
	'type'	  	=> 'select',
) );

$wp_customize->add_setting( 'decree_theme_options[promotion_headline_bg_image]', array(
	'default'			=> $defaults['promotion_headline_bg_image'],
	'sanitize_callback' => 'decree_sanitize_image',
) );

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'decree_theme_options[promotion_headline_bg_image]', array(
	'active_callback' => 'decree_is_promo_head_active',
	'label'           => esc_html__( 'Background Image', 'decree' ),
	'section'         => 'decree_promotion_headline',
	'settings'        => 'decree_theme_options[promotion_headline_bg_image]',
) ) );

$wp_customize->add_setting( 'decree_theme_options[promo_head_show]', array(
	'default'			=> $defaults['promo_head_show'],
	'sanitize_callback' => 'decree_sanitize_select',
) );

$wp_customize->add_control( 'decree_theme_options[promo_head_show]', array(
	'active_callback' => 'decree_is_promo_head_active',
	'choices'         => decree_featured_content_show(),
	'label'           => esc_html__( 'Display Content', 'decree' ),
	'section'         => 'decree_promotion_headline',
	'type'            => 'select',
) );

//page content
$wp_customize->add_setting( 'decree_theme_options[promo_head_page]', array(
	'sanitize_callback'	=> 'decree_sanitize_page',
) );

$wp_customize->add_control( 'decree_theme_options[promo_head_page]', array(
	'active_callback' => 'decree_is_promo_head_active',
	'label'           => esc_html__( 'Select Page', 'decree' ),
	'section'         => 'decree_promotion_headline',
	'type'            => 'dropdown-pages',
) );
