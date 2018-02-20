<?php
/**
 * The template for adding Our Professors Settings in Customizer
 *
 * @package Decree
 */

$wp_customize->add_section( 'decree_team', array(
	'panel'    => 'decree_theme_options',
	'title'    => esc_html__( 'Team', 'decree' ),
) );

$wp_customize->add_setting( 'decree_theme_options[team_option]', array(
	'default'			=> $defaults['team_option'],
	'sanitize_callback' => 'decree_sanitize_select',
) );

$wp_customize->add_control( 'decree_theme_options[team_option]', array(
	'choices'  => decree_section_visibility_options(),
	'label'    => esc_html__( 'Enable on', 'decree' ),
	'section'  => 'decree_team',
	'settings' => 'decree_theme_options[team_option]',
	'type'     => 'select',
) );

$wp_customize->add_setting( 'decree_theme_options[team_layout]', array(
	'default'			=> $defaults['team_layout'],
	'sanitize_callback' => 'decree_sanitize_select',
) );

$wp_customize->add_control( 'decree_theme_options[team_layout]', array(
	'active_callback' => 'decree_is_team_active',
	'choices'         => decree_featured_content_layout_options(),
	'label'           => esc_html__( 'Select Layout', 'decree' ),
	'section'         => 'decree_team',
	'settings'        => 'decree_theme_options[team_layout]',
	'type'            => 'select',
) );

$wp_customize->add_setting( 'decree_theme_options[team_position]', array(
	'default'			=> $defaults['team_position'],
	'sanitize_callback' => 'decree_sanitize_checkbox'
) );

$wp_customize->add_control( 'decree_theme_options[team_position]', array(
	'active_callback' => 'decree_is_team_active',
	'label'           => esc_html__( 'Check to Move above Footer', 'decree' ),
	'section'         => 'decree_team',
	'settings'        => 'decree_theme_options[team_position]',
	'type'            => 'checkbox',
) );

$wp_customize->add_setting( 'decree_theme_options[team_headline]', array(
	'default'           => $defaults['team_headline'],
	'sanitize_callback' => 'wp_kses_post',
) );

$wp_customize->add_control( 'decree_theme_options[team_headline]' , array(
	'active_callback' => 'decree_is_team_active',
	'description'     => esc_html__( 'Leave field empty to remove', 'decree' ),
	'label'           => esc_html__( 'Headline', 'decree' ),
	'section'         => 'decree_team',
	'settings'        => 'decree_theme_options[team_headline]',
	'type'            => 'text',
	)
);

$wp_customize->add_setting( 'decree_theme_options[team_subheadline]', array(
	'default'           => $defaults['team_subheadline'],
	'sanitize_callback' => 'wp_kses_post',
) );

$wp_customize->add_control( 'decree_theme_options[team_subheadline]' , array(
	'active_callback' => 'decree_is_team_active',
	'description'     => esc_html__( 'Leave field empty to remove', 'decree' ),
	'label'           => esc_html__( 'Sub-headline', 'decree' ),
	'section'         => 'decree_team',
	'settings'        => 'decree_theme_options[team_subheadline]',
	'type'            => 'text',
	)
);

$wp_customize->add_setting( 'decree_theme_options[team_number]', array(
	'default'           => $defaults['team_number'],
	'sanitize_callback' => 'decree_sanitize_number_range',
) );

$wp_customize->add_control( 'decree_theme_options[team_number]' , array(
	'active_callback' => 'decree_is_team_active',
	'description'     => esc_html__( 'Save and refresh the page if No. of items', 'decree' ),
	'input_attrs'     => array(
		'style' => 'width: 45px;',
		'min'   => 0,
	),
	'label'           => esc_html__( 'No of items', 'decree' ),
	'section'         => 'decree_team',
	'settings'        => 'decree_theme_options[team_number]',
	'type'            => 'number',
	)
);

$wp_customize->add_setting( 'decree_theme_options[team_enable_title]', array(
	'default'           => $defaults['team_enable_title'],
	'sanitize_callback' => 'decree_sanitize_checkbox',
) );

$wp_customize->add_control(  'decree_theme_options[team_enable_title]', array(
	'active_callback' => 'decree_is_team_active',
	'label'           => esc_html__( 'Check to Enable Title', 'decree' ),
	'section'         => 'decree_team',
	'settings'        => 'decree_theme_options[team_enable_title]',
	'type'            => 'checkbox',
) );

$wp_customize->add_setting( 'decree_theme_options[team_show]', array(
	'default'           => $defaults['team_show'],
	'sanitize_callback' => 'decree_sanitize_select',
) );

$wp_customize->add_control( 'decree_theme_options[team_show]', array(
	'active_callback' => 'decree_is_team_active',
	'choices'         => decree_featured_content_show(),
	'label'           => esc_html__( 'Display Content', 'decree' ),
	'section'         => 'decree_team',
	'settings'        => 'decree_theme_options[team_show]',
	'type'            => 'select',
) );

for ( $i = 1; $i <= $options['team_number'] ; $i++ ) {
	$wp_customize->add_setting( 'decree_theme_options[team_page_' . $i . ']', array(
			'sanitize_callback'	=> 'decree_sanitize_page',
	) );

	$wp_customize->add_control( 'decree_team_page_' . $i, array(
		'active_callback'	=> 'decree_is_team_active',
		'label'    	=> esc_html__( 'Featured Page', 'decree' ) . ' ' . $i,
		'section'  	=> 'decree_team',
		'settings' 	=> 'decree_theme_options[team_page_' . $i . ']',
		'type'	   	=> 'dropdown-pages',
	) );
}
