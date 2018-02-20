<?php
/**
 * The Template for displaying all single posts
 *
 * @package Decree
 */

get_header();

?>

	<?php while ( have_posts() ) : the_post(); ?>

		<?php get_template_part( 'content', 'single' ); ?>

		<?php
			/**
			 * decree_after_post hook
			 *
			 * @hooked decree_post_navigation - 10
			 */
			do_action( 'decree_after_post' );

			/**
			 * decree_comment_section hook
			 *
			 * @hooked decree_get_comment_section - 10
			 */
			do_action( 'decree_comment_section' );
		?>
	<?php endwhile; // end of the loop. ?>

<?php

get_sidebar();

get_footer(); ?>
