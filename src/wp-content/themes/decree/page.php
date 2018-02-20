<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Decree
 */

get_header();
$options = decree_get_theme_options();

?>

	<?php while ( have_posts() ) : the_post(); ?>

		<?php get_template_part( 'content', 'page' ); ?>

		<?php
			/**
			 * Name: decree_comment_section hook.
			 *
			 * @hooked decree_get_comment_section - 10
			 */
			do_action( 'decree_comment_section' );
		?>

	<?php endwhile; // end of the loop. ?>

<?php
get_sidebar();
get_footer();
