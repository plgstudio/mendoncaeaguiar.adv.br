<?php
/**
 * Frontpage Slider Section
 *
 * @package LawyeriaX
 */

if ( ! function_exists( 'lawyeriax_slider_section' ) ) :
	/**
	 * Slider section
	 */
	function lawyeriax_slider_section() {

		$default                    = lawyeriax_get_slider_shortcode();
		$lawyeriax_slider_shortcode = get_theme_mod( 'lawyeriax_slider_shortcode', $default );

		if ( ! empty( $lawyeriax_slider_shortcode ) ) {
			echo do_shortcode( $lawyeriax_slider_shortcode );
			return;
		}

		$slider_toggle = get_theme_mod( 'lawyeriax_slider_toggle', 0 );
		$slider_content = get_theme_mod( 'lawyeriax_slider_content', apply_filters( 'lawyeriax_filter_slider_defaults', '' ) );
		$slides_counter = 0;
		$var1           = 0;
		$classes_to_add = ! $slider_toggle && isset( $slider_toggle ) ? 'header-slider' : ( is_customize_preview() ? 'header-slider hidden-in-customizer' : '');
		if ( ! empty( $classes_to_add ) ) { ?>
			<section id="slider" class="<?php echo esc_attr( $classes_to_add ); ?>">
				<div id="main-slider" class="carousel slide" data-ride="carousel">
					<div class="carousel-inner" role="listbox">
						<?php
						$slider_content_decoded = json_decode( $slider_content );
						if ( ! empty( $slider_content_decoded ) ) { ?>
							<?php
							foreach ( $slider_content_decoded as $slider_content ) {
								$slider_image = apply_filters( 'lawyeriax_translate_single_string', $slider_content->image_url, 'Slider Content Image' );
								$slider_title = apply_filters( 'lawyeriax_translate_single_string', html_entity_decode( $slider_content->title ), 'Slider Content Title' );
								$slider_text = apply_filters( 'lawyeriax_translate_single_string', html_entity_decode( $slider_content->text ), 'Slider Content Text' );
								$slider_button_text = apply_filters( 'lawyeriax_translate_single_string', html_entity_decode( $slider_content->button_text ), 'Slider Content Button Text' );
								$slider_button_link = apply_filters( 'lawyeriax_translate_single_string', strip_tags( $slider_content->link ), 'Slider Content Link' );
								$classes_to_add = $var1 === 0 ? 'item active' : 'item'; ?>

								<div class="<?php echo esc_attr( $classes_to_add ); ?>" style="background-image: url('<?php echo esc_url( $slider_image ); ?>')">
									<div class="item-inner">
										<div class="carousel-caption">
											<div class="container">
												<p class="col-md-8 carousel-title">
													<?php
													echo wp_kses_post( $slider_title ); ?>
												</p>

												<div class="col-md-8 carousel-content">
													<?php
													echo wp_kses_post( $slider_text ); ?>
												</div>

												<?php
												if ( ( ! empty( $slider_button_text ) ) && ( ! empty( $slider_button_link ) ) ) { ?>
													<p class="col-md-8 carousel-button">
														<a href=" <?php echo esc_url( $slider_button_link ); ?>" class="slider-button" title="Title">
															<?php
															echo wp_kses_post( $slider_button_text ); ?>
														</a>
													</p>
													<?php
												} ?>
											</div>
										</div>
									</div>
								</div>
								<?php
								$var1 ++;
							} ?>
							<?php
						} ?>
					</div>


					<?php
					if ( $var1 > 1 ) { ?>
						<ol class="carousel-indicators">
							<?php
							foreach ( $slider_content_decoded as $slider_content ) {
								$classes_to_add = $slides_counter === 0 ? 'active' : ''; ?>
								<li data-target="#main-slider" data-slide-to="<?php echo esc_attr( $slides_counter ); ?>" class="<?php echo esc_attr( $classes_to_add ); ?>"></li>
								<?php
								$slides_counter ++;
							} ?>
						</ol>
						<?php
					} ?>

					<?php
					if ( $slides_counter > 1 ) : ?>

						<a class="left carousel-control" href="#main-slider" role="button" data-slide="prev">
							<span class="fa fa-angle-left" aria-hidden="true"></span>
							<span class="sr-only"><?php esc_html_e( 'Previous', 'lawyeriax-lite' ) ?></span>
						</a>
						<a class="right carousel-control" href="#main-slider" role="button" data-slide="next">
							<span class="fa fa-angle-right" aria-hidden="true"></span>
							<span class="sr-only"><?php esc_html_e( 'Next', 'lawyeriax-lite' ) ?></span>
						</a>

					<?php endif; ?>
				</div>
			</section><!-- #slider -->
			<?php
		}

	}

endif;

if ( ! function_exists( 'lawyeriax_slider_register_strings' ) ) :

	/**
	 * Register polylang strings
	 */
	function lawyeriax_slider_register_strings() {
		$default = '';
		apply_filters( 'lawyeriax_filter_slider_defaults', $default );
		lawyeriax_pll_string_register_helper( 'lawyeriax_slider_content', $default, 'Slider section' );
	}

endif;

if ( function_exists( 'lawyeriax_slider_register_strings' ) ) {
	add_action( 'after_setup_theme', 'lawyeriax_slider_register_strings', 11 );
}

