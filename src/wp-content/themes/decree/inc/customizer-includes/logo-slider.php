<?php
/**
 * The template for adding Logo Slider Options in Customizer
 *
 * @package Decree
 */

//Logo Slider
$wp_customize->add_section( 'decree_logo_slider', array(
	'panel' => 'decree_theme_options',
	'title' => esc_html__( 'Logo Slider', 'decree' ),
) );

$wp_customize->add_setting( 'decree_theme_options[logo_slider_option]', array(
	'default'			=> $defaults['logo_slider_option'],
	'sanitize_callback' => 'decree_sanitize_select',
) );

$wp_customize->add_control( 'decree_theme_options[logo_slider_option]', array(
	'choices'  => decree_section_visibility_options(),
	'label'    => esc_html__( 'Enable on', 'decree' ),
	'section'  => 'decree_logo_slider',
	'settings' => 'decree_theme_options[logo_slider_option]',
	'type'     => 'select',
) );

$wp_customize->add_setting( 'decree_theme_options[logo_slider_bg_image]', array(
	'default'			=> $defaults['logo_slider_bg_image'],
	'sanitize_callback' => 'decree_sanitize_image',
) );

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'decree_theme_options[logo_slider_bg_image]', array(
	'active_callback' => 'decree_is_logo_slider_active',
	'label'           => esc_html__( 'Background Image', 'decree' ),
	'section'         => 'decree_logo_slider',
	'settings'        => 'decree_theme_options[logo_slider_bg_image]',
) ) );

$wp_customize->add_setting( 'decree_theme_options[logo_slider_transition_delay]', array(
	'default'			=> $defaults['logo_slider_transition_delay'],
	'sanitize_callback'	=> 'decree_sanitize_number_range',
) );

$wp_customize->add_control( 'decree_theme_options[logo_slider_transition_delay]' , array(
	'active_callback' => 'decree_is_logo_slider_active',
	'description'     => esc_html__( 'seconds(s)', 'decree' ),
	'input_attrs'     => array(
		'style' => 'width: 100px;',
		'min'   => 0,
		),
	'label'           => esc_html__( 'Transition Delay', 'decree' ),
	'section'         => 'decree_logo_slider',
	'settings'        => 'decree_theme_options[logo_slider_transition_delay]',
) );

$wp_customize->add_setting( 'decree_theme_options[logo_slider_transition_length]', array(
	'default'			=> $defaults['logo_slider_transition_length'],
	'sanitize_callback'	=> 'decree_sanitize_number_range',
) );

$wp_customize->add_control( 'decree_theme_options[logo_slider_transition_length]' , array(
		'active_callback' => 'decree_is_logo_slider_active',
		'description'     => esc_html__( 'seconds(s)', 'decree' ),
		'input_attrs'     => array(
			'style' => 'width: 100px;',
			'min'   => 0,
		),
		'label'           => esc_html__( 'Transition Length', 'decree' ),
		'section'         => 'decree_logo_slider',
		'settings'        => 'decree_theme_options[logo_slider_transition_length]',
	)
);

$wp_customize->add_setting( 'decree_theme_options[logo_slider_title]', array(
	'default'			=> $defaults['logo_slider_title'],
	'sanitize_callback'	=> 'wp_kses_post',
) );

$wp_customize->add_control( 'decree_theme_options[logo_slider_title]' , array(
	'active_callback' => 'decree_is_logo_slider_active',
	'label'           => esc_html__( 'Title', 'decree' ),
	'section'         => 'decree_logo_slider',
	'settings'        => 'decree_theme_options[logo_slider_title]',
) );

$wp_customize->add_setting( 'decree_theme_options[logo_slider_description]', array(
	'default'			=> $defaults['logo_slider_description'],
	'sanitize_callback'	=> 'wp_kses_post',
) );

$wp_customize->add_control( 'decree_theme_options[logo_slider_description]' , array(
	'active_callback' => 'decree_is_logo_slider_active',
	'label'           => esc_html__( 'Description', 'decree' ),
	'section'         => 'decree_logo_slider',
	'settings'        => 'decree_theme_options[logo_slider_description]',
	'type'            => 'textarea',
) );

$wp_customize->add_setting( 'decree_theme_options[logo_slider_number]', array(
	'default'			=> $defaults['logo_slider_number'],
	'sanitize_callback'	=> 'decree_sanitize_number_range',
) );

$wp_customize->add_control( 'decree_theme_options[logo_slider_number]' , array(
	'active_callback' => 'decree_is_logo_slider_active',
	'description'     => esc_html__( 'Save and refresh the page if No. of Slides is changed', 'decree' ),
	'input_attrs'     => array(
		'style' => 'width: 45px;',
		'min'   => 0,
	),
	'label'           => esc_html__( 'No of Items', 'decree' ),
	'section'         => 'decree_logo_slider',
	'settings'        => 'decree_theme_options[logo_slider_number]',
	'type'            => 'number',
	)
);

$wp_customize->add_setting( 'decree_theme_options[logo_slider_visible_items]', array(
	'default'			=> $defaults['logo_slider_visible_items'],
	'sanitize_callback' => 'decree_sanitize_number_range',
) );

$wp_customize->add_control( 'decree_theme_options[logo_slider_visible_items]', array(
	'active_callback' => 'decree_is_logo_slider_active',
	'input_attrs'     => array(
	'style'           => 'width: 45px;',
		'min'  => 1,
		'max'  => 5,
		'step' => 1,
	),
	'label'           => esc_html__( 'No of visible items', 'decree' ),
	'section'         => 'decree_logo_slider',
	'settings'        => 'decree_theme_options[logo_slider_visible_items]',
	'type'            => 'number',
) );

//loop for featured post sliders
for ( $i = 1; $i <= $options['logo_slider_number'] ; $i++ ) {
	$wp_customize->add_setting( 'decree_theme_options[logo_slider_page_' . $i . ']', array(
			'sanitize_callback'	=> 'decree_sanitize_page',
	) );

	$wp_customize->add_control( 'decree_logo_slider_page_' . $i, array(
		'active_callback' => 'decree_is_logo_slider_active',
		'label'           => esc_html__( 'Page', 'decree' ) . ' ' . $i,
		'section'         => 'decree_logo_slider',
		'settings'        => 'decree_theme_options[logo_slider_page_' . $i . ']',
		'type'            => 'dropdown-pages',
	) );
}
// Logo Slider End
