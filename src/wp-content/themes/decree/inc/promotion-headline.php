<?php
/**
 * The template for displaying the Promotion Headline
 *
 * @package Decree
 */


if ( ! function_exists( 'decree_promo_head_display' ) ) :
	/**
	* Add Promotion Headline.
	*
	* @uses action hook decree_before_content
	*
	* @since Decree 0.1
	*/
	function decree_promo_head_display() {
		//decree_flush_transients();
		$output = '';

		$options        = decree_get_theme_options();
		$enable_content = $options['promo_head_option'];

		if ( decree_check_section( $enable_content ) ) {
			if ( ! $output = get_transient( 'decree_promotion_headline' ) ) {
				echo '<!-- refreshing cache -->';

				$output = '
					<div id="promotion-headline-section" class="sections page">
						<div class="wrapper">';
				$output .= decree_post_page_category_promotion_headline( $options );

				$output .= '
						</div><!-- .wrapper -->
					</div><!-- #promotion-section -->';

				set_transient( 'decree_promotion_headline', $output, 86940 );
			}

		}
		echo $output;
	}
endif;
add_action( 'decree_before_content', 'decree_promo_head_display', 60 );


if ( ! function_exists( 'decree_post_page_category_promotion_headline' ) ) :
	/**
	 * This function to display hero posts content
	 *
	 * @since Decree 0.1
	 */
	function decree_post_page_category_promotion_headline( $options ) {
		if ( ! isset( $options['promo_head_page'] ) ) {
			return;
		}
		global $post;

		$more_text = $options['excerpt_more_text'];
		$output    = '';

		$args = array(
			'posts_per_page' => 1,
			'post_type'      => 'page',
			'p'              => absint( $options['promo_head_page'] ),
		);


		$loop = new WP_Query( $args );
		while ( $loop->have_posts() ) {
			$loop->the_post();

			$content_show = $options['promo_head_show'];
			$content      = '';

			if ( 'excerpt' === $content_show ) {
				$content = get_the_excerpt();
			} elseif ( 'full-content' === $content_show ) {
				$content = apply_filters( 'the_content', get_the_content() );

				$content = str_replace( ']]>', ']]&gt;', $content );

			} else {
				$content = '<span class="promotion-buttons more-button"><span class="readmore button-one"><a class="button-minimal" href="' . esc_url( get_permalink() ) . '">' . esc_html( $more_text ) . '</a></span></span>';
			}

			if ( '' !== $content ) {
				$content = '<p>' . $content . '</p>';
			}

			$output .= the_title( '<h2 class="entry-title section-title ' . esc_attr( $post->ID ) . '">','</h2>', false ) . $content;
		} // End while().

		wp_reset_postdata();

		return $output;
	}
endif; // decree_post_page_category_promotion_headline
