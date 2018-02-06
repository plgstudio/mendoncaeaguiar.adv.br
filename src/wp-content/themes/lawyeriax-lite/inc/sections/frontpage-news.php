<?php
/**
 * Frontpage News Section
 *
 * @package LawyeriaX
 */

if ( ! function_exists( 'lawyeriax_news_section' ) ) {
	/**
	 * Latest news section
	 */
	function lawyeriax_news_section() {

		$rnews_toggle  = get_theme_mod( 'lawyeriax_news_toggle', 0 );
		$news_heading = get_theme_mod( 'news_heading', esc_html__( 'Latest News','lawyeriax-lite' ) );
		$news_category = get_theme_mod( 'news_category' );

		$args = array(
			'cat'       => $news_category,
			'showposts' => 3,
		);

		if ( isset( $rnews_toggle ) && ! $rnews_toggle ) {

			echo '<section id="news" class="home-section news">';

		} elseif ( is_customize_preview() ) {

			echo '<section id="news" class="home-section news hidden-in-customizer">';

		}

		if ( ( isset( $rnews_toggle ) && ! $rnews_toggle ) || is_customize_preview() ) { ?>

			<div class="container">
				<?php
				if ( ! empty( $news_heading ) ) {
					echo '<div class="home-section-title-wrap">';
					echo '<h2 class="home-section-title">' . wp_kses_post( force_balance_tags( $news_heading ) ) . '</h2>';
					echo '</div>';
				}
				?>

				<div class="home-section-inner latest-news">
					<!-- Posts Loop -->
					<?php
					$the_query = new WP_Query( $args );
					if ( $the_query->have_posts() ) {
						while ( $the_query->have_posts() ) {
							$the_query->the_post();
							get_template_part( 'template-parts/content-home-single', get_post_format() );
						}
						wp_reset_postdata();
					}
					?>
				</div>

				<div class="col-sm-10 col-sm-offset-1 section-line"></div>
				</div><!-- .container -->
		</section>

	<?php }
	}
}
