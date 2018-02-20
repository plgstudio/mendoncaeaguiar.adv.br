<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @package Decree
 */

get_header();
?>

	<?php if ( have_posts() ) : ?>

		<?php if ( is_home() ) : ?>
			<?php
			$options = decree_get_theme_options();
			if ( '' !== $options['front_page_title'] || '' !== $options['front_page_description'] ) : ?>
				<div class="section-heading-wrap">
					<?php if ( '' !== $options['front_page_title'] ) : ?>
						<div class="entry-header">
							<h2 id="featured-heading" class="section-title entry-title"><?php echo wp_kses_data( $options['front_page_title'] ); ?></h2>
						</div>
					<?php endif; ?>

					<?php if ( '' !== $options['front_page_description'] ) : ?>
						<p><?php echo wp_kses_data( $options['front_page_description'] ); ?></p>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		<?php endif; ?>
		<?php /* Start the Loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>

			<?php
				/* Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'content', get_post_format() );
			?>

		<?php endwhile; ?>

		<?php decree_content_nav( 'nav-below' ); ?>

	<?php else : ?>

		<?php get_template_part( 'no-results', 'index' ); ?>

	<?php endif;

get_sidebar();
get_footer(); ?>
