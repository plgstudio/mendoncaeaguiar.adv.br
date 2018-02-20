<?php
/**
 * The template for displaying Testimonial
 *
 * @package Decree
 */



if ( ! function_exists( 'decree_testimonial_display' ) ) :
	/**
	* Add Featured content.
	*
	* @uses action hook decree_before_content.
	*
	* @since Decree 0.1
	*/
	function decree_testimonial_display() {
		//decree_flush_transients();

		$output = '';

		// get data value from options
		$options        = decree_get_theme_options();
		$enable_content = $options['testimonial_option'];
		$slider_select  = $options['testimonial_slider'];

		if ( decree_check_section( $enable_content ) ) {
				if ( ! $output = get_transient( 'decree_testimonial' ) ) {
				echo '<!-- refreshing cache -->';

				$layouts 	 = $options['testimonial_layout'];
				$headline 	 = $options['testimonial_headline'];
				$subheadline = $options['testimonial_subheadline'];

				if ( ! empty( $layouts ) ) {
					$classes = $layouts ;
				}

				if ( $options['testimonial_position'] ) {
					$classes .= ' border-top' ;
				}

				$output = '
					<div id="testimonial-section" class="sections page ' . $classes . '">
						<div class="wrapper">';
				if ( ! empty( $headline ) || ! empty( $subheadline ) ) {
					$output .= '<div class="section-heading-wrap">';

					if ( ! empty( $headline ) ) {
						$output .= '<div class="entry-header"><h2 id="featured-heading" class="entry-title">' . wp_kses_post( $headline ) . '</h2></div>';
					}

					if ( ! empty( $subheadline ) ) {
						$output .= '<p>' . wp_kses_post( $subheadline ) . '</p>';
					}

					$output .= '
					</div><!-- .featured-heading-wrap -->';
				}
				$output .= '
							<div class="section-content-wrap">';

				if ( $slider_select ) {
					$output .= '
					<div class="cycle-slideshow"
					    data-cycle-log="false"
					    data-cycle-pause-on-hover="true"
					    data-cycle-swipe="true"
					    data-cycle-auto-height=container
						data-cycle-slides=".testimonial_slider_wrap"
						data-cycle-fx="fade"
						>

						<!-- prev/next links -->
			    		<div class="cycle-prev"></div>
			    		<div class="cycle-next"></div>';
				}

				$output .= decree_post_page_category_testimonial( $options );

				if ( $slider_select ) {
					$output .= '
					</div><!-- .cycle-slideshow -->';
				}

				$output .= '
							</div><!-- .section-content-wrap -->
						</div><!-- .wrapper -->
					</div><!-- #testimonial-section -->';

				set_transient( 'decree_testimonial', $output, 86940 );
			} // End if().
		} // End if().

		echo $output;
	}
endif;


if ( ! function_exists( 'decree_testimonial_display_position' ) ) :
	/**
	 * Homepage Testimonial Position
	 *
	 * @action decree_content, decree_after_secondary
	 *
	 * @since Decree 0.1
	 */
	function decree_testimonial_display_position() {
		// Getting data from Theme Options
		$options = decree_get_theme_options();

		if ( $options['testimonial_position'] ) {
			add_action( 'decree_after_content', 'decree_testimonial_display', 40 );
		} else {
			add_action( 'decree_before_content', 'decree_testimonial_display', 70 );
		}
	}
endif; // decree_testimonial_display_position
add_action( 'decree_before', 'decree_testimonial_display_position' );


if ( ! function_exists( 'decree_post_page_category_testimonial' ) ) :
	/**
	 * This function to display featured posts content
	 *
	 * @param $options: decree_theme_options from customizer
	 *
	 * @since Decree 0.1
	 */
	function decree_post_page_category_testimonial( $options ) {
		global $post;

		$quantity   = $options['testimonial_number'];
		$no_of_post = 0; // for number of posts
		$post_list  = array();// list of valid post/page ids
		$layouts    = 1;
		$output     = '';

		if ( 'two-columns' === $options['testimonial_layout'] ) {
			$layouts = 2;
		}

		$args = array(
			'post_type' => 'page',
			'orderby'   => 'post__in',
		);

		//Get valid number of posts
		for ( $i = 1; $i <= $quantity; $i++ ) {
			$post_id = isset( $options[ 'testimonial_page_' . $i ] ) ? $options[ 'testimonial_page_' . $i ] : false;


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
		$loop     = new WP_Query( $args );

		if ( $options['testimonial_slider'] ) {
			$output = '<div class="testimonial_slider_wrap">';
		}

		while ( $loop->have_posts() ) {
			$loop->the_post();

			$title_attribute = the_title_attribute( 'echo=0' );

			$i = absint( $loop->current_post + 1 );

			$output .= '
				<article id="testimonial-post-' . $i . '" class="status-publish has-post-thumbnail hentry">';

				//Default value if there is no first image
				$image = '<img class="wp-post-image" src="' . get_template_directory_uri() . '/images/no-featured-image-1680x720.jpg" >';

			if ( has_post_thumbnail() ) {
				$image = get_the_post_thumbnail( $post->ID, 'decree-small', array( 'title' => $title_attribute, 'alt' => $title_attribute ) );
			} else {
				// Get the first image in page, returns false if there is no image.
				$first_image = decree_get_first_image( $post->ID, 'decree-small', array( 'title' => $title_attribute, 'alt' => $title_attribute ) );

				// Set value of image as first image if there is an image present in the page.
				if ( $first_image ) {
					$image = $first_image;
				}
			}

				$output .= '
					<div class="entry-container">
						<div class="entry-container-wrap">';

			if ( 'excerpt' === $options['testimonial_show'] ) {
				//Show Excerpt
				$output .= '
					<div class="entry-summary"><p>' . get_the_excerpt() . '</p></div><!-- .entry-summary -->';
			} elseif ( 'full-content' === $options['testimonial_show'] ) {
				//Show Content
				$content = apply_filters( 'the_content', get_the_content() );
				$content = str_replace( ']]>', ']]&gt;', $content );
				$output .= '<div class="entry-content">' . $content . '</div><!-- .entry-content -->';
			}

			if ( $options['testimonial_enable_title'] ) {
				$output .= the_title( '<header class="entry-header"><h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2></header><!-- .entry-header -->', false );
			}

				$output .= '
						</div><!-- .entry-container-wrap -->
					</div><!-- .entry-container -->
					<figure class="featured-image">
						<a href="' . esc_url( get_permalink() ) . '" title="' . $title_attribute . '">
						' . $image . '
						</a>
					</figure>
				</article><!-- .featured-post-' . $i . ' -->';

			if ( 0 === ( $i % $layouts ) && $i < $no_of_post ) {
				//end and start testimonial_slider_wrap div based on logic
				if ( $options['testimonial_slider'] ) {
					$output .= '
					</div><!-- .testimonial_slider_wrap -->

					<div class="testimonial_slider_wrap">';
				}
			}
		} // End while().
		wp_reset_postdata();

		if ( $options['testimonial_slider'] ) {
			$output .= '
			</div><!-- .testimonial_slider_wrap -->';
		}

		return $output;
	}
endif; // decree_post_page_category_testimonial
