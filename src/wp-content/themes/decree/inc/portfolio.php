<?php
/**
 * The template for displaying Portfolio
 *
 * @package Decree
 */

if ( ! function_exists( 'decree_portfolio_display' ) ) :
	/**
	 * Add Featured content.
	 *
	 * @uses action hook decree_before_content.
	 *
	 * @since Decree 0.1
	 */
	function decree_portfolio_display() {
		// decree_flush_transients();
		$output = '';
		$options        = decree_get_theme_options();
		$enable_content = $options['portfolio_option'];

		if ( decree_check_section( $enable_content ) ) {
			if ( ! $output = get_transient( 'decree_portfolio' ) ) {
				$number      = $options['portfolio_number'];
				$headline    = $options['portfolio_headline'];
				$subheadline = $options['portfolio_subheadline'];
				$classes[]   = $options['portfolio_layout'];

				$output = '
					<div id="portfolios-content" class="sections ' . esc_attr( implode( ' ', $classes ) ) . '">
						<div class="wrapper">';

				if ( ! empty( $headline ) || ! empty( $subheadline ) ) {
					$output .= '
					<div class="portfolio-heading-wrap">';
					if ( ! empty( $headline ) ) {
						$output .= '
						<h2 id="portfolio-heading" class="entry-title section-title">' . wp_kses_post( $headline ) . '</h2>';
					}

					if ( ! empty( $subheadline ) ) {
						$output .= '
						<p>' . wp_kses_post( $subheadline ) . '</p>';
					}
					$output .= '
					</div><!-- .portfolio-heading-wrap -->';
				}

				$output .= '<div class="portfolio-wrap">';

				$output .= decree_portfolio_post_page_category_content( $options );

				$output .= '</div><!-- .portfolio-wrap -->
						</div><!-- .wrapper -->
					</div><!-- #portfolio -->';

				set_transient( 'decree_portfolio', $output, 86940 );
			} // End if().
		} // End if().

		echo $output;
	}
endif;
add_action( 'decree_before_content', 'decree_portfolio_display', 50 );


if ( ! function_exists( 'decree_portfolio_post_page_category_content' ) ) :
	/**
	 * This function to display header highlight posts/pages/category content
	 *
	 * @param $options: decree_theme_options from customizer
	 *
	 * @since Decree 0.1
	 */
	function decree_portfolio_post_page_category_content( $options ) {
		global $post;
		$quantity     = $options['portfolio_number'];
		$no_of_post   = 0; // for number of posts.
		$post_list    = array();// list of valid post/page ids.
		$show_content = $options['portfolio_show'];
		$output       = '';

		$args = array(
			'post_type' => 'page',
			'orderby'   => 'post__in',
		);

		// Get valid number of posts.
		for ( $i = 1; $i <= $quantity; $i++ ) {
			$post_id = isset( $options[ 'portfolio_page_' . $i ] ) ? $options[ 'portfolio_page_' . $i ] : false;

			if ( $post_id && '' !== $post_id ) {
				$post_list = array_merge( $post_list, array( $post_id ) );
				$no_of_post++;
			}
		}

		$args['post__in'] = $post_list;

		if ( 0 === $no_of_post ) {
			return;
		}

		$args['posts_per_page'] = $no_of_post;

		$loop = new WP_Query( $args );

		while ( $loop->have_posts() ) {
			$loop->the_post();

			$title_attribute = the_title_attribute( 'echo=0' );

			$excerpt = get_the_excerpt();

			if ( 0 === $loop->current_post ) {
				//Set article id to large-featured-image, if it is the first image
				$article_id = 'large-featured-image';
			} else {
				$article_id = 'portfolio-post-' . $loop->current_post;
			}

			$output .= '
			<article id="' . esc_attr( $article_id ) . '" class="post hentry post">';
			if ( has_post_thumbnail() ) {
				//Pull post thunbnail if it is present
				$thumbnail = get_the_post_thumbnail(
					get_the_ID(),
					'post-thumbnail',
					array(
						'title' => $title_attribute,
						'alt' => $title_attribute,
					)
				);
			} else {
				$first_image = decree_get_first_image(
					get_the_ID(),
					'post-thumbnail',
					array(
						'title' => $title_attribute,
						'alt' => $title_attribute,
						)
				);

				if ( $first_image ) {
					$thumbnail = $first_image;
				} else {
					$thumbnail = '<img class="wp-post-image" src="' . get_template_directory_uri() . '/images/no-featured-image-1920x800.jpg" >';
				}
			}

			$output .= '
				<figure class="portfolio-homepage-image">
					<a href="' . esc_url( get_permalink() ) . '">
					' . $thumbnail . '
					</a>
				</figure>';

			$output .= '
				<div class="entry-container">
					<header class="entry-header">
						<h2 class="entry-title">
							<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . the_title( '','', false ) . '</a>
						</h2>
					</header>';

			if ( 'excerpt' === $show_content ) {
				$output .= '<div class="entry-summary"><p>' . $excerpt . '</p></div><!-- .entry-summary -->';
			} elseif ( 'full-content' === $show_content ) {
				$content = apply_filters( 'the_content', get_the_content() );
				$content = str_replace( ']]>', ']]&gt;', $content );
				$output .= '<div class="entry-content">' . $content . '</div><!-- .entry-content -->';
			}

			$footer_class = '';

			if ( $options['portfolio_hide_category'] &&  $options['portfolio_hide_tags'] && $options['portfolio_hide_date'] && $options['portfolio_hide_author'] ) {
				$footer_class = 'screen-reader-text';
			}

			$output .= '
			<footer class="entry-footer ' . $footer_class . '">
				' . decree_get_highlight_meta(
				$options['portfolio_hide_category'],
				$options['portfolio_hide_tags'],
				$options['portfolio_hide_date'],
				$options['portfolio_hide_author']
			) . '
			</footer><!-- .entry-footer -->';

				$output .= '
				</div><!-- .entry-container -->
			</article><!-- .portfolio-post-' . esc_attr( $loop->current_post ) . ' -->';
		} // End while().
		wp_reset_postdata();

		return $output;
	}
endif; // decree_portfolio_post_page_category_content
