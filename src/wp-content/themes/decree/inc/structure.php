<?php
/**
 * The template for Managing Theme Structure
 *
 * @package Decree
 */

if ( ! function_exists( 'decree_doctype' ) ) :
	/**
	 * Doctype Declaration
	 *
	 * @since Decree 0.1
	 */
	function decree_doctype() {
		?>
		<!DOCTYPE html>
		<html <?php language_attributes(); ?>>
		<?php
	}
endif;
add_action( 'decree_doctype', 'decree_doctype', 10 );


if ( ! function_exists( 'decree_head' ) ) :
	/**
	 * Header Codes
	 *
	 * @since Decree 0.1
	 */
	function decree_head() {
		?>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<?php
	}
endif;
add_action( 'decree_before_wp_head', 'decree_head', 10 );


if ( ! function_exists( 'decree_page_start' ) ) :
	/**
	 * Start div id #page
	 *
	 * @since Decree 0.1
	 */
	function decree_page_start() {
		?>
		<div id="page" class="hfeed site">
		<?php
	}
endif;
add_action( 'decree_header', 'decree_page_start', 10 );


if ( ! function_exists( 'decree_header_top' ) ) :
	/**
	 * Header Top Area
	 *
	 * @since Decree 0.1
	 */
	function decree_header_top() {
		$options      = decree_get_theme_options();
		$social_icons = decree_get_social_icons();

		if ( $options['disable_date'] && '' === $social_icons ) {
			// Bail if all date, social links and header-top menu is disabled.
			return;
		}

		?>
		<div id="header-top" class="header-top-bar">
			<div class="wrapper">
				<?php
				decree_date();

				$social_icons = decree_get_social_icons();

				if ( '' !== $social_icons ) {
				?>
				<div id="header-top-menu" class="menu-header-top">
					<div class="header-right-social-icons widget_decree_social_icons">
						<?php echo $social_icons; ?>
					</div><!-- #header-right-social-icons -->
				</div><!-- #header-top-menu -->
				<?php } ?>
			</div><!-- .wrapper -->
		</div><!-- #header-top -->
		<?php
	}
endif;
add_action( 'decree_header', 'decree_header_top', 20 );


if ( ! function_exists( 'decree_page_end' ) ) :
	/**
	 * End div id #page
	 *
	 * @since Decree 0.1
	 *
	 */
	function decree_page_end() {
		?>
		</div><!-- #page -->
		<?php
	}
endif;
add_action( 'decree_footer', 'decree_page_end', 90 );


if ( ! function_exists( 'decree_header_start' ) ) :
	/**
	 * Start Header id #masthead and class .wrapper
	 *
	 * @since Decree 0.1
	 *
	 */
	function decree_header_start() {
		?>
		<header id="masthead" role="banner">
			<div class="wrapper">
		<?php
	}
endif;
add_action( 'decree_header', 'decree_header_start', 40 );


if ( ! function_exists( 'decree_header_right' ) ) :
	/**
	 * Header Right Sidebar
	 *
	 * @since Decree 0.1
	 */
	function decree_header_right() {
		get_sidebar( 'header-right' );
	}
	endif;
add_action( 'decree_header', 'decree_header_right', 70 );


if ( ! function_exists( 'decree_after_primary' ) ) :
	/**
	 * End Header id #masthead and class .wrapper
	 *
	 * @since Decree 0.1
	 *
	 */
	function decree_after_primary() {
		?>
			</div><!-- .wrapper -->
		</header><!-- #masthead -->
		<?php
	}
endif;
add_action( 'decree_header', 'decree_after_primary', 100 );



if ( ! function_exists( 'decree_content_start' ) ) :
	/**
	 * Start div id #content and class .wrapper
	 *
	 * @since Decree 0.1
	 *
	 */
	function decree_content_start() {
		?>
		<div id="content" class="site-content">
			<div class="wrapper">
	<?php
	}
endif;
add_action( 'decree_content', 'decree_content_start', 30 );


if ( ! function_exists( 'decree_primary_start' ) ) :
	/**
	 * Start div id #primary
	 *
	 * @since Decree 0.1
	 *
	 */
	function decree_primary_start() {
		?>
		<div id="primary" class="content-area">
		<?php
	}
endif;
add_action( 'decree_content', 'decree_primary_start', 40 );


if ( ! function_exists( 'decree_main_start' ) ) :
	/**
	 * Start main #main
	 *
	 * @since Decree 0.1
	 *
	 */
	function decree_main_start() {
		?>
		<main id="main" class="site-main" role="main">
		<?php
	}
endif;
add_action( 'decree_content', 'decree_main_start', 50 );


if ( ! function_exists( 'decree_main_end' ) ) :
	/**
	 * End main #main
	 *
	 * @since Decree 0.1
	 *
	 */
	function decree_main_end() {
		?>
		</main><!-- #main -->
		<?php
	}
endif;
add_action( 'decree_before_secondary', 'decree_main_end', 20 );


if ( ! function_exists( 'decree_primary_end' ) ) :
	/**
	 * End div id #primary
	 *
	 * @since Decree 0.1
	 *
	 */
	function decree_primary_end() {
		?>
		</div><!-- #primary -->
		<?php
	}
endif;
add_action( 'decree_before_secondary', 'decree_primary_end', 30 );


if ( ! function_exists( 'decree_content_end' ) ) :
	/**
	 * End div id #content and class .wrapper
	 *
	 * @since Decree 0.1
	 */
	function decree_content_end() {
		?>
			</div><!-- .wrapper -->
		</div><!-- #content -->
		<?php
	}

endif;
add_action( 'decree_after_content', 'decree_content_end', 10 );


if ( ! function_exists( 'decree_footer_content_start' ) ) :
	/**
	 * Start footer id #colophon
	 *
	 * @since Decree 0.1
	 */
	function decree_footer_content_start() {
		?>
		<footer id="colophon" class="site-footer" role="contentinfo">
		<?php
	}
endif;
add_action( 'decree_footer', 'decree_footer_content_start', 10 );


if ( ! function_exists( 'decree_footer_sidebar' ) ) :
	/**
	 * Footer Sidebar
	 *
	 * @since Decree 0.1
	 */
	function decree_footer_sidebar() {
		get_sidebar( 'footer' );
	}
endif;
add_action( 'decree_footer', 'decree_footer_sidebar', 30 );


if ( ! function_exists( 'decree_footer_content_end' ) ) :
	/**
	 * End footer id #colophon
	 *
	 * @since Decree 0.1
	 */
	function decree_footer_content_end() {
		?>
		</footer><!-- #colophon -->
		<?php
	}
endif;
add_action( 'decree_footer', 'decree_footer_content_end', 80 );
