<?php
/**
* The template for adding additional theme options in Customizer
*
* @package Decree
*/

$wp_customize->add_panel( 'decree_theme_options', array(
	'description' => esc_html__( 'Basic theme Options', 'decree' ),
	'priority'    => 200,
	'title'       => esc_html__( 'Theme Options', 'decree' ),
) );

// Breadcrumb Option
$wp_customize->add_section( 'decree_breadcrumb_options', array(
	'description' => esc_html__( 'Breadcrumbs are a great way of letting your visitors find out where they are on your site with just a glance. You can enable/disable them on homepage and entire site.', 'decree' ),
	'panel'       => 'decree_theme_options',
	'title'       => esc_html__( 'Breadcrumb Options', 'decree' ),
	'priority'    => 201,
) );

$wp_customize->add_setting( 'decree_theme_options[breadcrumb_option]', array(
	'default'			=> $defaults['breadcrumb_option'],
	'sanitize_callback' => 'decree_sanitize_checkbox',
) );

$wp_customize->add_control( 'decree_theme_options[breadcrumb_option]', array(
	'label'    => esc_html__( 'Check to enable Breadcrumb', 'decree' ),
	'section'  => 'decree_breadcrumb_options',
	'settings' => 'decree_theme_options[breadcrumb_option]',
	'type'     => 'checkbox',
) );

$wp_customize->add_setting( 'decree_theme_options[breadcrumb_on_homepage]', array(
	'default'			=> $defaults['breadcrumb_on_homepage'],
	'sanitize_callback' => 'decree_sanitize_checkbox',
) );

$wp_customize->add_control( 'decree_theme_options[breadcrumb_on_homepage]', array(
	'label'    => esc_html__( 'Check to enable Breadcrumb on Homepage', 'decree' ),
	'section'  => 'decree_breadcrumb_options',
	'settings' => 'decree_theme_options[breadcrumb_on_homepage]',
	'type'     => 'checkbox',
) );

$wp_customize->add_setting( 'decree_theme_options[breadcrumb_seperator]', array(
	'default'			=> $defaults['breadcrumb_seperator'],
	'sanitize_callback'	=> 'sanitize_text_field',
) );

$wp_customize->add_control( 'decree_theme_options[breadcrumb_seperator]', array(
	'input_attrs' => array(
			'style' => 'width: 40px;'
		),
	'label'    	=> esc_html__( 'Separator between Breadcrumbs', 'decree' ),
	'section' 	=> 'decree_breadcrumb_options',
	'settings' 	=> 'decree_theme_options[breadcrumb_seperator]',
	'type'     	=> 'text'
	)
);
// Breadcrumb Option End

// Excerpt Options
$wp_customize->add_section( 'decree_excerpt_options', array(
	'panel'  	=> 'decree_theme_options',
	'priority' 	=> 204,
	'title'    	=> esc_html__( 'Excerpt Options', 'decree' ),
) );

$wp_customize->add_setting( 'decree_theme_options[excerpt_length]', array(
	'default'			=> $defaults['excerpt_length'],
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_control( 'decree_theme_options[excerpt_length]', array(
	'description' => __('Excerpt length. Default is 30 words', 'decree'),
	'input_attrs' => array(
		'min'   => 10,
		'max'   => 200,
		'step'  => 5,
		'style' => 'width: 60px;'
		),
	'label'    => esc_html__( 'Excerpt Length (words)', 'decree' ),
	'section'  => 'decree_excerpt_options',
	'settings' => 'decree_theme_options[excerpt_length]',
	'type'	   => 'number',
	)
);

$wp_customize->add_setting( 'decree_theme_options[excerpt_more_text]', array(
	'default'			=> $defaults['excerpt_more_text'],
	'sanitize_callback'	=> 'sanitize_text_field',
) );

$wp_customize->add_control( 'decree_theme_options[excerpt_more_text]', array(
	'label'    => esc_html__( 'Read More Text', 'decree' ),
	'section'  => 'decree_excerpt_options',
	'settings' => 'decree_theme_options[excerpt_more_text]',
	'type'	   => 'text',
) );
// Excerpt Options End

// Header Right Sidebar Option
$wp_customize->add_section( 'decree_header_right', array(
	'panel'    => 'decree_theme_options',
	'priority' => 208,
	'title'    => esc_html__( 'Header Right Options', 'decree' ),
) );

$wp_customize->add_setting( 'decree_theme_options[header_right_call_text]', array(
	'default'           => $defaults['header_right_call_text'],
	'sanitize_callback' => 'wp_kses_post',
) );

$wp_customize->add_control( 'decree_theme_options[header_right_call_text]' , array(
		'description' => esc_html__( 'Leave field empty to remove', 'decree' ),
		'label'       => esc_html__( 'Call Text', 'decree' ),
		'section'     => 'decree_header_right',
		'settings'    => 'decree_theme_options[header_right_call_text]',
	)
);

$wp_customize->add_setting( 'decree_theme_options[header_right_call_number]', array(
	'default'			=> $defaults['header_right_call_number'],
	'sanitize_callback'	=> 'wp_kses_post',
) );

$wp_customize->add_control( 'decree_theme_options[header_right_call_number]' , array(
		'description' => esc_html__( 'Leave field empty to remove', 'decree' ),
		'label'       => esc_html__( 'Call Number', 'decree' ),
		'section'     => 'decree_header_right',
		'settings'    => 'decree_theme_options[header_right_call_number]',
	)
);

$wp_customize->add_setting( 'decree_theme_options[header_right_button_text]', array(
	'default'			=> $defaults['header_right_button_text'],
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'decree_theme_options[header_right_button_text]', array(
	'description' => esc_html__( 'Leave field empty to remove', 'decree' ),
	'label'       => esc_html__( 'Button Text', 'decree' ),
	'section'     => 'decree_header_right',
	'settings'    => 'decree_theme_options[header_right_button_text]',
) );

$wp_customize->add_setting( 'decree_theme_options[header_right_button_link]', array(
	'default'			=> $defaults['header_right_button_link'],
	'sanitize_callback' => 'esc_url_raw',
) );

$wp_customize->add_control( 'decree_theme_options[header_right_button_link]', array(
	'description' => esc_html__( 'Leave field empty to remove', 'decree' ),
	'label'       => esc_html__( 'Button Link', 'decree' ),
	'section'     => 'decree_header_right',
	'settings'    => 'decree_theme_options[header_right_button_link]',
) );

$wp_customize->add_setting( 'decree_theme_options[header_right_button_link_target]', array(
	'default'			=> $defaults['header_right_button_link_target'],
	'sanitize_callback' => 'decree_sanitize_checkbox',
) );

$wp_customize->add_control( 'decree_theme_options[header_right_button_link_target]', array(
	'label'    	=> esc_html__( 'Check to Open Link in New Window/Tab', 'decree' ),
	'section'     => 'decree_header_right',
	'settings'    => 'decree_theme_options[header_right_button_link_target]',
	'type'        => 'checkbox',
) );
// Header Right Sidebar Option End

// Header Top
$wp_customize->add_section( 'decree_header_top', array(
	'panel'			=> 'decree_theme_options',
	'description'	=> esc_html__( 'Header Top Options', 'decree' ),
	'priority' 		=> 208.5,
	'title'    		=> esc_html__( 'Header Top Options', 'decree' ),
) );

$wp_customize->add_setting( 'decree_theme_options[disable_date]', array(
	'default'			=> $defaults['disable_date'],
	'sanitize_callback' => 'decree_sanitize_checkbox',
) );

$wp_customize->add_control( 'decree_theme_options[disable_date]', array(
	'label'    => esc_html__( 'Check to disable date', 'decree' ),
	'section'  => 'decree_header_top',
	'settings' => 'decree_theme_options[disable_date]',
	'type'	   => 'checkbox',
) );
// Header Top End

// Homepage / Frontpage Options.
$wp_customize->add_section( 'decree_homepage_options', array(
	'panel'           => 'decree_theme_options',
	'priority'        => 209,
	'title'           => esc_html__( 'Homepage / Frontpage Options', 'decree' ),
) );

$wp_customize->add_setting( 'decree_theme_options[front_page_title]', array(
	'default'           => $defaults['front_page_title'],
	'sanitize_callback' => 'wp_kses_post',
) );

$wp_customize->add_control( 'decree_theme_options[front_page_title]' , array(
		'active_callback' => 'is_home',
		'description'     => esc_html__( 'Leave field empty to remove', 'decree' ),
		'label'           => esc_html__( 'Latest Posts Title', 'decree' ),
		'section'         => 'decree_homepage_options',
		'settings'        => 'decree_theme_options[front_page_title]',
	)
);

$wp_customize->add_setting( 'decree_theme_options[front_page_description]', array(
	'default'           => $defaults['front_page_description'],
	'sanitize_callback' => 'wp_kses_post',
) );

$wp_customize->add_control( 'decree_theme_options[front_page_description]' , array(
		'active_callback' => 'is_home',
		'description'     => esc_html__( 'Leave field empty to remove', 'decree' ),
		'label'           => esc_html__( 'Latest Posts Description', 'decree' ),
		'section'         => 'decree_homepage_options',
		'settings'        => 'decree_theme_options[front_page_description]',
	)
);

$wp_customize->add_setting( 'decree_theme_options[front_page_category]', array(
	'default'			=> $defaults['front_page_category'],
	'sanitize_callback'	=> 'decree_sanitize_category_list',
) );

$wp_customize->add_control( new decree_Customize_Dropdown_Categories_Control( $wp_customize, 'decree_theme_options[front_page_category]', array(
	'active_callback' => 'is_home',
	'description'     => esc_html__( 'Only posts that belong to the categories selected here will be displayed on the posts page', 'decree' ),
	'label'           => esc_html__( 'Select Categories', 'decree' ),
	'name'            => 'decree_theme_options[front_page_category]',
	'section'         => 'decree_homepage_options',
	'settings'        => 'decree_theme_options[front_page_category]',
	'type'            => 'dropdown-categories',
) ) );
// Homepage / Frontpage Settings End.

// Layout Options.
$wp_customize->add_section( 'decree_layout', array(
	'panel'    => 'decree_theme_options',
	'priority' => 211,
	'title'    => esc_html__( 'Layout Options', 'decree' ),
) );

$wp_customize->add_setting( 'decree_theme_options[theme_layout]', array(
	'default'			=> $defaults['theme_layout'],
	'sanitize_callback' => 'decree_sanitize_select',
) );

$wp_customize->add_control( 'decree_theme_options[theme_layout]', array(
	'choices'  => decree_layouts(),
	'label'    => esc_html__( 'Default Layout', 'decree' ),
	'section'  => 'decree_layout',
	'settings' => 'decree_theme_options[theme_layout]',
	'type'     => 'select',
) );

$wp_customize->add_setting( 'decree_theme_options[homepage_layout]', array(
	'default'			=> $defaults['homepage_layout'],
	'sanitize_callback' => 'decree_sanitize_select',
) );

$wp_customize->add_control( 'decree_theme_options[homepage_layout]', array(
	'choices'  => decree_layouts(),
	'label'    => esc_html__( 'Home/Archive Page Layout', 'decree' ),
	'section'  => 'decree_layout',
	'settings' => 'decree_theme_options[homepage_layout]',
	'type'     => 'select',
) );

$wp_customize->add_setting( 'decree_theme_options[content_layout]', array(
	'default'			=> $defaults['content_layout'],
	'sanitize_callback' => 'decree_sanitize_select',
) );

$wp_customize->add_control( 'decree_theme_options[content_layout]', array(
	'choices'   => decree_get_archive_content_layout(),
	'label'		=> esc_html__( 'Archive Content Layout', 'decree' ),
	'section'   => 'decree_layout',
	'settings'  => 'decree_theme_options[content_layout]',
	'type'      => 'select',
) );

$wp_customize->add_setting( 'decree_theme_options[single_post_image_layout]', array(
	'default'			=> $defaults['single_post_image_layout'],
	'sanitize_callback' => 'decree_sanitize_select',
) );

$wp_customize->add_control( 'decree_theme_options[single_post_image_layout]', array(
		'label'		=> esc_html__( 'Single Page/Post Image Layout ', 'decree' ),
		'section'   => 'decree_layout',
		'settings'  => 'decree_theme_options[single_post_image_layout]',
		'type'	  	=> 'select',
		'choices'  	=> decree_image_sizes_options(),
) );
	// Layout Options End

// Pagination Options
$pagination_type	= $options['pagination_type'];

$nav_desc = '';

/**
* Check if navigation type is Jetpack Infinite Scroll and if it is enabled
*/
$nav_desc = sprintf(
	wp_kses(
		__( 'Infinite Scroll Options requires %1$sJetPack Plugin%2$s with Infinite Scroll module Enabled.', 'decree' ),
		array(
			'a' => array(
				'href' => array(),
				'target' => array(),
			),
			'br'=> array()
		)
	),
	'<a target="_blank" href="https://wordpress.org/plugins/jetpack/">',
	'</a>'
);

$nav_desc .= '&nbsp;' . sprintf(
	wp_kses(
		__( 'Once Jetpack is installed, Infinite Scroll Settings can be found %1$shere%2$s', 'decree' ),
		array(
			'a' => array(
				'href' => array(),
				'target' => array(),
			),
			'br'=> array()
		)
	),
	'<a target="_blank" href="' . esc_url( admin_url( 'admin.php?page=jetpack#/settings' ) ) . '">',
	'</a>'
);

$wp_customize->add_section( 'decree_pagination_options', array(
	'description'	=> $nav_desc,
	'panel'  		=> 'decree_theme_options',
	'priority'		=> 212,
	'title'    		=> esc_html__( 'Pagination Options', 'decree' ),
) );

$wp_customize->add_setting( 'decree_theme_options[pagination_type]', array(
	'default'			=> $defaults['pagination_type'],
	'sanitize_callback' => 'sanitize_key',
) );

$wp_customize->add_control( 'decree_theme_options[pagination_type]', array(
	'choices'  => decree_get_pagination_types(),
	'label'    => esc_html__( 'Pagination type', 'decree' ),
	'section'  => 'decree_pagination_options',
	'settings' => 'decree_theme_options[pagination_type]',
	'type'	   => 'select',
) );
// Pagination Options End


// Scrollup
$wp_customize->add_section( 'decree_scrollup', array(
	'panel'    => 'decree_theme_options',
	'priority' => 215,
	'title'    => esc_html__( 'Scrollup Options', 'decree' ),
) );

$wp_customize->add_setting( 'decree_theme_options[disable_scrollup]', array(
	'default'			=> $defaults['disable_scrollup'],
	'sanitize_callback' => 'decree_sanitize_checkbox',
) );

$wp_customize->add_control( 'decree_theme_options[disable_scrollup]', array(
	'label'		=> esc_html__( 'Check to disable Scroll Up', 'decree' ),
	'section'   => 'decree_scrollup',
	'settings'  => 'decree_theme_options[disable_scrollup]',
	'type'		=> 'checkbox',
) );
// Scrollup End

// Search Options
$wp_customize->add_section( 'decree_search_options', array(
	'description'=> esc_html__( 'Change default placeholder text in Search.', 'decree'),
	'panel'  => 'decree_theme_options',
	'priority' => 216,
	'title'    => esc_html__( 'Search Options', 'decree' ),
) );

$wp_customize->add_setting( 'decree_theme_options[search_text]', array(
	'default'			=> $defaults['search_text'],
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'decree_theme_options[search_text]', array(
	'label'		=> esc_html__( 'Default Display Text in Search', 'decree' ),
	'section'   => 'decree_search_options',
	'settings'  => 'decree_theme_options[search_text]',
	'type'		=> 'text',
) );
// Search Options End
