<?php
/**
 * The template for displaying the Slider
 *
 * @package Decree
 */

if( ! function_exists( 'decree_featured_slider' ) ) :
	/**
	 * Add slider
	 *
	 * @uses action hook decree_before_content.
	 *
	 * @since Decree 0.1
	 */
	function decree_featured_slider() {
		//decree_flush_transients();
		$output = '';

		// get data value from options
		$options 		= decree_get_theme_options();
		$enable_slider 	= $options['featured_slider_option'];
		$image_loader	= $options['featured_slider_image_loader'];

		if ( decree_check_section( $enable_slider ) ) {
			if( ! $output = get_transient( 'decree_featured_slider' ) ) {
				echo '<!-- refreshing cache -->';

				$output = '
					<div id="feature-slider" class="sections">
						<div class="wrapper">
							<div class="cycle-slideshow"
								data-cycle-log="false"
								data-cycle-pause-on-hover="true"
								data-cycle-swipe="true"
								data-cycle-auto-height=container
								data-cycle-fx="' . esc_attr( $options['featured_slider_transition_effect'] ) . '"
								data-cycle-speed="' . esc_attr( $options['featured_slider_transition_length'] ) * 1000 . '"
								data-cycle-timeout="' . esc_attr( $options['featured_slider_transition_delay'] ) * 1000 . '"
								data-cycle-loader="' . esc_attr( $image_loader ) . '"
								data-cycle-slides="> article"
								>

								<!-- prev/next links -->
								<div class="cycle-prev"></div>
								<div class="cycle-next"></div>

								<!-- empty element for pager links -->
								<div class="cycle-pager"></div>';
								// Select Slider

				$output .= decree_post_page_category_slider( $options );

				$output .= '
							</div><!-- .cycle-slideshow -->
						</div><!-- .wrapper -->
					</div><!-- #feature-slider -->';
				set_transient( 'decree_featured_slider', $output, 86940 );
			} // End if().
		} // End if().

		echo $output;
	}
endif;
add_action( 'decree_before_content', 'decree_featured_slider', 10 );


if ( ! function_exists( 'decree_post_page_category_slider' ) ) :
	/**
	 * This function to display featured posts/page/category slider
	 *
	 * @param $options: decree_theme_options from customizer
	 *
	 * @since Decree 0.1
	 */
	function decree_post_page_category_slider( $options ) {
		$quantity   = $options['featured_slider_number'];
		$no_of_post = 0; // for number of posts
		$post_list  = array();// list of valid post/page ids
		$output     = '';

		$args = array(
			'post_type' => 'page',
			'orderby'   => 'post__in',
		);

		//Get valid number of posts
		for ( $i = 1; $i <= $quantity; $i++ ) {
			$post_id = isset( $options[ 'featured_slider_page_' . $i ] ) ? $options[ 'featured_slider_page_' . $i ] : false;

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

			$classes = 'post post-' . esc_attr( get_the_ID() ) . ' hentry slides displaynone';

			if ( 0 === $loop->current_post ) {
				$classes = 'post post-' . esc_attr( get_the_ID() ) . ' hentry slides displayblock';
			}

			$output .= '
			<article class="' . $classes . '">
				<figure class="slider-image">';
				if ( has_post_thumbnail() ) {
					$output .= '<a title="' . $title_attribute . '" href="' . esc_url( get_permalink() ) . '">
						'. get_the_post_thumbnail( get_the_ID(), 'decree-slider', array( 'title' => $title_attribute, 'alt' => $title_attribute, 'class'	=> 'attached-post-image' ) ).'
					</a>';
				}
				else {
					//Default value if there is no first image
					$decree_image = '<img class="wp-post-image" src="' . get_template_directory_uri() . '/images/no-featured-image-1920x800.jpg" >';

					//Get the first image in page, returns false if there is no image
					$decree_first_image = decree_get_first_image( get_the_ID(), 'decree-slider', array( 'title' => $title_attribute, 'alt' => $title_attribute, 'class' => 'attached-post-image' ) );

					//Set value of image as first image if there is an image present in the page
					if ( '' !== $decree_first_image ) {
						$decree_image =	$decree_first_image;
					}

					$output .= '<a title="' . $title_attribute . '" href="' . esc_url( get_permalink() ) . '">
						'. $decree_image . '
					</a>';
				}

				$output .= '
				</figure><!-- .slider-image -->
				<div class="slider-content-wrapper">
					<div class="entry-container">
						<div class="container">
							<header class="entry-header">
								<h2 class="entry-title">
									<a title="' . $title_attribute . '" href="' . esc_url( get_permalink() ) . '">'.the_title( '<span>','</span>', false ).'</a>
								</h2>
							</header>
								';

							$output .= '<div class="entry-summary"><p>' . get_the_excerpt() . '</p></div><!-- .entry-summary -->';

							$output .= '
						</div><!-- .container -->
					</div><!-- .entry-container -->
				</div><!-- .slider-content-wrapper -->
			</article><!-- .slides -->';
		} // endwhile;

		wp_reset_postdata();

		return $output;
	}
endif; // decree_post_page_category_slider
