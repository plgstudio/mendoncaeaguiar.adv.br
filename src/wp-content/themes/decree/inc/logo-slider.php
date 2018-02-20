<?php
/**
 * The template for displaying the Slider
 *
 * @package Decree
 */



if ( ! function_exists( 'decree_logo_slider' ) ) :
	/**
	 * Add slider.
	 *
	 * @uses action hook decree_before_content.
	 *
	 * @since Decree 0.1
	 */
	function decree_logo_slider() {
		//decree_flush_transients();
		$output = '';

		// get data value from options
		$options       = decree_get_theme_options();
		$enable_slider = $options['logo_slider_option'];
		$layout        = $options['logo_slider_visible_items'];

		if ( decree_check_section( $enable_slider ) ) {
			if ( ! $output = get_transient( 'decree_logo_slider' ) ) {
				echo '<!-- refreshing cache -->';

				$class = array();

				if ( 1 === $layout ) {
					$class[] = 'one-column';
				} elseif ( 2 === $layout ) {
					$class[] = 'two-columns';
				} elseif ( 3 === $layout ) {
					$class[] = 'three-columns';
				} elseif ( 4 === $layout ) {
					$class[] = 'four-columns';
				} elseif ( 5 === $layout ) {
					$class[] = 'five-columns';
				}

				$output = '
					<div id="logo-section" class="sections ' . esc_attr( implode( ' ', $class ) ) . '">
						<div class="wrapper">';

				if ( '' !== $options['logo_slider_title'] || '' !== $options['logo_slider_description'] ) {
					$output .= '<div class="section-heading-wrap">';

					if ( '' !== $options['logo_slider_title'] ) {
						$output .= '<div class="entry-header"><h2 id="featured-heading" class="entry-title">' . $options['logo_slider_title'] . '</h2></div><!-- .entry-header -->';
					}

					if ( '' !== $options['logo_slider_description'] ) {
						$output .= '<p>' . $options['logo_slider_description'] . '</p>';
					}

					$output .= '</div><!-- .section-heading-wrap -->';
				}

				$output .= '
					<div class="logo_slider_content_slider_wrap cycle-slideshow section-content-wrap"
						data-cycle-log="false"
						data-cycle-pause-on-hover="true"
						data-cycle-swipe="true"
						data-cycle-fx=carousel
						data-cycle-carousel-fluid=true
						data-cycle-carousel-visible="' . absint( $options['logo_slider_visible_items'] ) . '"

						data-cycle-speed="' . esc_attr( $options['logo_slider_transition_length'] ) * 1000 . '"
						data-cycle-timeout="' . esc_attr( $options['logo_slider_transition_delay'] ) * 1000 . '"
						data-cycle-slides="> article"
						>';

				$output .= decree_post_page_category_logo_slider( $options );

				$output .= '
							</div><!-- .logo_slider_content_slider_wrap.cycle-slideshow -->
						</div><!-- .wrapper -->
					</div><!-- #slider-section -->';

				set_transient( 'decree_logo_slider', $output, 86940 );
			} // End if().
		} // End if().

		echo $output;
	}
endif;
add_action( 'decree_before_content', 'decree_logo_slider', 80 );


if ( ! function_exists( 'decree_post_page_category_logo_slider' ) ) :
	/**
	 * This function to display hero posts content
	 *
	 * @param $options: decree_theme_options from customizer
	 *
	 * @since Decree 0.1
	 */
	function decree_post_page_category_logo_slider( $options ) {
		$quantity   = $options['logo_slider_number'];
		$no_of_post = 0; // for number of posts
		$post_list  = array();// list of valid post/page ids
		$output     = '';

		$args = array(
			'post_type' => 'page',
			'orderby'   => 'post__in',
		);

		//Get valid number of posts
		for ( $i = 1; $i <= $quantity; $i++ ) {
			$post_id = isset( $options[ 'logo_slider_page_' . $i ] ) ? $options[ 'logo_slider_page_' . $i ] : false;

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
		$loop         = new WP_Query( $args );

		$i = 0;
		while ( $loop->have_posts() ) {
			$loop->the_post();

			$i++;

			$title_attribute = the_title_attribute( 'echo=0' );

			$output .= '
				<article id="post-' . $i . '" class="post-' . $i . ' hentry">';

			//Default value if there is no first image
			$image = '<img class="wp-post-image" src="' . get_template_directory_uri() . '/images/no-featured-image-480x480.jpg" >';

			if ( has_post_thumbnail() ) {
				$image = get_the_post_thumbnail( get_the_ID(), 'full', array( 'title' => $title_attribute, 'alt' => $title_attribute ) );
			} else {
				//Get the first image in page, returns false if there is no image
				$first_image = decree_get_first_image( get_the_ID(), 'full', array( 'title' => $title_attribute, 'alt' => $title_attribute ) );
				//Set value of image as first image if there is an image present in the page
				if ( $first_image ) {
					$image = $first_image;
				}
			}

				$output .= '
					<figure class="featured-content-image">
						<a href="' . esc_url( get_permalink() ) . '" title="' . $title_attribute . '">
						' . $image . '
						</a>
					</figure>';

				$output .= '
				</article><!-- .post-' . $i . ' -->';
		} // End while().

		wp_reset_postdata();

		return $output;
	}
endif; // decree_post_page_category_logo_slider
