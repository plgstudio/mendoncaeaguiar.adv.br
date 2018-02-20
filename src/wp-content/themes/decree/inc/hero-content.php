<?php
/**
 * The template for displaying the Hero Content
 *
 * @package Decree
 */


if ( ! function_exists( 'decree_hero_content_display' ) ) :
	/**
	* Add Featured content.
	*
	* @uses action hook decree_before_content.
	*
	* @since Decree 0.1
	*/
	function decree_hero_content_display() {
		//decree_flush_transients();
		$output = '';
		// get data value from options
		$options        = decree_get_theme_options();
		$enable_content = $options['hero_content_option'];

		if ( decree_check_section( $enable_content ) ) {
			if ( !$output = get_transient( 'decree_hero_content' ) ) {
				echo '<!-- refreshing cache -->';

				$output = '
				<div id="hero-section" class="sections page">
					<div class="wrapper">';
				$output .= decree_post_page_category_hero_content( $options );

				$output .= '
					</div><!-- .wrapper -->
				</div><!-- #hero-section -->';

				set_transient( 'decree_hero_content', $output, 86940 );
			} // End if().
		} // End if().

		echo $output;
	}
endif;
add_action( 'decree_before_content', 'decree_hero_content_display', 30 );


if ( ! function_exists( 'decree_post_page_category_hero_content' ) ) :
	/**
	 * This function to display hero posts content
	 *
	 * @param $options: decree_theme_options from customizer
	 *
	 * @since Decree 0.1
	 */
	function decree_post_page_category_hero_content( $options ) {
		$quantity   = $options['hero_content_number'];
		$no_of_post = 0; // for number of posts
		$post_list  = array();// list of valid post/page ids
		$output     = '';

		$args = array(
			'post_type' => 'page',
			'orderby'   => 'post__in',
		);

		for ( $i = 1; $i <= $quantity; $i++ ) {
			$post_id = isset( $options[ 'hero_content_page_' . $i ] ) ? $options[ 'hero_content_page_' . $i ] : false;

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

			$output .= '
				<article id="post-' . esc_attr( $loop->current_post ) . '" class="post-' . esc_attr( $loop->current_post ) . ' hentry has-post-thumbnail">';

				//Default value if there is no first image
				$image = '<img class="wp-post-image" src="' . get_template_directory_uri() . '/images/no-featured-image-635x476.jpg" >';

				if ( has_post_thumbnail() ) {
					$image = get_the_post_thumbnail( get_the_ID(), 'decree-hero', array( 'title' => $title_attribute, 'alt' => $title_attribute ) );
				}
				else {
					//Get the first image in page, returns false if there is no image
					$first_image = decree_get_first_image( get_the_ID(), 'decree-hero', array( 'title' => $title_attribute, 'alt' => $title_attribute ) );

					//Set value of image as first image if there is an image present in the page
					if ( $first_image ) {
						$image = $first_image;
					}
				}

				$output .= '
					<figure class="featured-image">
						<a href="' . esc_url( get_permalink() ) . '" title="' . $title_attribute . '">
						'. $image . '
						</a>
					</figure>';

				if ( $options['hero_content_enable_title'] || 'hide-content' !== $options['hero_content_show'] ) {
				$output .= '
					<div class="entry-container">
						<div class="entry-container-wrap">';

					if ( $options['hero_content_enable_title'] ) {
						$output .= '
						<header class="entry-header">
							<h2 class="entry-title section-title">
								<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . the_title( '','', false ) . '</a>
							</h2>
						</header>';
					}

					if ( 'excerpt' === $options['hero_content_show'] ) {
						//Show Excerpt
						$output .= '
						<div class="entry-summary">
							<p>' . get_the_excerpt() . '</p>
						</div><!-- .entry-content -->';
					}
					elseif ( 'full-content' === $options['hero_content_show'] ) {
						//Show Content
						$content = apply_filters( 'the_content', get_the_content() );
						$content = str_replace( ']]>', ']]&gt;', $content );
						$output .= '<div class="entry-content">' . $content . '</div><!-- .entry-content -->';
					}
				}
				$output .= '
						</div><!-- .entry-container-wrap -->
					</div><!-- .entry-container -->
				</article><!-- .post-'. esc_attr( $loop->current_post ) . ' -->';
			} //endwhile

		wp_reset_postdata();

		return $output;
	}
endif; // decree_post_page_category_hero_content
