<?php
/**
 * The template for displaying Social Icons
 *
 * @package Decree
 */


if ( ! function_exists( 'decree_get_social_icons' ) ) :
	/**
	 * Generate social icons.
	 *
	 * @since Decree 0.1
	 */
	function decree_get_social_icons() {
		if ( ! $output = get_transient( 'decree_social_icons' ) ) {
			$output  = '';
			$options = decree_get_theme_options(); // Get options

			$pre_def_icons = decree_get_social_icons_list();

			foreach ( $pre_def_icons as $key => $item ) {
				if ( isset( $options[ $key ] ) && '' !== $options[ $key ] ) {
					$value = $options[ $key ];
					if ( 'email_link' === $key ) {
						$output .= '<a class="fa fa-' . sanitize_key( $item['fa_class'] ) . '" target="_blank" title="' . esc_attr__( 'Email', 'decree' ) . '" href="mailto:' . esc_attr( antispambot( sanitize_email( $value ) ) ) . '"><span class="screen-reader-text">' . esc_html( 'Email', 'decree' ) . '</span> </a>';
					} elseif ( 'skype_link' === $key ) {
						$output .= '<a class="fa fa-' . sanitize_key( $item['fa_class'] ) . '" target="_blank" title="' . esc_attr( $item['label'] ) . '" href="' . esc_attr( $value ) . '"><span class="screen-reader-text">' . esc_attr( $item['label'] ) . '</span> </a>';
					} elseif ( 'phone_link' === $key || 'handset_link' === $key ) {
						$output .= '<a class="fa fa-' . sanitize_key( $item['fa_class'] ) . '" target="_blank" title="' . esc_attr( $item['label'] ) . '" href="tel:' . esc_attr( preg_replace( '/\s+/', '', $value ) ) . '"><span class="screen-reader-text">' . esc_attr( $item['label'] ) . '</span> </a>';
					} else {
						$output .= '<a class="fa fa-' . sanitize_key( $item['fa_class'] ) . '" target="_blank" title="' . esc_attr( $item['label'] ) . '" href="' . esc_url( $value ) . '"><span class="screen-reader-text">' . esc_attr( $item['label'] ) . '</span> </a>';
					}
				}
			}

			set_transient( 'decree_social_icons', $output, 86940 );
		}
		return $output;
	} // decree_get_social_icons.
endif;
