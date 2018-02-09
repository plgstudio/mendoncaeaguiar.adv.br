<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package lawyeriax
 */

$copyright_string =
$footer_copyright = get_theme_mod( 'footer_copyright', apply_filters( 'lawyeriax_footer_copyright_filter', '<a href="https://themeisle.com/themes/lawyeriax-lite/" target="_blank" rel="nofollow">LawyeriaX Lite</a> powered by <a class="" href="http://wordpress.org/" target="_blank" rel="nofollow">WordPress</a>' ) );
$preloader_toggle = get_theme_mod( 'preloader_toggle', '1' );
?>
		</div><!-- .container -->
	</div><!-- #content -->

	<?php if ( is_active_sidebar( 'footer_widget_col_1' ) || is_active_sidebar( 'footer_widget_col_2' ) || is_active_sidebar( 'footer_widget_col_3' ) || ! empty( $footer_copyright ) ) { ?>
		<footer id="colophon" class="site-footer" role="contentinfo">
			<div class="container">
				<div class="col-sm-4">
			        <?php
			        if ( is_active_sidebar( 'footer_widget_col_1' ) ) {
						dynamic_sidebar( 'footer_widget_col_1' );
					}
					?>
			    </div>

				<div class="col-sm-4">
			        <?php
			        if ( is_active_sidebar( 'footer_widget_col_2' ) ) {
						dynamic_sidebar( 'footer_widget_col_2' );
					}
					?>
			    </div>
			    <div class="col-sm-4">
				    <?php
				    if ( is_active_sidebar( 'footer_widget_col_3' ) ) {
						dynamic_sidebar( 'footer_widget_col_3' );
					}
					?>
			    </div>
			</div><!-- .container -->

			<div class="container">
				<div class="site-info">
					<?php
					if ( is_active_sidebar( 'footer_widget_col_1' ) || is_active_sidebar( 'footer_widget_col_2' ) || is_active_sidebar( 'footer_widget_col_3' ) ) {
						echo '<div class="col-sm-10 col-sm-offset-1 section-line section-line-footer" ></div >';
					}
					?>

					<div class="site-info-inner">

						<?php
						if ( ! empty( $footer_copyright ) ) {
							echo $footer_copyright;
						}
						?>

					</div><!-- .site-info-inner -->

				</div><!-- .site-info -->
			</div>
		</footer><!-- #colophon -->
	<?php } ?>

	<?php if ( $preloader_toggle ) { ?>

		<div class="preloader">
			<div class="status">&nbsp;</div>
		</div>

	<?php } ?>


</div><!-- #page -->

<!-- Modal -->
<?php
	$pirate_form = isset( $_GET['pcf'] ) ? $_GET['pcf'] : '';
	$modal_shortcode = get_theme_mod( 'modal_shortcode', '[pirate_forms]' );
?>
<div class="modal fade<?php echo $pirate_form == '' ? '' : ' site-modal-open' ; ?>" id="siteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<button type="button" class="close modal-close-button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<div class="modal-content">
			<div class="modal-body">

				<?php $scd = htmlspecialchars_decode( $modal_shortcode, ENT_QUOTES );
				echo do_shortcode( $scd ); ?>

				<div class="clearfix"></div>
			</div>
		</div>
	</div>
</div>

<?php wp_footer(); ?>

</body>
</html>
