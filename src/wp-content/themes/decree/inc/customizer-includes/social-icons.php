<?php
/**
* The template for Social Links in Customizer
*
* @package Decree
*/

// Social Icons
$wp_customize->add_section( 'decree_social_links', array(
	'panel'    => 'decree_theme_options',
	'priority' => 700,
	'title'    => esc_html__( 'Social Links', 'decree' ),
) );

$decree_social_icons = decree_get_social_icons_list();

foreach ( $decree_social_icons as $key => $value ) {
	$description       = '';
	$sanitize_callback = 'esc_url_raw';

	if ( 'skype_link' === $key || 'handset_link' === $key || 'phone_link' === $key ) {
		// Skype, headset and phone links take plain text as input
		$sanitize_callback = 'sanitize_text_field';

		if ( 'skype_link' === $key ) {
			// Add skype description for user doc.
			$description       = esc_html__( 'Skype link can be of formats: callto://+{number} or skype:{username}?{action}. More Information in readme.txt file', 'decree' );
		}
	} elseif ( 'email_link' === $key ) {
		$sanitize_callback = 'sanitize_email';
	}

	$wp_customize->add_setting( 'decree_theme_options[' . $key . ']', array(
		'sanitize_callback' => $sanitize_callback,
		'description'       => $description,
	) );

	$wp_customize->add_control( 'decree_theme_options[' . $key . ']', array(

		'label'    		=> $value['label'],
		'section'  		=> 'decree_social_links',
		'settings' 		=> 'decree_theme_options[' . $key . ']',
	) );
} // End foreach().
// Social Icons End
