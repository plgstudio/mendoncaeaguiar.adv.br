<?php
/**
 * The template for displaying posts in the Quote post format
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package lawyeriax
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php
	if ( has_post_thumbnail() ) {
		echo '<div class="post-thumbnail">';
		echo '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">';
			the_post_thumbnail();
		echo '</a>';
		echo '</div>';
	}
	?> 

	<div class="entry-content entry-content-quote">

		<?php

			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( null, array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

		?>
	</div><!-- .entry-content -->

	<?php if ( ! is_single() ) { ?>
		<div class="col-sm-10 col-sm-offset-1 section-line section-line-blog-roll"></div><div class="clearfix"></div>
	<?php } ?>

</article><!-- #post-## -->
