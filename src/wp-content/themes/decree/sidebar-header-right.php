<?php
/**
 * The Header Right Sidebar containing the header right widget area
 *
 * @package Decree
 */

?>


<?php
/**
 * decree_before_header_right hook
 */
do_action( 'decree_before_header_right' ); ?>

<aside class="sidebar sidebar-header-right widget-area">
	<?php
	$options = decree_get_theme_options();
	if ( '' !== $options['header_right_call_text'] || '' !== $options['header_right_call_number'] || '' !== $options['header_right_button_text'] ) :

	?>
	<section id="call-to-action-widget" class="widget widget_text">
		<div class="widget-wrap">
			<?php
			if ( '' !== $options['header_right_call_text'] || '' !== $options['header_right_call_number'] ) :
			?>
			<div class="col col-1">
				<h2 class="widget-title"><?php echo wp_kses_post( $options['header_right_call_text'] ); ?></h2>
				<div class="textwidget"><p><?php echo wp_kses_post( $options['header_right_call_number'] ); ?></p></div>
			</div>
			<?php
			endif;
			?>

			<?php
			if ( '' !== $options['header_right_button_text'] ) :
			?>
			<div class="col col-2">
				<a href="<?php echo esc_url( $options['header_right_button_link'] ); ?>" class="button-minimal red" target="<?php echo $options['header_right_button_link_target']? '_blank' : '_self'; ?>"><?php echo esc_html( $options['header_right_button_text'] ); ?></a>
			</div>
			<?php
			endif;
			?>
		</div><!-- .widget-wrap -->
	</section>
	<?php
	endif;
	?>
</aside><!-- .sidebar .header-sidebar .widget-area -->

<?php
/**
 * decree_after_header_right hook
 */
do_action( 'decree_after_header_right' );
