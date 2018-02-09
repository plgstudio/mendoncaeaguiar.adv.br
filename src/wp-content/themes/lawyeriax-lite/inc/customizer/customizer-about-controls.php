<?php
/**
 * Customizer About Us Section Controls.
 *
 * @package Lawyeriax
 */

/**
 * Hook About Us Section controls to customizer.
 *
 * @param object $wp_customize The wp_customize object.
 */
function lawyeriax_about_customize_register( $wp_customize ) {

	$wp_customize->add_section( 'lawyeriax_about_section', array(
		'title'       => esc_html__( 'About us Section', 'lawyeriax-lite' ),
		'description' => esc_html__( 'About us section settings', 'lawyeriax-lite' ),
		'priority'    => lawyeriax_get_section_priority( 40, 'lawyeriax_about_section' ),
	) );

	/*
	=============================================================================
		About us Photo
	=============================================================================
	*/

	$wp_customize->add_setting( 'lawyeria_about_image', array(
		'default'           => get_template_directory_uri() . '/images/about-us.jpg',
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'lawyeria_about_image', array(
		'label'    => esc_html__( 'Section image', 'lawyeriax-lite' ),
		'section'  => 'lawyeriax_about_section',
		'priority' => 2,
	) ) );

	/*
	=============================================================================
		About us heading
	=============================================================================
	*/

	$wp_customize->add_setting( 'lawyeriax_about_heading', array(
		'default'           => esc_html__( 'Choose the color that suits you for the following: Menu, Header, Footer and Frontpage boxes.', 'lawyeriax-lite' ),
		'sanitize_callback' => 'lawyeriax_sanitize_text',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'lawyeriax_about_heading', array(
		'label'    => esc_html__( 'Heading', 'lawyeriax-lite' ),
		'section'  => 'lawyeriax_about_section',
		'priority' => 3,
	) );

	/*
	=============================================================================
		About us text
	=============================================================================
	*/

	$wp_customize->add_setting( 'lawyeriax_about_text', array(
		'default'           => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Expressa vero in iis aetatibus, quae iam confirmatae sunt. Nihil opus est exemplis hoc facere longius. Restincta enim sitis stabilitatem voluptatis habet, inquit, illa autem voluptas ipsius restinctionis in motu est. Sed tu, ut dignum est tua erga me et philosophiam voluntate ab adolescentulo suscepta, fac ut Metrodori tueare liberos. Vitae autem degendae ratio maxime quidem illis placuit quieta. Quae si potest singula consolando levare, universa quo modo sustinebit? Ita fit beatae vitae domina fortuna, quam Epicurus ait exiguam intervenire sapienti. Duo Reges: constructio interrete. Epicurus ait exiguam intervenire sapienti. Duo Reges: constructio interrete.', 'lawyeriax-lite' ),
		'sanitize_callback' => 'lawyeriax_sanitize_text',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'lawyeriax_about_text', array(
		'label'    => esc_html__( 'Main Content', 'lawyeriax-lite' ),
		'section'  => 'lawyeriax_about_section',
		'type'     => 'textarea',
		'priority' => 4,
	) );

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'lawyeriax_about_text', array(
			'selector'        => '.about-content',
			'settings'        => 'lawyeriax_about_text',
			'render_callback' => 'lawyeriax_about_text_selective_refresh_callback',
		) );
	}

	/**
	 * Callback function used for selective refresh for the text in the About section
	 */
	function lawyeriax_about_text_selective_refresh_callback() {
		return get_theme_mod( 'lawyeriax_about_text' );
	}
}

add_action( 'customize_register', 'lawyeriax_about_customize_register' );
