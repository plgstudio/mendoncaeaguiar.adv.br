<?php
/**
 * The template for adding Portfolio in Customizer
 *
 * @package Decree
 */

$wp_customize->add_section( 'decree_portfolio', array(
	'panel' => 'decree_theme_options',
	'title' => esc_html__( 'Portfolio', 'decree' ),
) );

$wp_customize->add_setting( 'decree_theme_options[portfolio_option]', array(
	'default'			=> $defaults['portfolio_option'],
	'sanitize_callback' => 'decree_sanitize_select',
) );

$wp_customize->add_control( 'decree_theme_options[portfolio_option]', array(
	'choices'  	=> decree_section_visibility_options(),
	'label'    	=> esc_html__( 'Enable Portfolio on', 'decree' ),
	'priority'	=> '1',
	'section'  	=> 'decree_portfolio',
	'settings' 	=> 'decree_theme_options[portfolio_option]',
	'type'	  	=> 'select',
) );

$wp_customize->add_setting( 'decree_theme_options[portfolio_layout]', array(
	'default'			=> $defaults['portfolio_layout'],
	'sanitize_callback' => 'decree_sanitize_select',
) );

$wp_customize->add_control( 'decree_theme_options[portfolio_layout]', array(
	'active_callback' => 'decree_is_portfolio_active',
	'choices'         => decree_featured_content_layout_options(),
	'label'           => esc_html__( 'Select Featured Content Layout', 'decree' ),
	'section'         => 'decree_portfolio',
	'settings'        => 'decree_theme_options[portfolio_layout]',
	'type'            => 'select',
) );

$wp_customize->add_setting( 'decree_theme_options[portfolio_headline]', array(
	'sanitize_callback'	=> 'wp_kses_post',
) );

$wp_customize->add_control( 'decree_theme_options[portfolio_headline]' , array(
	'active_callback' => 'decree_is_portfolio_active',
	'description'     => esc_html__( 'Leave field empty to remove', 'decree' ),
	'label'           => esc_html__( 'Headline for Portfolio', 'decree' ),
	'priority'        => '4',
	'section'         => 'decree_portfolio',
	'settings'        => 'decree_theme_options[portfolio_headline]',
	'type'            => 'text',
	)
);

$wp_customize->add_setting( 'decree_theme_options[portfolio_subheadline]', array(
	'sanitize_callback'	=> 'wp_kses_post',
) );

$wp_customize->add_control( 'decree_theme_options[portfolio_subheadline]' , array(
	'active_callback' => 'decree_is_portfolio_active',
	'description'     => esc_html__( 'Leave field empty to remove', 'decree' ),
	'label'           => esc_html__( 'Sub-headline for Portfolio', 'decree' ),
	'priority'        => '5',
	'section'         => 'decree_portfolio',
	'settings'        => 'decree_theme_options[portfolio_subheadline]',
	'type'            => 'text',
	)
);

$wp_customize->add_setting( 'decree_theme_options[portfolio_show]', array(
	'default'			=> $defaults['portfolio_show'],
	'sanitize_callback'	=> 'decree_sanitize_select',
) );

$wp_customize->add_control( 'decree_theme_options[portfolio_show]', array(
	'active_callback' => 'decree_is_portfolio_active',
	'choices'         => decree_featured_content_show(),
	'label'           => esc_html__( 'Display Content', 'decree' ),
	'section'         => 'decree_portfolio',
	'settings'        => 'decree_theme_options[portfolio_show]',
	'type'            => 'select',
) );

$wp_customize->add_setting( 'decree_theme_options[portfolio_number]', array(
	'default'			=> $defaults['portfolio_number'],
	'sanitize_callback'	=> 'decree_sanitize_number_range',
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'decree_theme_options[portfolio_number]' , array(
		'active_callback' => 'decree_is_portfolio_active',
		'description'     => esc_html__( 'Save and refresh the page if No. of Portfolio is changed', 'decree' ),
		'input_attrs'     => array(
			'style' => 'width: 45px;',
			'min'   => 1,
			'step'  => 1,
		),
		'label'           => esc_html__( 'No of Portfolio', 'decree' ),
		'priority'        => '6',
		'section'         => 'decree_portfolio',
		'settings'        => 'decree_theme_options[portfolio_number]',
		'type'            => 'number',
	)
);

$wp_customize->add_setting( 'decree_theme_options[portfolio_hide_date]', array(
	'sanitize_callback'	=> 'decree_sanitize_checkbox',
) );

$wp_customize->add_control(  'decree_theme_options[portfolio_hide_date]', array(
	'active_callback' => 'decree_is_portfolio_active',
	'label'           => esc_html__( 'Check to Hide Posted On Date', 'decree' ),
	'section'         => 'decree_portfolio',
	'settings'        => 'decree_theme_options[portfolio_hide_date]',
	'type'            => 'checkbox',
) );

if ( is_multi_author() ) {
	$wp_customize->add_setting( 'decree_theme_options[portfolio_hide_author]', array(
			'sanitize_callback'	=> 'decree_sanitize_checkbox',
	) );

	$wp_customize->add_control(  'decree_theme_options[portfolio_hide_author]', array(
		'active_callback' => 'decree_is_portfolio_active',
		'label'           => esc_html__( 'Check to Hide Author Meta', 'decree' ),
		'section'         => 'decree_portfolio',
		'settings'        => 'decree_theme_options[portfolio_hide_author]',
		'type'            => 'checkbox',
	) );
}


//loop for content types
for ( $i = 1; $i <= $options['portfolio_number'] ; $i++ ) {
	//Page Content
	$wp_customize->add_setting( 'decree_theme_options[portfolio_page_' . $i . ']', array(
			'sanitize_callback'	=> 'decree_sanitize_page',
	) );

	$wp_customize->add_control( 'decree_theme_options[portfolio_page_' . $i . ']', array(
		'active_callback' => 'decree_is_portfolio_active',
		'label'           => esc_html__( 'Page', 'decree' ) . ' ' . $i,
		'section'         => 'decree_portfolio',
		'settings'        => 'decree_theme_options[portfolio_page_' . $i . ']',
		'type'            => 'dropdown-pages',
	) );
}
