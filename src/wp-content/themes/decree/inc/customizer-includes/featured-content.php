<?php
/**
* The template for adding Featured Content Settings in Customizer
*
* @package Decree
*/

$wp_customize->add_section( 'decree_featured_content', array(
	'panel'    => 'decree_theme_options',
	'title'    => esc_html__( 'Featured Content', 'decree' ),
) );

$wp_customize->add_setting( 'decree_theme_options[featured_content_option]', array(
	'default'			=> $defaults['featured_content_option'],
	'sanitize_callback' => 'decree_sanitize_select',
) );

$wp_customize->add_control( 'decree_theme_options[featured_content_option]', array(
	'choices'  	=> decree_section_visibility_options(),
	'label'    	=> esc_html__( 'Enable on', 'decree' ),
	'section'  	=> 'decree_featured_content',
	'settings' 	=> 'decree_theme_options[featured_content_option]',
	'type'	  	=> 'select',
) );

$wp_customize->add_setting( 'decree_theme_options[featured_content_bg_image]', array(
	'default'			=> $defaults['featured_content_bg_image'],
	'sanitize_callback' => 'decree_sanitize_image',
) );

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'decree_theme_options[featured_content_bg_image]', array(
	'active_callback' => 'decree_is_featured_content_active',
	'label'           => esc_html__( 'Background Image', 'decree' ),
	'section'         => 'decree_featured_content',
	'settings'        => 'decree_theme_options[featured_content_bg_image]',
) ) );

$wp_customize->add_setting( 'decree_theme_options[featured_content_layout]', array(
	'default'			=> $defaults['featured_content_layout'],
	'sanitize_callback' => 'decree_sanitize_select',
) );

$wp_customize->add_control( 'decree_theme_options[featured_content_layout]', array(
	'active_callback' => 'decree_is_featured_content_active',
	'choices'         => decree_featured_content_layout_options(),
	'label'           => esc_html__( 'Select Featured Content Layout', 'decree' ),
	'section'         => 'decree_featured_content',
	'settings'        => 'decree_theme_options[featured_content_layout]',
	'type'            => 'select',
) );

$wp_customize->add_setting( 'decree_theme_options[featured_content_position]', array(
	'default'			=> $defaults['featured_content_position'],
	'sanitize_callback' => 'decree_sanitize_checkbox',
) );

$wp_customize->add_control( 'decree_theme_options[featured_content_position]', array(
	'active_callback' => 'decree_is_featured_content_active',
	'label'           => esc_html__( 'Check to Move above Footer', 'decree' ),
	'section'         => 'decree_featured_content',
	'settings'        => 'decree_theme_options[featured_content_position]',
	'type'            => 'checkbox',
) );

$wp_customize->add_setting( 'decree_theme_options[featured_content_headline]', array(
	'default'			=> $defaults['featured_content_headline'],
	'sanitize_callback'	=> 'wp_kses_post',
) );

$wp_customize->add_control( 'decree_theme_options[featured_content_headline]' , array(
	'active_callback'	=> 'decree_is_featured_content_active',
	'description'	=> esc_html__( 'Leave field empty to remove', 'decree' ),
	'label'    		=> esc_html__( 'Headline for Featured Content', 'decree' ),
	'section'  		=> 'decree_featured_content',
	'settings' 		=> 'decree_theme_options[featured_content_headline]',
	'type'	   		=> 'text',
	)
);

$wp_customize->add_setting( 'decree_theme_options[featured_content_subheadline]', array(
	'default'			=> $defaults['featured_content_subheadline'],
	'sanitize_callback'	=> 'wp_kses_post',
) );

$wp_customize->add_control( 'decree_theme_options[featured_content_subheadline]' , array(
	'active_callback'	=> 'decree_is_featured_content_active',
	'description'	=> esc_html__( 'Leave field empty to remove', 'decree' ),
	'label'    		=> esc_html__( 'Sub-headline for Featured Content', 'decree' ),
	'section'  		=> 'decree_featured_content',
	'settings' 		=> 'decree_theme_options[featured_content_subheadline]',
	'type'	   		=> 'text',
	)
);

$wp_customize->add_setting( 'decree_theme_options[featured_content_number]', array(
	'default'			=> $defaults['featured_content_number'],
	'sanitize_callback'	=> 'decree_sanitize_number_range',
) );

$wp_customize->add_control( 'decree_theme_options[featured_content_number]' , array(
		'active_callback' => 'decree_is_featured_content_active',
		'description'     => esc_html__( 'Save and refresh the page if No. of Featured Content is changed', 'decree' ),
		'input_attrs'     => array(
			'style' => 'width: 100px;',
			'min'   => 1,
			'step'  => 1,
		),
		'label'           => esc_html__( 'No of Featured Content', 'decree' ),
		'section'         => 'decree_featured_content',
		'settings'        => 'decree_theme_options[featured_content_number]',
		'type'            => 'number',
		'transport'       => 'postMessage',
	)
);

$wp_customize->add_setting( 'decree_theme_options[featured_content_show]', array(
	'default'			=> $defaults['featured_content_show'],
	'sanitize_callback'	=> 'decree_sanitize_select',
) );

$wp_customize->add_control( 'decree_theme_options[featured_content_show]', array(
	'active_callback' => 'decree_is_featured_content_active',
	'choices'         => decree_featured_content_show(),
	'label'           => esc_html__( 'Display Content', 'decree' ),
	'section'         => 'decree_featured_content',
	'settings'        => 'decree_theme_options[featured_content_show]',
	'type'            => 'select',
) );


//loop for featured post content
for ( $i = 1; $i <= $options['featured_content_number'] ; $i++ ) {
	$wp_customize->add_setting( 'decree_theme_options[featured_content_page_' . $i . ']', array(
			'sanitize_callback' => 'decree_sanitize_page',
	) );

	$wp_customize->add_control( 'decree_featured_content_page_' . $i . '', array(
		'active_callback' => 'decree_is_featured_content_active',
		'label'           => esc_html__( 'Featured Page', 'decree' ) . ' ' . $i,
		'section'         => 'decree_featured_content',
		'settings'        => 'decree_theme_options[featured_content_page_' . $i . ']',
		'type'            => 'dropdown-pages',
	) );
}
