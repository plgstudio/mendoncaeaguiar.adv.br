<?php
/**
 * The template for adding Testimonial Settings in Customizer
 *
 * @package Decree
 */

$wp_customize->add_section( 'decree_testimonial', array(
	'panel'    => 'decree_theme_options',
	'title'    => esc_html__( 'Testimonial', 'decree' ),
) );

$wp_customize->add_setting( 'decree_theme_options[testimonial_option]', array(
	'default'			=> $defaults['testimonial_option'],
	'sanitize_callback' => 'decree_sanitize_select',
) );

$wp_customize->add_control( 'decree_theme_options[testimonial_option]', array(
	'choices'  => decree_section_visibility_options(),
	'label'    => esc_html__( 'Enable on', 'decree' ),
	'section'  => 'decree_testimonial',
	'settings' => 'decree_theme_options[testimonial_option]',
	'type'     => 'select',
) );

$wp_customize->add_setting( 'decree_theme_options[testimonial_layout]', array(
	'default'			=> $defaults['testimonial_layout'],
	'sanitize_callback' => 'decree_sanitize_select',
) );

$wp_customize->add_control( 'decree_theme_options[testimonial_layout]', array(
	'active_callback' => 'decree_is_testimonial_active',
	'choices'         => decree_testimonial_layout_options(),
	'label'           => esc_html__( 'Select Testimonial Layout', 'decree' ),
	'section'         => 'decree_testimonial',
	'settings'        => 'decree_theme_options[testimonial_layout]',
	'type'            => 'select',
) );

$wp_customize->add_setting( 'decree_theme_options[testimonial_position]', array(
	'default'			=> $defaults['testimonial_position'],
	'sanitize_callback' => 'decree_sanitize_checkbox',
) );

$wp_customize->add_control( 'decree_theme_options[testimonial_position]', array(
	'active_callback' => 'decree_is_testimonial_active',
	'label'           => esc_html__( 'Check to Move above Footer', 'decree' ),
	'section'         => 'decree_testimonial',
	'settings'        => 'decree_theme_options[testimonial_position]',
	'type'            => 'checkbox',
) );

$wp_customize->add_setting( 'decree_theme_options[testimonial_slider]', array(
	'default'           => $defaults['testimonial_slider'],
	'sanitize_callback' => 'decree_sanitize_checkbox',
) );

$wp_customize->add_control( 'decree_theme_options[testimonial_slider]', array(
	'active_callback' => 'decree_is_testimonial_active',
	'label'           => esc_html__( 'Check to Enable Slider', 'decree' ),
	'section'         => 'decree_testimonial',
	'settings'        => 'decree_theme_options[testimonial_slider]',
	'type'            => 'checkbox',
) );

$wp_customize->add_setting( 'decree_theme_options[testimonial_headline]', array(
	'default'           => $defaults['testimonial_headline'],
	'sanitize_callback' => 'wp_kses_post',
) );

$wp_customize->add_control( 'decree_theme_options[testimonial_headline]' , array(
	'active_callback' => 'decree_is_testimonial_active',
	'description'     => esc_html__( 'Leave field empty to remove', 'decree' ),
	'label'           => esc_html__( 'Headline for Testimonial', 'decree' ),
	'section'         => 'decree_testimonial',
	'settings'        => 'decree_theme_options[testimonial_headline]',
	'type'            => 'text',
	)
);

$wp_customize->add_setting( 'decree_theme_options[testimonial_subheadline]', array(
	'default'           => $defaults['testimonial_subheadline'],
	'sanitize_callback' => 'wp_kses_post',
) );

$wp_customize->add_control( 'decree_theme_options[testimonial_subheadline]' , array(
	'active_callback' => 'decree_is_testimonial_active',
	'description'     => esc_html__( 'Leave field empty to remove', 'decree' ),
	'label'           => esc_html__( 'Sub-headline for Testimonial', 'decree' ),
	'section'         => 'decree_testimonial',
	'settings'        => 'decree_theme_options[testimonial_subheadline]',
	'type'            => 'text',
	)
);

$wp_customize->add_setting( 'decree_theme_options[testimonial_number]', array(
	'default'           => $defaults['testimonial_number'],
	'sanitize_callback' => 'decree_sanitize_number_range',
) );

$wp_customize->add_control( 'decree_theme_options[testimonial_number]' , array(
		'active_callback' => 'decree_is_testimonial_active',
		'description'     => esc_html__( 'Save and refresh the page if No. of Testimonial is changed', 'decree' ),
		'input_attrs'     => array(
			'style' => 'width: 45px;',
			'min'   => 0,
		),
		'label'           => esc_html__( 'No of Testimonial', 'decree' ),
		'section'         => 'decree_testimonial',
		'settings'        => 'decree_theme_options[testimonial_number]',
		'type'            => 'number',
	)
);

$wp_customize->add_setting( 'decree_theme_options[testimonial_enable_title]', array(
	'default'           => $defaults['testimonial_enable_title'],
	'sanitize_callback' => 'decree_sanitize_checkbox',
) );

$wp_customize->add_control(  'decree_theme_options[testimonial_enable_title]', array(
	'active_callback' => 'decree_is_testimonial_active',
	'label'           => esc_html__( 'Check to Enable Title', 'decree' ),
	'section'         => 'decree_testimonial',
	'settings'        => 'decree_theme_options[testimonial_enable_title]',
	'type'            => 'checkbox',
) );

$wp_customize->add_setting( 'decree_theme_options[testimonial_show]', array(
	'default'           => $defaults['testimonial_show'],
	'sanitize_callback' => 'decree_sanitize_select',
) );

$wp_customize->add_control( 'decree_theme_options[testimonial_show]', array(
	'active_callback' => 'decree_is_testimonial_active',
	'choices'         => decree_testimonial_content_show(),
	'label'           => esc_html__( 'Display Content', 'decree' ),
	'section'         => 'decree_testimonial',
	'settings'        => 'decree_theme_options[testimonial_show]',
	'type'            => 'select',
) );

for ( $i = 1; $i <= $options['testimonial_number'] ; $i++ ) {
	$wp_customize->add_setting( 'decree_theme_options[testimonial_page_' . $i . ']', array(
			'sanitize_callback'	=> 'decree_sanitize_page',
	) );

	$wp_customize->add_control( 'decree_testimonial_page_' . $i, array(
		'active_callback' => 'decree_is_testimonial_active',
		'label'           => esc_html__( 'Page', 'decree' ) . ' ' . $i,
		'section'         => 'decree_testimonial',
		'settings'        => 'decree_theme_options[testimonial_page_' . $i . ']',
		'type'            => 'dropdown-pages',
	) );
} // End for().
