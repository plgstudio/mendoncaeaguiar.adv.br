<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package lawyeriax
 */

get_header(); ?>

	<div class="content-wrap">

		<div id="primary" class="col-sm-12 col-md-9 content-area">
			<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'single' );

				echo '<div class="clearfix"></div><div class="col-sm-10 col-sm-offset-1 section-line section-line-post"></div><div class="clearfix"></div>';
				the_post_navigation();

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>

			</main><!-- #main -->
		</div><!-- #primary -->

		<?php
		get_sidebar();
		?>

	</div><!-- .content-wrap -->

<?php
	get_footer();
