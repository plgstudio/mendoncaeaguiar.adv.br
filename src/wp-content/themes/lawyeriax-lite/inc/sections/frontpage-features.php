<?php
/**
 * Frontpage Features Section
 *
 * @package LawyeriaX
 */

/**
 * Frontpage features
 */
function lawyeriax_features_lite() {
	$features_toggle    = get_theme_mod( 'lawyeriax_features_toggle', 0 );
	$first_feature_box  = get_theme_mod( 'first_feature_box' );
	$second_feature_box = get_theme_mod( 'second_feature_box' );
	$third_feature_box  = get_theme_mod( 'third_feature_box' );
	$fourth_feature_box = get_theme_mod( 'fourth_feature_box' );

	$box_ids = array(
	$first_feature_box,
	$second_feature_box,
	$third_feature_box,
	$fourth_feature_box,
	);

	if ( ! empty( $box_ids ) && array_sum( $box_ids ) > 0 ) {

		if ( isset( $features_toggle ) && ! $features_toggle ) {

			echo '<section id="features" class="features">';

		} elseif ( is_customize_preview() ) {

			echo '<section id="features" class="features hidden-in-customizer">';

		}
		?>
				<div class="container">
					<div class="home-section-inner feature-boxes-wrap">

						<?php
						foreach ( $box_ids as $id ) {
							if ( $id != 0 ) {
								$page = get_post( $id ); ?>

								<div class="col-xs-12 col-sm-6 col-md-3 feature-box">
									<div class="features-title">
										<span class="features-title-icon"><i class="fa fa-gavel"></i></span>

										<?php if ( ! empty( $page->post_title ) ) { ?>

											<div class="feature-title-wrap">
												<h3 class="feature-title"><?php echo esc_html( $page->post_title ); ?></h3>
											</div>

										<?php } ?>
									</div>
									<?php if ( ! empty( $page->post_excerpt ) ) { ?>
										<div class="border-left features-content">
											<div><?php echo esc_html( substr( $page->post_excerpt, 0, 100 ) ) . '...'; ?></div>
											<a href="<?php echo the_permalink( $id ); ?>" title="Read more"
											   class="read-more"> <?php echo __( 'Read more...', 'lawyeriax-lite' ) ?> </a>
										</div>

									<?php } elseif ( ! empty( $page->post_content ) ) { ?>

										<div class="border-left features-content">
											<div><?php echo esc_html( substr( $page->post_content, 0, 100 ) ) . '...'; ?></div>
											<a href="<?php echo the_permalink( $id ); ?>" title="Read more"
											   class="read-more"> <?php echo __( 'Read more...', 'lawyeriax-lite' ) ?> </a>
										</div>

									<?php } ?>

								</div>

								<?php
							}
						} ?>

					</div>
					<div class="col-sm-10 col-sm-offset-1 section-line"></div>
				</div><!-- .container -->
			</section>

			<?php }
}
?>
