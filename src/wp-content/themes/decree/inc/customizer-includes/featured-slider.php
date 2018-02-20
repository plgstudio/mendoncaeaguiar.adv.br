<?php
/**
* The template for adding Featured Slider Options in Customizer
*
* @package Decree
*/

$wp_customize->add_section( 'decree_featured_slider', array(
	'panel' => 'decree_theme_options',
	'title' => esc_html__( 'Featured Slider', 'decree' ),
) );

$wp_customize->add_setting( 'decree_theme_options[featured_slider_option]', array(
	'default'			=> $defaults['featured_slider_option'],
	'sanitize_callback' => 'decree_sanitize_select',
) );

$wp_customize->add_control( 'decree_theme_options[featured_slider_option]', array(
	'choices'  => decree_section_visibility_options(),
	'label'    => esc_html__( 'Enable on', 'decree' ),
	'priority' => '2',
	'section'  => 'decree_featured_slider',
	'settings' => 'decree_theme_options[featured_slider_option]',
	'type'     => 'select',
) );

$wp_customize->add_setting( 'decree_theme_options[featured_slider_transition_effect]', array(
	'default'			=> $defaults['featured_slider_transition_effect'],
	'sanitize_callback'	=> 'decree_sanitize_select',
) );

$wp_customize->add_control( 'decree_theme_options[featured_slider_transition_effect]' , array(
	'active_callback' => 'decree_is_slider_active',
	'choices'         => decree_featured_slider_transition_effects(),
	'label'           => esc_html__( 'Transition Effect', 'decree' ),
	'priority'        => '3',
	'section'         => 'decree_featured_slider',
	'settings'        => 'decree_theme_options[featured_slider_transition_effect]',
	'type'            => 'select',
	)
);

$wp_customize->add_setting( 'decree_theme_options[featured_slider_transition_delay]', array(
	'default'			=> $defaults['featured_slider_transition_delay'],
	'sanitize_callback'	=> 'absint',
) );

$wp_customize->add_control( 'decree_theme_options[featured_slider_transition_delay]' , array(
	'active_callback'	=> 'decree_is_slider_active',
	'description'	=> esc_html__( 'seconds(s)', 'decree' ),
	'input_attrs' => array(
		'style' => 'width: 40px;',
	),
	'label'    		=> esc_html__( 'Transition Delay', 'decree' ),
	'priority'		=> '4',
	'section'  		=> 'decree_featured_slider',
	'settings' 		=> 'decree_theme_options[featured_slider_transition_delay]',
	)
);

$wp_customize->add_setting( 'decree_theme_options[featured_slider_transition_length]', array(
	'default'			=> $defaults['featured_slider_transition_length'],
	'sanitize_callback'	=> 'absint',
) );

$wp_customize->add_control( 'decree_theme_options[featured_slider_transition_length]' , array(
	'active_callback'	=> 'decree_is_slider_active',
	'description'	=> esc_html__( 'seconds(s)', 'decree' ),
	'input_attrs' => array(
		'style' => 'width: 40px;',
	),
	'label'    		=> esc_html__( 'Transition Length', 'decree' ),
	'priority'		=> '5',
	'section'  		=> 'decree_featured_slider',
	'settings' 		=> 'decree_theme_options[featured_slider_transition_length]',
	)
);

$wp_customize->add_setting( 'decree_theme_options[featured_slider_image_loader]', array(
	'default'			=> $defaults['featured_slider_image_loader'],
	'sanitize_callback' => 'decree_sanitize_select',
) );

$wp_customize->add_control( 'decree_theme_options[featured_slider_image_loader]', array(
	'active_callback' => 'decree_is_slider_active',
	'choices'         => decree_featured_slider_image_loader(),
	'label'           => esc_html__( 'Image Loader', 'decree' ),
	'priority'        => '6',
	'section'         => 'decree_featured_slider',
	'settings'        => 'decree_theme_options[featured_slider_image_loader]',
	'type'            => 'select',
) );


$wp_customize->add_setting( 'decree_theme_options[featured_slider_number]', array(
	'default'			=> $defaults['featured_slider_number'],
	'sanitize_callback'	=> 'decree_sanitize_number_range',
) );

$wp_customize->add_control( 'decree_theme_options[featured_slider_number]' , array(
		'active_callback'	=> 'decree_is_slider_active',
		'description'	=> esc_html__( 'Save and refresh the page if No. of Slides is changed', 'decree' ),
		'input_attrs' 	=> array(
			'style' => 'width: 45px;',
			'min'   => 1,
			'step'  => 1,
			),
		'label'    		=> esc_html__( 'No of Slides', 'decree' ),
		'priority'		=> '8',
		'section'  		=> 'decree_featured_slider',
		'settings' 		=> 'decree_theme_options[featured_slider_number]',
		'type'	   		=> 'number',
		'transport'		=> 'postMessage',
	)
);

//loop for featured page sliders
for ( $i = 1; $i <= $options['featured_slider_number'] ; $i++ ) {
	$wp_customize->add_setting( 'decree_theme_options[featured_slider_page_' . $i . ']', array(
			'sanitize_callback'	=> 'decree_sanitize_page',
	) );

	$wp_customize->add_control( 'decree_theme_options[featured_slider_page_' . $i . ']', array(
		'active_callback'	=> 'decree_is_slider_active',
		'label'    	=> esc_html__( 'Featured Page', 'decree' ) . ' # ' . $i,
		'priority'	=> '11' . $i,
		'section'  	=> 'decree_featured_slider',
		'settings' 	=> 'decree_theme_options[featured_slider_page_' . $i . ']',
		'type'	   	=> 'dropdown-pages',
	) );
}
// Featured Slider End
