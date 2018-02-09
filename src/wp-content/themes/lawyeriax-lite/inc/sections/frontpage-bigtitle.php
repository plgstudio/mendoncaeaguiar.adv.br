<?php
/**
 * Frontpage Big Title Section
 *
 * @package LawyeriaX
 */

if ( ! function_exists( 'lawyeriax_big_title_section' ) ) :

	/**
	 * Big title section.
	 *
	 * @param data $data Big title content.
	 */
	function lawyeriax_big_title_section( $data ) {
		if ( ( ! empty( $data['title'] ) || ! empty( $data['text'] ) || ( ! empty( $data['button_text'] ) && ( ! empty( $data['button_link'] ) ) ) || $data['background'] != 'remove-header' ) ) { ?>
			<section class="header-slider">
				<div class="carousel">
					<div class="lawyeriax-lite-big-title">
						<div class="item-inner">
							<div class="carousel-caption">
								<div class="container">
									<?php
									if ( ! empty( $data['title'] ) ) { ?>
										<p class="col-md-8 carousel-title">
											<?php echo wp_kses_post( $data['title'] ); ?>
										</p>
										<?php
									}
									if ( ! empty( $data['text'] ) ) { ?>
										<p class="col-md-8 carousel-content">
											<?php echo wp_kses_post( $data['text'] ); ?>
										</p>
										<?php
									}
									if ( ! empty( $data['button_text'] ) && ! empty( $data['button_link'] ) ) { ?>
										<p class="col-md-8 carousel-button">
											<a href="<?php echo esc_url( $data['button_link'] ); ?>"
											   class="slider-button"
											   title="Title">
												<?php echo wp_kses_post( $data['button_text'] ); ?>
											</a>
										</p>
										<?php
									} ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<?php
		}
	}
endif;

/**
 * Add header image inline style.
 */
function lawyeriax_inline_style() {
	$header_image = get_theme_mod( 'header_image' );
	$custom_css   = '';
	if ( ! empty( $header_image ) ) {
		$custom_css .= '
                .lawyeriax-lite-big-title{
	                    background-image: url(' . esc_url( $header_image ) . ');
	                    background-size:cover;
	                    background-repeat: no-repeat;
	                    background-position: center center;
	            }';
		if ( is_admin_bar_showing() ) {
			$custom_css .= '.sticky-navigation{ top: 32px; }';
		}
	}
	wp_add_inline_style( 'lawyeriax-style', $custom_css );
}

add_action( 'wp_enqueue_scripts', 'lawyeriax_inline_style' );

