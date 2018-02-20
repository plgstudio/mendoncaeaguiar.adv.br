<?php
/**
 * Custom CSS addition
 *
 * @package Decree
 */

if ( ! function_exists( 'decree_custom_css' ) ) :
	/**
	 * Enqueue Custon CSS
	 *
	 * @uses  set_transient, wp_head, wp_enqueue_style
	 *
	 * @action wp_enqueue_scripts
	 *
	 * @since Decree 0.1
	 */
	function decree_custom_css() {
		// decree_flush_transients();
		$options  = decree_get_theme_options();
		$defaults = decree_get_default_theme_options();
		$output   = get_transient( 'decree_custom_css' );

		if ( ! $output ) {
			$output = '';

			$text_color = get_header_textcolor();

			if ( 'blank' === $text_color ) {
				$output	.= '.site-title a, .site-description { position: absolute !important; clip: rect(1px 1px 1px 1px); clip: rect(1px, 1px, 1px, 1px); }' . PHP_EOL;
			} elseif ( '#1a1a1a' !== $text_color ) {
				$output	.= '.site-title a, .site-description { color: #' . $text_color . '; }' . PHP_EOL;
			}

			$output .= decree_get_section_backgrounds( $options, $defaults );

			if ( '' !== $output ) {
				$output = '<!-- ' . get_bloginfo( 'name' ) . ' inline CSS Styles -->' . PHP_EOL . '<style type="text/css" media="screen" rel="ct-custom-css">' . PHP_EOL . $output;

				$output .= '</style>' . PHP_EOL;

			}

			set_transient( 'decree_custom_css', htmlspecialchars_decode( $output ), 86940 );
		} // End if().

		echo $output;
	}
endif; // decree_custom_css().
add_action( 'wp_head', 'decree_custom_css', 101 );


if ( ! function_exists( 'decree_get_section_backgrounds' ) ) :
	/**
	 * Section Backgrounds
	 *
	 * @param  array $options theme options.
	 * @param  array $defaults default options.
	 *
	 * @since Decree 0.1
	 */
	function decree_get_section_backgrounds( $options, $defaults ) {
		$output = '';

		if ( $defaults['featured_content_bg_image'] !== $options['featured_content_bg_image'] ) {
			if ( $options['featured_content_bg_image'] ) {
				$output	.= '#featured-content { background-image: url( "' . esc_url( $options['featured_content_bg_image'] ) . '" ); }' . PHP_EOL;
			} else {
				$output	.= '#featured-content { background-image: none; }' . PHP_EOL;
			}
		}

		if ( $defaults['promotion_headline_bg_image'] !== $options['promotion_headline_bg_image'] ) {
			if ( '' !== $options['promotion_headline_bg_image'] ) {
				$output	.= '#promotion-headline-section { background-image: url( "' . esc_url( $options['promotion_headline_bg_image'] ) . '" ); }' . PHP_EOL;
			} else {
				$output	.= '#promotion-headline-section { background-image: none; }' . PHP_EOL;
			}
		}

		if ( $defaults['contact_page_bg_image'] !== $options['contact_page_bg_image'] ) {
			if ( $options['contact_page_bg_image'] ) {
				$output	.= '#contact-page-section { background-image: url( "' . esc_url( $options['contact_page_bg_image'] ) . '" ); }' . PHP_EOL;
			} else {
				$output	.= '#contact-page-section { background-image: none; }' . PHP_EOL;
			}
		}

		if ( $defaults['logo_slider_bg_image'] !== $options['logo_slider_bg_image'] ) {
			if ( $options['logo_slider_bg_image'] ) {
				$output	.= '#logo-section { background-image: url( "' . esc_url( $options['logo_slider_bg_image'] ) . '" ); }' . PHP_EOL;
			} else {
				$output	.= '#logo-section { background-image: none; }' . PHP_EOL;
			}
		}

		return $output;
	}
endif; // decree_get_section_backgrounds.


/**
 * Converts a HEX value to RGB.
 *
 * @since Decree 0.1
 *
 * @param string $color The original color, in 3- or 6-digit hexadecimal form.
 * @return array Array containing RGB (red, green, and blue) values for the given
 *               HEX code, empty array otherwise.
 */
function decree_hex2rgb( $color ) {
	$color = trim( $color, '#' );

	if ( strlen( $color ) === 3 ) {
		$r = hexdec( substr( $color, 0, 1 ) . substr( $color, 0, 1 ) );
		$g = hexdec( substr( $color, 1, 1 ) . substr( $color, 1, 1 ) );
		$b = hexdec( substr( $color, 2, 1 ) . substr( $color, 2, 1 ) );
	} elseif ( strlen( $color ) === 6 ) {
		$r = hexdec( substr( $color, 0, 2 ) );
		$g = hexdec( substr( $color, 2, 2 ) );
		$b = hexdec( substr( $color, 4, 2 ) );
	} else {
		return array();
	}

	return array(
		'red' => $r,
		'green' => $g,
		'blue' => $b,
	);
}
