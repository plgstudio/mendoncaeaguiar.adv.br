<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Decree
 */
?>

<?php
/**
 * decree_before_secondary hook
 *
 * @hooked decree_after_posts_pages_sidebar - 10
 * @hooked decree_main_end - 20
 * @hooked decree_primary_end - 30
 *
 */

do_action( 'decree_before_secondary' );

$decree_layout = decree_get_theme_layout();

// Bail early if no sidebar layout is selected.
if ( 'no-sidebar' === $decree_layout || 'no-sidebar-one-column' === $decree_layout || 'no-sidebar-full-width' === $decree_layout ) {
	return;
}

/**
 * decree_before_primary_sidebar hook
 */
do_action( 'decree_before_primary_sidebar' );
?>
	<aside class="sidebar sidebar-primary widget-area" role="complementary">
		<?php
		if ( is_active_sidebar( 'primary-sidebar' ) ) {
			dynamic_sidebar( 'primary-sidebar' );
		} else {
			//Helper Text
			if ( current_user_can( 'edit_theme_options' ) ) { ?>
				<section id="widget-default-text" class="widget widget_text">
					<div class="widget-wrap">
						<h4 class="widget-title"><?php esc_html_e( 'Primary Sidebar Widget Area', 'decree' ); ?></h4>

						<div class="textwidget">
							<p><?php esc_html_e( 'This is the Primary Sidebar Widget Area if you are using a two or three column site layout option.', 'decree' ); ?></p>
							<p><?php
								printf(
									esc_html__( 'By default it will load Search and Archives widgets as shown below. You can add widget to this area by visiting your %1$sWidgets Panel%2$s which will replace default widgets.', 'decree' ),
									'<a href="' . esc_url( admin_url( 'widgets.php' ) ) . '">',
									'</a>'
								);
							?></p>
						</div><!-- .textwidget -->
					</div><!-- .widget-wrap -->
				</section><!-- #widget-default-text -->
			<?php
			} ?>
			<section class="widget widget_widget_decree_adspace_widget" id="header-right-ads">
				<div class="widget-wrap">
					<a class="ads-image" href="#">
						<img src="<?php echo get_template_directory_uri(); ?>/images/ads-300x250.jpg">
					</a>
				</div><!-- .widget-wrap -->
			</section><!-- .widget-wrap -->
			<section class="widget widget_search" id="default-search">
				<div class="widget-wrap">
					<h4 class="widget-title"><?php esc_html_e( 'Search', 'decree' ); ?></h4>
					<?php get_search_form(); ?>
				</div><!-- .widget-wrap -->
			</section><!-- #default-search -->
			<section class="widget widget_archive" id="default-archives">
				<div class="widget-wrap">
					<h4 class="widget-title"><?php esc_html_e( 'Archives', 'decree' ); ?></h4>
					<ul>
						<?php wp_get_archives( array(
							'type' => 'monthly',
						) ); ?>
					</ul>
				</div><!-- .widget-wrap -->
			</section><!-- #default-archives -->
			<?php
		} // End if().
		?>
	</aside><!-- .sidebar sidebar-primary widget-area -->
<?php
/**
 * decree_after_primary_sidebar hook
 */
do_action( 'decree_after_primary_sidebar' );


/**
 * decree_after_secondary hook
 *
 */
do_action( 'decree_after_secondary' );
