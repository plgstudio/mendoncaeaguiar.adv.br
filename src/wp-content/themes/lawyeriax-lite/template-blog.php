<?php
/**
 * Template Name: Blog
 *
 * @package LawyeriaX
 */
get_header(); ?>

	<div class="content-wrap">

		<div id="primary" class="col-sm-12 col-md-9 content-area">
			<main id="main" class="site-main" role="main">

				<?php

				$lawyeriax_nr_posts = (get_option( 'posts_per_page' )) ? get_option( 'posts_per_page' ) : '8';

				$lawyeriax_paged = (get_query_var( 'paged' )) ? get_query_var( 'paged' ) : 1;

				$wp_query = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => $lawyeriax_nr_posts, 'paged' => $lawyeriax_paged ) );

				if ( $wp_query->have_posts() ) :

					/* Start the Loop */
					while ( $wp_query->have_posts() ) : $wp_query->the_post();

						/*
						 * Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'template-parts/content', get_post_format() );

					endwhile;

					the_posts_navigation();

				else :

					get_template_part( 'template-parts/content', 'none' );

				endif;
				wp_reset_postdata();

				?>

			</main><!-- #main -->
		</div><!-- #primary -->

		<?php
		get_sidebar();
		?>

	</div><!-- .content-wrap -->

<?php
get_footer();
