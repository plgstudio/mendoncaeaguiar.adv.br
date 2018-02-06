<?php
/**
 * Frontpage Ribbon Section
 *
 * @package LawyeriaX
 */

if ( ! function_exists( 'lawyeriax_ribbon_section' ) ) {

	/**
	 * Ribbon sections
	 */
	function lawyeriax_ribbon_section() {

		$ribbon_toggle  = get_theme_mod( 'lawyeriax_ribbon_toggle', 0 );
		$ribbon_tagline = get_theme_mod( 'lawyeriax_ribbon_tagline', esc_html__( 'The safety of the people shall be the highest law.', 'lawyeriax-lite' ) );

		if ( isset( $ribbon_toggle ) && ! $ribbon_toggle ) {

			echo '<section id="ribbon" class="home-section ribbon">';

		} elseif ( is_customize_preview() ) {

			echo '<section id="ribbon" class="home-section ribbon hidden-in-customizer">';

		}

		if ( ( isset( $ribbon_toggle ) && ! $ribbon_toggle ) || is_customize_preview() ) { ?>

			<div class="container">
				<div class="home-section-inner">
					<p class="ribbon-big-title"><?php echo wp_kses_post( force_balance_tags( $ribbon_tagline ) ); ?></p>
				</div>
				<div class="col-sm-10 col-sm-offset-1 section-line"></div>
			</div><!-- .container -->
			</section>

			<?php
		}
	}
}
