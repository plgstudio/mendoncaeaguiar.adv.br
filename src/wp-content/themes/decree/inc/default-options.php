<?php
/**
 * Implement Default Theme/Customizer Options
 *
 * @package Decree
 */

if ( ! function_exists( 'decree_get_default_theme_options' ) ) :
	/**
	 * Returns the default options for Decree.
	 *
	 * @since Decree 0.1
	 */
	function decree_get_default_theme_options() {
		$theme_data = wp_get_theme();

		$options = array(
			'featured_content_bg_image'                     => get_template_directory_uri() . '/images/bg-featured-content.jpg',
			'promotion_headline_bg_image'                   => get_template_directory_uri() . '/images/bg-featured-content.jpg',
			'contact_page_bg_image'                         => get_template_directory_uri() . '/images/bg-featured-content.jpg',
			'logo_slider_bg_image'                          => get_template_directory_uri() . '/images/bg-featured-content.jpg',

			// Site Title an Tagline.
			'move_title_tagline'                            => 0,

			// Layout.
			'theme_layout'                                  => 'right-sidebar',
			'homepage_layout'                               => 'no-sidebar-full-width',
			'content_layout'                                => 'excerpt',
			'single_post_image_layout'                      => 'disabled',

			// Header Image.
			'enable_featured_header_image'                  => 'disabled',
			'featured_image_size'                           => 'full',
			'featured_header_image_url'                     => '',
			'featured_header_image_alt'                     => '',
			'featured_header_image_base'                    => 0,

			// Breadcrumb Options.
			'breadcrumb_option'                             => 0,
			'breadcrumb_on_homepage'                        => 0,
			'breadcrumb_seperator'                          => '&raquo;',

			// Scrollup Options.
			'disable_scrollup'                              => 0,

			// Header Right Sidebar Options.
			'header_right_call_text'                        => esc_html__( 'Call Today', 'decree' ),
			'header_right_call_number'                      => '000-000-0000',
			'header_right_button_text'                      => esc_html__( 'FREE Case Evaluation', 'decree' ),
			'header_right_button_link'                      => '#',
			'header_right_button_link_target'               => 0,

			// Excerpt Options.
			'excerpt_length'                                => '45',
			'excerpt_more_text'                             => esc_html__( 'Read More ... ', 'decree' ),

			// Homepage / Frontpage Settings.
			'front_page_category'                           => '0',
			'front_page_title'                              => esc_html__( 'Recent Posts', 'decree' ),
			'front_page_description'                        => current_user_can( 'edit_theme_options' ) ? sprintf(
				esc_html__( 'Here you can showcase the x number of recents posts which you can control from %1$sSettings - Readings%2$s', 'decree' ),
				'<a target="_blank" href="' . esc_url( admin_url( 'options-reading.php' ) ) . '">',
				'</a>'
			) : '',

			// Pagination Options.
			'pagination_type'                               => 'default',

			// Promotion Headline Options.
			'promo_head_option'                             => 'disabled',
			'promo_head_show'                               => 'excerpt',
			'promo_head_title'                              => '',
			'promo_head_content'                            => '',
			'promo_head_button'                             => '',
			'promo_head_url'                                => '',
			'promo_head_target_1'                           => 1,
			'promo_head_button_2'                           => '',
			'promo_head_url_2'                              => '',
			'promo_head_target_2'                           => 1,

			// Search Options.
			'search_text'                                   => esc_html__( 'Search... ', 'decree' ),

			// Fixed Header Top.
			'disable_date'                                  => 0,

			// Portfolio Options.
			'portfolio_option'                              => 'disabled',
			'portfolio_layout'                              => 'four-columns',
			'portfolio_headline'                            => '',
			'portfolio_subheadline'                         => '',
			'portfolio_number'                              => '4',
			'portfolio_select_category'                     => '0',
			'portfolio_show'                                => 'hide-content',
			'portfolio_hide_category'                       => 0,
			'portfolio_hide_tags'                           => 1,
			'portfolio_hide_author'                         => 1,
			'portfolio_hide_date'                           => 0,

			// Hero Content Options.
			'hero_content_option'                           => 'disabled',
			'hero_content_number'                           => '1',
			'hero_content_enable_title'                     => 1,
			'hero_content_show'                             => 'excerpt',
			'hero_content_select_category'                  => '0',
			'disable_read_more'                             => 0,

			// Featured Content Options.
			'featured_content_option'                       => 'disabled',
			'featured_content_layout'                       => 'four-columns',
			'featured_content_position'                     => 0,
			'featured_content_headline'                     => esc_html__( 'Featured Content', 'decree' ),
			'featured_content_subheadline'                  => '',
			'featured_content_number'                       => '4',
			'featured_content_select_category'              => '0',
			'featured_content_show'                         => 'excerpt',

			// News Ticker Options.
			'news_ticker_option'                            => 'disabled',
			'news_ticker_position'                          => 'above-content',
			'news_ticker_type'                              => 'demo',
			'news_ticker_label'                             => '',
			'news_ticker_transition_effect'                 => 'flipVert',
			'news_ticker_number'                            => '4',
			'news_ticker_select_category'                   => '0',

			// Featured Slider Options.
			'featured_slider_option'                        => 'disabled',
			'featured_slider_image_loader'                  => 'true',
			'featured_slider_transition_effect'             => 'fadeout',
			'featured_slider_transition_delay'              => '4',
			'featured_slider_transition_length'             => '1',
			'featured_slider_number'                        => '4',
			'featured_slider_select_category'               => '0',
			'exclude_slider_post'                           => 0,

			// Testimonail Options.
			'testimonial_option'                            => 'disabled',
			'testimonial_layout'                            => 'one-column',
			'testimonial_position'                          => 0,
			'testimonial_slider'                            => 1,
			'testimonial_headline'                          => '',
			'testimonial_subheadline'                       => '',
			'testimonial_number'                            => '4',
			'testimonial_enable_title'                      => 1,
			'testimonial_show'                              => 'full-content',
			'testimonial_select_category'                   => '0',

			// Logo Slider.
			'logo_slider_option'                            => 'disabled',
			'logo_slider_visible_items'                     => '4',
			'logo_slider_transition_delay'                  => '4',
			'logo_slider_transition_length'                 => '1',
			'logo_slider_title'                             => '',
			'logo_slider_description'                       => '',
			'logo_slider_number'                            => '5',
			'logo_slider_select_category'                   => '0',
			// Team Options.
			'team_option'                                   => 'disabled',
			'team_layout'                                   => 'four-columns',
			'team_position'                                 => 0,
			'team_headline'                                 => esc_html__( 'Our Attorneys', 'decree' ),
			'team_subheadline'                              => esc_html__( 'This is Team Section and you can edit this from Appearnce - Customize - Theme Options - Team. Details information of Team Options can be found in our theme instructions page', 'decree' ),
			'team_number'                                   => '4',
			'team_enable_title'                             => 1,
			'team_show'                                     => 'hide-content',
			'team_select_category'                          => '0',

			// Reset all settings.
			'reset_all_settings'                            => 0,
		);

		return apply_filters( 'decree_default_theme_options', $options );
	}
endif;

/**
 * Returns an array of layout options registered for Decree.
 *
 * @since Decree 0.1
 */
function decree_layouts() {
	$layout_options = array(
		'right-sidebar'         => esc_html__( 'Content, Primary Sidebar', 'decree' ),
		'no-sidebar-full-width' => esc_html__( 'No Sidebar ( Full Width )', 'decree' ),
	);
	return apply_filters( 'decree_layouts', $layout_options );
}


/**
 * Returns an array of content layout options registered for Decree.
 *
 * @since Decree 0.1
 */
function decree_get_archive_content_layout() {
	$layout_options = array(
		'excerpt'      => esc_html__( 'Excerpt', 'decree' ),
		'full-content' => esc_html__( 'Show Full Content (No Featured Image)', 'decree' ),
	);

	return apply_filters( 'decree_get_archive_content_layout', $layout_options );
}


/**
 * Returns an array of feature header enable options
 *
 * @since Decree 0.1
 */
function decree_enable_featured_header_image_options() {
	$options = array(
		'homepage'               => esc_html__( 'Homepage / Frontpage', 'decree' ),
		'exclude-home'           => esc_html__( 'Excluding Homepage', 'decree' ),
		'exclude-home-page-post' => esc_html__( 'Excluding Homepage, Page/Post Featured Image', 'decree' ),
		'entire-site'            => esc_html__( 'Entire Site', 'decree' ),
		'entire-site-page-post'  => esc_html__( 'Entire Site, Page/Post Featured Image', 'decree' ),
		'pages-posts'            => esc_html__( 'Pages and Posts', 'decree' ),
		'disabled'               => esc_html__( 'Disabled', 'decree' ),
	);

	return apply_filters( 'decree_enable_featured_header_image_options', $options );
}


/**
 * Returns an array of content and slider layout options registered for Decree.
 *
 * @since Decree 0.1
 */
function decree_section_visibility_options() {
	$options = array(
		'homepage'    => esc_html__( 'Homepage / Frontpage', 'decree' ),
		'entire-site' => esc_html__( 'Entire Site', 'decree' ),
		'disabled'    => esc_html__( 'Disabled', 'decree' ),
	);

	return apply_filters( 'decree_section_visibility_options', $options );
}


/**
 * Returns an array of news ticker positions registered for Decree.
 *
 * @since Decree 0.1
 */
function decree_news_ticker_positions() {
	$options = array(
		'below-menu'    => esc_html__( 'Below Menu', 'decree' ),
		'above-content' => esc_html__( 'Above Content', 'decree' ),
	);

	return apply_filters( 'decree_news_ticker_positions', $options );
}


/**
 * Returns an array of featured content options registered for Decree.
 *
 * @since Decree 0.1
 */
function decree_featured_content_layout_options() {
	$options = array(
		'two-columns'   => esc_html__( '2 columns', 'decree' ),
		'three-columns' => esc_html__( '3 columns', 'decree' ),
		'four-columns'  => esc_html__( '4 columns', 'decree' ),
	);

	return apply_filters( 'decree_featured_content_layout_options', $options );
}


/**
 * Returns an array of featured content show registered for Decree.
 *
 * @since Decree 0.1
 */
function decree_featured_content_show() {
	$options = array(
		'excerpt'      => esc_html__( 'Show Excerpt', 'decree' ),
		'full-content' => esc_html__( 'Show Full Content', 'decree' ),
		'hide-content' => esc_html__( 'Hide Content', 'decree' ),
	);

	return apply_filters( 'decree_featured_content_show', $options );
}


/**
 * Returns an array of testimonial content show registered for Decree.
 *
 * @since Decree 0.1
 */
function decree_testimonial_content_show() {
	$options = array(
		'excerpt'      => esc_html__( 'Show Excerpt', 'decree' ),
		'full-content' => esc_html__( 'Show Full Content', 'decree' ),
	);

	return apply_filters( 'decree_testimonial_content_show', $options );
}


/**
 * Returns an array of testimonial layout options registered.
 *
 * @since Decree 0.1
 */
function decree_testimonial_layout_options() {
	$options = array(
		'one-column'  => esc_html__( '1 column', 'decree' ),
		'two-columns' => esc_html__( '2 columns', 'decree' ),
	);

	return apply_filters( 'decree_testimonial_layout_options', $options );
}


/**
 * Returns an array of feature slider transition effects
 *
 * @since Decree 0.1
 */
function decree_featured_slider_transition_effects() {
	$options = array(
		'fade'       => esc_html__( 'Fade', 'decree' ),
		'fadeout'    => esc_html__( 'Fade Out', 'decree' ),
		'none'       => esc_html__( 'None', 'decree' ),
		'scrollHorz' => esc_html__( 'Scroll Horizontal', 'decree' ),
		'scrollVert' => esc_html__( 'Scroll Vertical', 'decree' ),
		'flipHorz'   => esc_html__( 'Flip Horizontal', 'decree' ),
		'flipVert'   => esc_html__( 'Flip Vertical', 'decree' ),
		'tileSlide'  => esc_html__( 'Tile Slide', 'decree' ),
		'tileBlind'  => esc_html__( 'Tile Blind', 'decree' ),
		'shuffle'    => esc_html__( 'Shuffle', 'decree' ),
	);

	return apply_filters( 'decree_featured_slider_transition_effects', $options );
}

/**
 * Returns an array of featured slider image loader options
 *
 * @since Decree 0.1
 */
function decree_featured_slider_image_loader() {
	$options = array(
		'true'  => esc_html__( 'True', 'decree' ),
		'wait'  => esc_html__( 'Wait', 'decree' ),
		'false' => esc_html__( 'False', 'decree' ),
	);

	return apply_filters( 'decree_featured_slider_image_loader', $options );
}


/**
 * Returns an array of pagination types registered for Decree.
 *
 * @since Decree 0.1
 */
function decree_get_pagination_types() {
	$options = array(
		'default'         => esc_html__( 'Default(Older Posts/Newer Posts)', 'decree' ),
		'numeric'         => esc_html__( 'Numeric', 'decree' ),
		'infinite-scroll' => esc_html__( 'Infinite Scroll', 'decree' ),
	);

	return apply_filters( 'decree_get_pagination_types', $options );
}


/**
 * Returns an array of content featured image size.
 *
 * @since Decree 0.1
 */
function decree_image_sizes_options() {
	$options['disabled']             = esc_html__( 'Disabled', 'decree' );
	$options['decree-featured']      = esc_html__( 'Featured', 'decree' );
	$options['decree-featured-full'] = esc_html__( 'Featured Full Width', 'decree' );
	$options['full']                 = esc_html__( 'Original', 'decree' );

	return apply_filters( 'decree_image_sizes_options', $options );
}


/**
 * Returns list of social icons currently supported
 *
 * @since Decree 0.1
 */
function decree_get_social_icons_list() {
	$options = array(
		'facebook_link'		=> array(
			'fa_class' 	=> 'facebook',
			'label' 			=> esc_html__( 'Facebook', 'decree' ),
		),
		'twitter_link'		=> array(
			'fa_class' 	=> 'twitter',
			'label' 			=> esc_html__( 'Twitter', 'decree' ),
		),
		'googleplus_link'	=> array(
			'fa_class' 	=> 'google-plus',
			'label' 			=> esc_html__( 'Googleplus', 'decree' ),
		),
		'email_link'		=> array(
			'fa_class' 	=> 'envelope',
			'label' 			=> esc_html__( 'Email', 'decree' ),
		),
		'feed_link'			=> array(
			'fa_class' 	=> 'feed',
			'label' 			=> esc_html__( 'Feed', 'decree' ),
		),
		'wordpress_link'	=> array(
			'fa_class' 	=> 'wordpress',
			'label' 			=> esc_html__( 'WordPress', 'decree' ),
		),
		'github_link'		=> array(
			'fa_class' 	=> 'github',
			'label' 			=> esc_html__( 'GitHub', 'decree' ),
		),
		'linkedin_link'		=> array(
			'fa_class' 	=> 'linkedin',
			'label' 			=> esc_html__( 'LinkedIn', 'decree' ),
		),
		'pinterest_link'	=> array(
			'fa_class' 	=> 'pinterest',
			'label' 			=> esc_html__( 'Pinterest', 'decree' ),
		),
		'flickr_link'		=> array(
			'fa_class' 	=> 'flickr',
			'label' 			=> esc_html__( 'Flickr', 'decree' ),
		),
		'vimeo_link'		=> array(
			'fa_class' 	=> 'vimeo',
			'label' 			=> esc_html__( 'Vimeo', 'decree' ),
		),
		'youtube_link'		=> array(
			'fa_class' 	=> 'youtube',
			'label' 			=> esc_html__( 'YouTube', 'decree' ),
		),
		'tumblr_link'		=> array(
			'fa_class' 	=> 'tumblr',
			'label' 			=> esc_html__( 'Tumblr', 'decree' ),
		),
		'instagram_link'	=> array(
			'fa_class' 	=> 'instagram',
			'label' 			=> esc_html__( 'Instagram', 'decree' ),
		),
		'vkontakte_link'	=> array(
			'fa_class' 	=> 'vk',
			'label' 			=> esc_html__( 'VKontakte', 'decree' ),
		),
		'codepen_link'		=> array(
			'fa_class' 	=> 'codepen',
			'label' 			=> esc_html__( 'CodePen', 'decree' ),
		),
		'xing_link'			=> array(
			'fa_class' 	=> 'xing',
			'label' 			=> esc_html__( 'Xing', 'decree' ),
		),
		'dribbble_link'		=> array(
			'fa_class' 	=> 'dribbble',
			'label' 			=> esc_html__( 'Dribbble', 'decree' ),
		),
		'skype_link'		=> array(
			'fa_class' 	=> 'skype',
			'label' 			=> esc_html__( 'Skype', 'decree' ),
		),
		'digg_link'			=> array(
			'fa_class' 	=> 'digg',
			'label' 			=> esc_html__( 'Digg', 'decree' ),
		),
		'reddit_link'		=> array(
			'fa_class' 	=> 'reddit',
			'label' 			=> esc_html__( 'Reddit', 'decree' ),
		),
		'stumbleupon_link'	=> array(
			'fa_class' 	=> 'stumbleupon',
			'label' 			=> esc_html__( 'Stumbleupon', 'decree' ),
		),
		'pocket_link'		=> array(
			'fa_class' 	=> 'get-pocket',
			'label' 			=> esc_html__( 'Pocket', 'decree' ),
		),
		'dropbox_link'		=> array(
			'fa_class' 	=> 'dropbox',
			'label' 			=> esc_html__( 'DropBox', 'decree' ),
		),
		'spotify_link'		=> array(
			'fa_class' 	=> 'spotify',
			'label' 			=> esc_html__( 'Spotify', 'decree' ),
		),
		'foursquare_link'	=> array(
			'fa_class' 	=> 'foursquare',
			'label' 			=> esc_html__( 'Foursquare', 'decree' ),
		),
		'twitch_link'		=> array(
			'fa_class' 	=> 'twitch',
			'label' 			=> esc_html__( 'Twitch', 'decree' ),
		),
		'website_link'		=> array(
			'fa_class' 	=> 'globe',
			'label' 			=> esc_html__( 'Website', 'decree' ),
		),
		'phone_link'		=> array(
			'fa_class' => 'mobile-phone',
			'label'    => esc_html__( 'Phone', 'decree' ),
		),
		'handset_link'		=> array(
			'fa_class' => 'phone',
			'label'    => esc_html__( 'Handset', 'decree' ),
		),
		'cart_link'			=> array(
			'fa_class' => 'shopping-cart',
			'label'    => esc_html__( 'Cart', 'decree' ),
		),
		'cloud_link'		=> array(
			'fa_class' => 'cloud',
			'label'    => esc_html__( 'Cloud', 'decree' ),
		),
		'link_link'		=> array(
			'fa_class' => 'link',
			'label'    => esc_html__( 'Link', 'decree' ),
		),
	);

	return apply_filters( 'decree_social_icons_list', $options );
}


/**
 * Returns an array of meta box layout options registered for Decree.
 *
 * @since Decree 0.1
 */
function decree_metabox_layouts() {
	$layout_options = array(
		'default' 	=> array(
			'id' 	=> 'decree-layout-option',
			'value' => 'default',
			'label' => esc_html__( 'Default', 'decree' ),
		),
		'right-sidebar' => array(
			'id' 	=> 'decree-layout-option',
			'value' => 'right-sidebar',
			'label' => esc_html__( 'Content, Primary Sidebar', 'decree' ),
		),
		'no-sidebar-full-width' => array(
			'id' 	=> 'decree-layout-option',
			'value' => 'no-sidebar-full-width',
			'label' => esc_html__( 'No Sidebar ( Full Width )', 'decree' ),
		),
	);
	return apply_filters( 'decree_layouts', $layout_options );
}

/**
 * Returns an array of metabox header featured image options registered for Decree.
 *
 * @since Decree 0.1
 */
function decree_metabox_header_featured_image_options() {
	$options = array(
		'default' => array(
			'id'		=> 'decree-header-image',
			'value' 	=> 'default',
			'label' 	=> esc_html__( 'Default', 'decree' ),
		),
		'enable'  => array(
			'id'		=> 'decree-header-image',
			'value' 	=> 'enable',
			'label' 	=> esc_html__( 'Enable', 'decree' ),
		),
		'disable' => array(
			'id'		=> 'decree-header-image',
			'value' 	=> 'disable',
			'label' 	=> esc_html__( 'Disable', 'decree' ),
		),
	);
	return apply_filters( 'header_featured_image_options', $options );
}


/**
 * Returns an array of metabox sidebar options registered for Decree.
 *
 * @since Decree 0.1
 */
function decree_metabox_sidebar_options() {
	$options = array(
		'main-sidebar' => array(
			'id'		=> 'decree-sidebar-options',
			'value' 	=> 'default-sidebar',
			'label' 	=> esc_html__( 'Default Sidebar', 'decree' ),
		),
		'optional-sidebar-one' => array(
			'id' 	=> 'decree-sidebar-options',
			'value' => 'optional-sidebar-one',
			'label' => esc_html__( 'Optional Sidebar One', 'decree' ),
		),
		'optional-sidebar-two' => array(
			'id' 	=> 'decree-sidebar-options',
			'value' => 'optional-sidebar-two',
			'label' => esc_html__( 'Optional Sidebar Two', 'decree' ),
		),
		'optional-sidebar-three' => array(
			'id' 	=> 'decree-sidebar-options',
			'value' => 'optional-sidebar-three',
			'label' => esc_html__( 'Optional Sidebar three', 'decree' ),
		),
	);
	return apply_filters( 'sidebar_options', $options );
}


/**
 * Returns an array of metabox featured image options registered for Decree.
 *
 * @since Decree 0.1
 */
function decree_metabox_featured_image_options() {
	$options['default'] = array(
		'id'	=> 'decree-featured-image',
		'value' => 'default',
		'label' => esc_html__( 'Default', 'decree' ),
	);

	$options['disabled'] = array(
		'id' 	=> 'decree-featured-image',
		'value' => 'disabled',
		'label' => esc_html__( 'Disable Image', 'decree' ),
	);

	$options['decree-featured'] = array(
		'id' 	=> 'decree-featured-image',
		'value' => 'decree-featured',
		'label' => esc_html__( 'Featured', 'decree' ),
	);

	$options['decree-featured-full'] = array(
		'id' 	=> 'decree-featured-image',
		'value' => 'decree-featured-full',
		'label' => esc_html__( 'Featured Full Width', 'decree' ),
	);

	$options['full'] = array(
		'id'	=> 'decree-featured-image',
		'value'	=> 'full',
		'label' => esc_html__( 'Original', 'decree' ),
	);

	return apply_filters( 'decree_metabox_featured_image_options', $options );
}


/**
 * Returns an array of feature slider transition effects
 *
 * @since Decree 0.1
 */
function decree_contact_info_bg() {
	$options = array(
		'none'       => esc_html__( 'None', 'decree' ),
		'image'      => esc_html__( 'Image', 'decree' ),
		'embed-code' => esc_html__( 'Embed Code', 'decree' ),
	);

	return apply_filters( 'decree_contact_info_bg', $options );
}


/**
 * Returns an array of hero content types registered for decree.
 *
 * @since Decree 0.1
 */
function decree_get_category_list() {
	$cats    = get_categories();

	foreach ( $cats as $cat ) {
		$options[ $cat->term_id ] = $cat->name;
	}

	return apply_filters( 'decree_get_category_list', $options );
}


/**
 * Returns footer content
 *
 * @since Decree 0.1
 */
function decree_get_content() {
	$theme_data = wp_get_theme();

	return sprintf( _x( 'Copyright &copy; %1$s %2$s. All Rights Reserved', '1: Year, 2: Site Title with home URL', 'decree' ), date_i18n( __( 'Y', 'decree' ) ), '<a href="' . esc_url( home_url( '/' ) ) . '">' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '</a>' ) . ' &#124; ' . $theme_data->get( 'Name' ) . '&nbsp;' . esc_html__( 'by', 'decree' ) . '&nbsp;<a target="_blank" href="' . $theme_data->get( 'AuthorURI' ) . '">' . esc_html( $theme_data->get( 'Author' ) ) . '</a>';
}
