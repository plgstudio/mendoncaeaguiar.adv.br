<?php
/**
 * Active callbacks for Theme/Customizer Options
 *
 * @package Decree
 */


if ( ! function_exists( 'decree_is_portfolio_active' ) ) :
	/**
	 * Return true if portfolio is active
	 *
	 * @since Decree 0.1
	 */
	function decree_is_portfolio_active( $control ) {
		$enable = $control->manager->get_setting( 'decree_theme_options[portfolio_option]' )->value();

		// return true only if previewed page on customizer matches the type of content option selected
		return ( decree_check_section( $enable ) );
	}
endif;


if ( ! function_exists( 'decree_is_slider_active' ) ) :
	/**
	 * Return true if slider is active
	 *
	 * @since Decree 0.1
	 */
	function decree_is_slider_active( $control ) {
		$enable = $control->manager->get_setting( 'decree_theme_options[featured_slider_option]' )->value();

		// return true only if previewed page on customizer matches the type of slider option selected
		return ( decree_check_section( $enable ) );
	}
endif;

if ( ! function_exists( 'decree_is_featured_content_active' ) ) :
	/**
	 * Return true if featured content is active
	 *
	 * @since Decree 0.1
	 */
	function decree_is_featured_content_active( $control ) {
		$enable = $control->manager->get_setting( 'decree_theme_options[featured_content_option]' )->value();

		// return true only if previewed page on customizer matches the type of content option selected
		return ( decree_check_section( $enable ) );
	}
endif;


if ( ! function_exists( 'decree_is_testimonial_active' ) ) :
	/**
	 * Return true if testimonial is active
	 *
	 * @since Decree 0.1
	 */
	function decree_is_testimonial_active( $control ) {
		$enable = $control->manager->get_setting( 'decree_theme_options[testimonial_option]' )->value();

		// return true only if previewed page on customizer matches the type of content option selected
		return ( decree_check_section( $enable ) );
	}
endif;


if ( ! function_exists( 'decree_is_hero_content_active' ) ) :
	/**
	 * Return true if hero content is active
	 *
	 * @since Decree 0.1
	 */
	function decree_is_hero_content_active( $control ) {
		$enable = $control->manager->get_setting( 'decree_theme_options[hero_content_option]' )->value();

		// return true only if previewed page on customizer matches the type of content option selected
		return ( decree_check_section( $enable ) );
	}
endif;

if ( ! function_exists( 'decree_is_logo_slider_active' ) ) :
	/**
	  * Return true if logo_slider is active
	 *
	 * @since Decree 0.1
	 */
	function decree_is_logo_slider_active( $control ) {
		$enable = $control->manager->get_setting( 'decree_theme_options[logo_slider_option]' )->value();

		// return true only if previewed page on customizer matches the type of logo_slider option selected
		return ( decree_check_section( $enable ) );
	}
endif;


if ( ! function_exists( 'decree_is_promo_head_active' ) ) :
	/**
	 * Return true if promotion_headline is active
	 *
	 * @since Decree 0.1
	 */
	function decree_is_promo_head_active( $control ) {
		$enable = $control->manager->get_setting( 'decree_theme_options[promo_head_option]' )->value();

		// return true only if previewed page on customizer matches the type of content option selected
		return ( decree_check_section( $enable ) );
	}
endif;


if ( ! function_exists( 'decree_is_team_active' ) ) :
	/**
	 * Return true if our team is active
	 *
	 * @since Decree 0.1
	 */
	function decree_is_team_active( $control ) {
		$enable = $control->manager->get_setting( 'decree_theme_options[team_option]' )->value();

		// return true only if previewed page on customizer matches the type of content option selected
		return ( decree_check_section( $enable ) );
	}
endif;
