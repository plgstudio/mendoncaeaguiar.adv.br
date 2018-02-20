<?php
/**
 * Implement Custom Header functionality
 *
 * @package Decree
 */

if ( ! function_exists( 'decree_custom_header' ) ) :
	/**
	 * Implementation of the Custom Header feature
	 * Setup the WordPress core custom header feature and default custom headers packaged with the theme.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which runs
	 * before the init hook. The init hook is too late for some features, such as indicating
	 * support post thumbnails.
	 */
	function decree_custom_header() {
		$args = array(
			// Text color and image (empty to use none).
			'default-text-color' => '#1a1a1a',

			// Header image default.
			'default-image'      => get_template_directory_uri() . '/images/header-1920x800.jpg',

			// Set height and width, with a maximum value for the width.
			'height'             => 800,
			'width'              => 1920,

			// Support flexible height and width.
			'flex-height'        => true,
			'flex-width'         => true,

			// Random image rotation off by default.
			'random-default'     => false,
		);

		$args = apply_filters( 'decree_custom_header', $args );

		// Add support for custom header.
		add_theme_support( 'custom-header', $args );
	}
endif; // decree_custom_header().
add_action( 'after_setup_theme', 'decree_custom_header' );


if ( ! function_exists( 'decree_site_branding' ) ) :
	/**
	 * Get the logo and display
	 *
	 * @uses get_transient, decree_get_theme_options, get_header_textcolor, get_bloginfo, set_transient, display_header_text
	 * @get logo from options
	 *
	 * @display logo
	 *
	 * @action
	 *
	 * @since Decree 0.1
	 */
	function decree_site_branding() {
		$options 			= decree_get_theme_options();

		$site_logo = '';

		// Checking Logo.
		if ( function_exists( 'has_custom_logo' ) ) {
			if ( has_custom_logo() ) {
				$site_logo = '
				<div id="site-logo">' . get_custom_logo() . '</div><!-- #site-logo -->';
			}
		}

		$header_text = '
		<div id="site-header">';
		if ( is_front_page() && is_home() ) {
			$header_text .= '<h1 class="site-title"><a href="' . esc_url( home_url( '/' ) ) . '">' . get_bloginfo( 'name' ) . '</a></h1>';
		} else {
			$header_text .= '<p class="site-title"><a href="' . esc_url( home_url( '/' ) ) . '">' . get_bloginfo( 'name' ) . '</a></p>';
		}

		$header_text .= '<p class="site-description">' . get_bloginfo( 'description' ) . '</p>
		</div><!-- #site-header -->';

		$text_color = get_header_textcolor();
		if ( function_exists( 'has_custom_logo' ) && has_custom_logo() ) {
			if ( ! $options['move_title_tagline'] && 'blank' !== $text_color ) {
				$site_branding  = '<div id="site-branding" class="logo-left">';
				$site_branding .= $site_logo;
				$site_branding .= $header_text;
			} else {
				$site_branding  = '<div id="site-branding" class="logo-right">';
				$site_branding .= $header_text;
				$site_branding .= $site_logo;
			}
		} else {
			$site_branding	= '<div id="site-branding">';
			$site_branding	.= $header_text;
		}

		$site_branding 	.= '</div><!-- #site-branding-->';

		echo $site_branding ;
	}
endif; // decree_site_branding().
add_action( 'decree_header', 'decree_site_branding', 60 );


if ( ! function_exists( 'decree_featured_image' ) ) :
	/**
	 * Template for Featured Header Image from theme options
	 *
	 * To override this in a child theme
	 * simply create your own decree_featured_image(), and that function will be used instead.
	 *
	 * @since Decree 0.1
	 */
	function decree_featured_image() {
		$options      = decree_get_theme_options();
		$header_image = get_header_image();

		// Support Random Header Image.
		if ( is_random_header_image() ) {
			delete_transient( 'decree_featured_image' );
		}
		$output = get_transient( 'decree_featured_image' );

		if ( ! $output ) {
			echo '<!-- refreshing cache -->';

			if ( '' !== $header_image ) {
				$link   = '';
				$target = '_self';

				// Header Image Link and Target.
				if ( ! empty( $options['featured_header_image_url'] ) ) {
					// Support for qtranslate custom link.
					if ( function_exists( 'qtrans_convertURL' ) ) {
						$link = qtrans_convertURL( $options['featured_header_image_url'] );
					} else {
						$link = esc_url( $options['featured_header_image_url'] );
					}

					// Checking Link Target.
					if ( $options['featured_header_image_base'] ) {
						$target = '_blank';
					}
				}

				$title = ( '' !== $options['featured_header_image_alt'] ) ? $options['featured_header_image_alt'] : '';

				// Header Image.
				$feat_image = '<img class="wp-post-image" alt="' . esc_attr( $title ) . '" src="' . esc_url( $header_image ) . '" />';

				$output = '<div id="header-featured-image">
					<div class="wrapper">';
				// Header Image Link.
				if ( ! empty( $options['featured_header_image_url'] ) ) {
					$output .= '<a title="' . esc_attr( $title ) . '" href="' . esc_url( $link ) . '" target="' . $target . '">' . $feat_image . '</a>';
				} else {
					// If empty featured_header_image on theme options, display default.
					$output .= $feat_image;
				}

				$output .= '</div><!-- .wrapper -->
				</div><!-- #header-featured-image -->';
			} // End if().

			set_transient( 'decree_featured_image', $output, 86940 );
		} // End if().

		echo $output;

	} // decree_featured_image
endif;


if ( ! function_exists( 'decree_featured_page_post_image' ) ) :
	/**
	 * Template for Featured Header Image from Post and Page
	 *
	 * To override this in a child theme
	 * simply create your own decree_featured_imaage_pagepost(), and that function will be used instead.
	 *
	 * @since Decree 0.1
	 */
	function decree_featured_page_post_image() {
		global $post, $wp_query;

		// Get Page ID outside Loop.
		$page_id        = $wp_query->get_queried_object_id();
		$page_for_posts = (int) get_option( 'page_for_posts' );

		if ( is_home() && $page_for_posts === $page_id ) {
			$header_page_id = $page_id;
		} else {
			$header_page_id = $post->ID;
		}

		if ( has_post_thumbnail( $header_page_id ) ) {
			$options    = decree_get_theme_options();
			$image_url  = $options['featured_header_image_url'];
			$image_base = $options['featured_header_image_base'];

			$link   = '';
			$target = '_self';

			if ( '' !== $image_url ) {
				// Support for qtranslate custom link.
				if ( function_exists( 'qtrans_convertURL' ) ) {
					$link = qtrans_convertURL( $image_url );
				} else {
					$link = esc_url( $image_url );
				}
				// Checking Link Target.
				if ( $image_base ) {
					$target = '_blank';
				}
			}

			$title = ( '' !== $options['featured_header_image_alt'] ) ? $options['featured_header_image_alt'] : '';

			$image_size	= $options['featured_image_size'];

			$feat_image = get_the_post_thumbnail( $post->ID, $image_size, array(
				'id' => 'main-feat-img',
			) );

			$output = '<div id="header-featured-image" class =' . $image_size . '>';

			// Header Image Link.
			if ( '' !== $image_url ) {
				$output .= '<a title="' . esc_attr( $title ) . '" href="' . esc_url( $link ) . '" target="' . $target . '">' . $feat_image . '</a>';
			} else {
				// If empty featured_header_image on theme options, display default.
				$output .= $feat_image;
			}

			$output .= '</div><!-- #header-featured-image -->';

			echo $output;
		} else {
			decree_featured_image();
		} // End if().
	} // decree_featured_page_post_image
endif;


if ( ! function_exists( 'decree_featured_overall_image' ) ) :
	/**
	 * Template for Featured Header Image from theme options
	 *
	 * To override this in a child theme
	 * simply create your own decree_featured_pagepost_image(), and that function will be used instead.
	 *
	 * @since Decree 0.1
	 */
	function decree_featured_overall_image() {
		global $post, $wp_query;
		$options				= decree_get_theme_options();
		$enableheaderimage 		= $options['enable_featured_header_image'];

		// Get Page ID outside Loop.
		$page_id = $wp_query->get_queried_object_id();

		$page_for_posts = (int) get_option( 'page_for_posts' );

		// Check Enable/Disable header image in Page/Post Meta box.
		if ( is_page() || is_single() ) {
			// Individual Page/Post Image Setting.
			$meta_feat_image = get_post_meta( $post->ID, 'decree-header-image', true );

			if ( 'disable' === $meta_feat_image  || ( 'default' === $meta_feat_image  && 'disable' === $enableheaderimage  ) ) {
				echo '<!-- Page/Post Disable Header Image -->';
				return;
			} elseif ( 'enable' === $meta_feat_image  && 'disabled' === $enableheaderimage ) {
				decree_featured_page_post_image();
			}
		}

		// Check Homepage.
		if ( 'homepage' === $enableheaderimage ) {
			if ( is_front_page() || ( is_home() && $page_for_posts !== $page_id ) ) {
				decree_featured_image();
			}
		}
		// Check Excluding Homepage.
		if ( 'exclude-home' === $enableheaderimage ) {
			if ( is_front_page() || ( is_home() && $page_for_posts !== $page_id ) ) {
				return false;
			} else {
				decree_featured_image();
			}
		} elseif ( 'exclude-home-page-post' === $enableheaderimage ) {
			if ( is_front_page() || ( is_home() && $page_for_posts !== $page_id ) ) {
				return false;
			} elseif ( is_page() || is_single() ) {
				decree_featured_page_post_image();
			} else {
				decree_featured_image();
			}
		} elseif ( 'entire-site' === $enableheaderimage ) {
			// Check Entire Site.
			decree_featured_image();
		} elseif ( 'entire-site-page-post' === $enableheaderimage ) {
			// Check Entire Site (Post/Page).
			if ( is_page() || is_single() ) {
				decree_featured_page_post_image();
			} else {
				decree_featured_image();
			}
		} elseif ( 'pages-posts' === $enableheaderimage ) {
			// Check Page/Post.
			if ( is_page() || is_single() ) {
				decree_featured_page_post_image();
			}
		} else {
			echo '<!-- Disable Header Image -->';
		}
	} // decree_featured_overall_image
endif;
add_action( 'decree_after_header', 'decree_featured_overall_image', 10 );
