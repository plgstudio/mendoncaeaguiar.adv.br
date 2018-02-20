<?php
/**
 * The template for displaying Team
 *
 * @package Decree
 */



if ( ! function_exists( 'decree_team_display' ) ) :
	/**
	* Add Featured content.
	*
	* @uses action hook decree_before_content.
	*
	* @since Decree 0.1
	*/
	function decree_team_display() {
		//decree_flush_transients();
		// get data value from options
		$options        = decree_get_theme_options();
		$enable_content = $options['team_option'];
		if ( decree_check_section( $enable_content ) ) {
			if ( ( ! $output = get_transient( 'decree_team' ) ) ) {
				$layouts 	 = $options['team_layout'];
				$headline 	 = $options['team_headline'];
				$subheadline = $options['team_subheadline'];

				echo '<!-- refreshing cache -->';

				if ( ! empty( $layouts ) ) {
					$classes = $layouts ;
				}

				if ( '1' === $options['team_position'] ) {
					$classes .= ' border-top' ;
				}

				$output = '
					<div id="team-section" class="sections page ' . $classes . '">
						<div class="wrapper">';
				if ( ! empty( $headline ) || ! empty( $subheadline ) ) {
					$output .= '<div class="section-heading-wrap">';
					if ( ! empty( $headline ) ) {
						$output .= '<div class="entry-header">
							<h2 id="featured-heading" class="section-title entry-title">' . wp_kses_post( $headline ) . '</h2>
							</div>
						';
					}
					if ( ! empty( $subheadline ) ) {
						$output .= '<p>' . wp_kses_post( $subheadline ) . '</p>';
					}
					$output .= '</div><!-- .heading-wrap -->';
				}

				$output .= '
				<div class="section-content-wrap">';

				$output .= decree_post_page_category_team( $options );

				$output .= '
							</div><!-- .section-content-wrap -->
						</div><!-- .wrapper -->
					</div><!-- #team-section -->';

				set_transient( 'decree_team', $output, 86940 );
			} // End if().

			echo $output;
		} // End if().
	}
endif;


if ( ! function_exists( 'decree_team_display_position' ) ) :
	/**
	 * Homepage Team Position
	 *
	 * @action decree_content, decree_after_secondary
	 *
	 * @since Decree 0.1
	 */
	function decree_team_display_position() {
		// Getting data from Theme Options
		$options = decree_get_theme_options();

		if ( $options['team_position'] ) {
			add_action( 'decree_after_content', 'decree_team_display', 80 );
		} else {
			add_action( 'decree_before_content', 'decree_team_display', 90 );
		}
	}
endif; // decree_team_display_position
add_action( 'decree_before', 'decree_team_display_position' );


if ( ! function_exists( 'decree_post_page_category_team' ) ) :
	/**
	 * This function to display featured posts content
	 *
	 * @param $options: decree_theme_options from customizer
	 *
	 * @since Decree 0.1
	 */
	function decree_post_page_category_team( $options ) {
		global $post;

		$quantity   = $options['team_number'];
		$no_of_post = 0; // for number of posts
		$post_list  = array();// list of valid post/page ids
		$layouts    = 3;

		$output     = '';

		if ( 'layout-four' === $options['team_layout'] ) {
			$layouts = 4;
		}

		$args = array(
			'post_type' => 'page',
			'orderby'   => 'post__in',
		);

		//Get valid number of posts
		for ( $i = 1; $i <= $quantity; $i++ ) {
			$post_id = isset( $options[ 'team_page_' . $i ] ) ? $options[ 'team_page_' . $i ] : false;

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

		$i = 0;
		while ( $loop->have_posts() ) {

			$loop->the_post();

			$i++;

			$title_attribute = the_title_attribute( 'echo=0' );

			$output .= '
				<article id="featured-post-' . $i . '" class="post hentry post">';

				//Default value if there is no first image
				$image = '<img class="wp-post-image" src="' . get_template_directory_uri() . '/images/no-featured-image-480x480.jpg" >';

				if ( has_post_thumbnail() ) {
					$image = get_the_post_thumbnail( $post->ID, 'post-thumbnail', array( 'title' => $title_attribute, 'alt' => $title_attribute ) );
				} else {
					//Get the first image in page, returns false if there is no image
					$first_image = decree_get_first_image( $post->ID, 'post-thumbnail', array( 'title' => $title_attribute, 'alt' => $title_attribute ) );

					//Set value of image as first image if there is an image present in the page
					if ( $first_image ) {
						$image = $first_image;
					}
				}

				$output .= '
					<figure class="featured-content-image">
						<a href="' . esc_url( get_permalink() ) . '" title="' . $title_attribute . '">
						'. $image . '
						</a>
					</figure>';

				if ( $options['team_enable_title'] || 'hide-content' !== $options['team_show'] ) {
				$output .= '
					<div class="entry-container">';
					if ( $options['team_enable_title'] ) {
						$output .= '
							<header class="entry-header">
								<h2 class="entry-title">
									<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . the_title( '','', false ) . '</a>
								</h2>
							</header>';
					}

					if ( 'excerpt' === $options['team_show'] ) {
						//Show Excerpt
						$output .= '<div class="entry-summary"><p>' . get_the_excerpt() . '</p></div><!-- .entry-summary -->';
					}
					elseif ( 'full-content' === $options['team_show'] ) {
						//Show Content
						$content = apply_filters( 'the_content', get_the_content() );
						$content = str_replace( ']]>', ']]&gt;', $content );
						$output .= '<div class="entry-content">' . $content . '</div><!-- .entry-content -->';
					}
				}
				$output .= '
				</article><!-- .featured-post-' . $i . ' -->';
			} //endwhile

		wp_reset_postdata();

		return $output;
	}
endif; // decree_post_page_category_team
