<?php
/**
 * The template for displaying the Featured Content
 *
 * @package Decree
 */


if ( ! function_exists( 'decree_featured_content_display' ) ) :
	/**
	* Add Featured content.
	*
	* @uses action hook decree_before_content.
	*
	* @since Decree 0.1
	*/
	function decree_featured_content_display() {
		//decree_flush_transients();
		// get data value from options
		$options        = decree_get_theme_options();
		$enable_content = $options['featured_content_option'];

		if ( decree_check_section( $enable_content ) ) {
			if ( ! $output = get_transient( 'decree_featured_content' ) ) {
				$layouts 	 = $options['featured_content_layout'];
				$headline 	 = $options['featured_content_headline'];
				$subheadline = $options['featured_content_subheadline'];

				echo '<!-- refreshing cache -->';

				$classes[] = $layouts;

				$position = $options['featured_content_position'];

				if ( $position ) {
					$classes[] = ' border-top' ;
				}

				$output = '
					<div id="featured-content" class="sections ' . esc_attr( implode( ' ', $classes ) ) . '" role="complementary">
						<div class="wrapper">';

				if ( ! empty( $headline ) || ! empty( $subheadline ) ) {
					$output .= '<div class="section-heading-wrap">';

					if ( ! empty( $headline ) ) {
						$output .= '<div class="entry-header"><h2 id="featured-heading" class="entry-title section-title">' . wp_kses_post( $headline ) . '</h2></div>';
					}

					if ( ! empty( $subheadline ) ) {
						$output .= '<p>' . wp_kses_post( $subheadline ) . '</p>';
					}
					$output .= '</div><!-- .featured-heading-wrap -->';
				}

				$output .= '
				<div class="featured-content-wrap">
					<section class="widget widget_' . esc_attr( implode( ' ', $classes ) ) . '">' . decree_page_post_category_content( $options ) . '
					</section>
				</div><!-- .featured-content-wrap -->
			</div><!-- .wrapper -->
		</div><!-- #featured-content -->';
				set_transient( 'decree_featured_content', $output, 86940 );

			} // End if().

			echo $output;
		} // End if().
	}
endif;


if ( ! function_exists( 'decree_featured_content_display_position' ) ) :
	/**
	 * Homepage Featured Content Position
	 *
	 * @action decree_content, decree_after_secondary
	 *
	 * @since Decree 0.1
	 */
	function decree_featured_content_display_position() {
		// Getting data from Theme Options
		$options  = decree_get_theme_options();
		$position = $options['featured_content_position'];

		if ( $position ) {
			add_action( 'decree_after_content', 'decree_featured_content_display', 30 );
		} else {
			add_action( 'decree_before_content', 'decree_featured_content_display', 40 );
		}
	}
	endif; // decree_featured_content_display_position
add_action( 'decree_before', 'decree_featured_content_display_position' );


if ( ! function_exists( 'decree_page_post_category_content' ) ) :
	/**
	 * This function to display featured posts/post/category content
	 *
	 * @param $options: decree_theme_options from customizer
	 *
	 * @since Decree 0.1
	 */
	function decree_page_post_category_content( $options ) {
		$no_of_post   = 0; // for number of posts
		$post_list    = array();// list of valid post/page ids
		$quantity     = $options['featured_content_number'];
		$show_content = $options['featured_content_show'];

		$output     = '<div class="featured_content_slider_wrap">';

		$args = array(
			'post_type' => 'page',
			'orderby'   => 'post__in',
		);

		for ( $i = 1; $i <= $quantity; $i++ ) {
			$post_id = isset( $options[ 'featured_content_page_' . $i ] ) ? $options[ 'featured_content_page_' . $i ] : false;

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

			$output .= '
				<article id="featured-post-' . esc_attr( $loop->current_post ) . '" class="post hentry post">';

				//Default value if there is no first image
				$image = '<img class="wp-post-image" src="' . get_template_directory_uri() . '/images/no-featured-image-480x480.jpg" >';

				if ( has_post_thumbnail() ) {
					$image = get_the_post_thumbnail( get_the_ID(), 'post-thumbnail', array( 'title' => $title_attribute, 'alt' => $title_attribute ) );
				}
				else {
					//Get the first image in page, returns false if there is no image
					$first_image = decree_get_first_image( get_the_ID(), 'post-thumbnail', array( 'title' => $title_attribute, 'alt' => $title_attribute ) );

					//Set value of image as first image if there is an image present in the page
					if ( $first_image ) {
						$image = $first_image;
					}
				}

				$output .= '
					<figure class="featured-homepage-image">
						<a href="' . esc_url( get_permalink() ) . '" title="' . $title_attribute . '">
						'. $image . '
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
						}
						elseif ( 'full-content' === $show_content ) {
							$content = apply_filters( 'the_content', get_the_content() );
							$content = str_replace( ']]>', ']]&gt;', $content );
							$output .= '<div class="entry-content">' . $content . '</div><!-- .entry-content -->';
						}
					$output .= '
					</div><!-- .entry-container -->
				</article><!-- .featured-post-' . esc_attr( $loop->current_post ) . ' -->';

		} // endwhile;

		wp_reset_postdata();

		return $output;
	}
endif; // decree_post_content
