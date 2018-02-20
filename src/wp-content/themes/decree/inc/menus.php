<?php
/**
 * The template for displaying custom menus
 *
 * @package Decree
 */


if ( ! function_exists( 'decree_primary_menu' ) ) :
	/**
	 * Shows the Primary Menu
	 *
	 * default load in sidebar-header-right.php
	 */
	function decree_primary_menu() {
		?>
		<div id="primary-menu" class="menu-primary">
			<div class="wrapper">
				<button id="menu-toggle-primary" class="menu-toggle"><?php esc_html_e( 'Menu', 'decree' ); ?></button>

				<div id="site-header-menu">
					<nav id="site-navigation" class="main-navigation nav-primary search-enabled" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'decree' ); ?>">
						<h3 class="screen-reader-text"><?php esc_html_e( 'Primary menu', 'decree' ); ?></h3>
						<?php
						if ( has_nav_menu( 'primary' ) ) {
							$args = array(
								'theme_location'    => 'primary',
								'menu_class'        => 'menu decree-nav-menu',
								'container'         => false,
							);
							wp_nav_menu( $args );
						} else {
							wp_page_menu( array(
								'menu_class'  => 'default-page-menu',
							) );
						}

						?>
						<div id="search-toggle">
							<a class="screen-reader-text" href="#search-container"><?php esc_html_e( 'Search', 'decree' ); ?></a>
						</div>

						<div id="search-container" class="displaynone">
							<?php get_search_form(); ?>
						</div>
					</nav><!-- .nav-primary -->
				</div><!-- #site-header-menu -->
			</div><!-- .wrapper -->
		</div><!-- #primary-menu-wrapper -->
		<?php
	}
endif; //decree_primary_menu
add_action( 'decree_after_header', 'decree_primary_menu', 20 );


if ( ! function_exists( 'decree_add_page_menu_class' ) ) :
	/**
	 * Filters wp_page_menu to add menu class  for default page menu
	 *
	 */
	function decree_add_page_menu_class( $ulclass ) {
		return preg_replace( '/<ul>/', '<ul class="menu decree-nav-menu">', $ulclass, 1 );
	}
endif; //decree_add_page_menu_class
add_filter( 'wp_page_menu', 'decree_add_page_menu_class', 90 );


if ( ! function_exists( 'decree_footer_menu' ) ) :
	/**
	 * Shows the Footer Menu
	 *
	 * default load in sidebar-header-right.php
	 */
	function decree_footer_menu() {
		if ( has_nav_menu( 'footer' ) ) {
		?>
		<nav class="nav-footer" role="navigation" aria-label="<?php esc_attr_e( 'Footer Menu', 'decree' ); ?>">
			<div class="wrapper">
				<h3 class="assistive-text"><?php esc_html_e( 'Footer menu', 'decree' ); ?></h3>
				<?php
					$args = array(
						'theme_location' => 'footer',
						'menu_class'     => 'menu decree-nav-menu',
						'depth'          => 1,
					);
					wp_nav_menu( $args );
				?>
			</div><!-- .wrapper -->
		</nav><!-- .nav-footer -->
	<?php
		}
	}
endif; //decree_footer_menu
add_action( 'decree_footer', 'decree_footer_menu', 50 );
