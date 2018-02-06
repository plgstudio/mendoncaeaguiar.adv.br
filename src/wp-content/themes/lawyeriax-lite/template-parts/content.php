<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package lawyeriax
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="post-thumbnail">
		<?php
		if ( has_post_thumbnail() ) {
			echo '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">';
			the_post_thumbnail();
			echo '</a>';
		}
		?>
	</div>

	<header class="border-left entry-header">
		<?php
		if ( is_single() ) {
			the_title( '<h1 class="entry-title">', '</h1>' );
		} else {
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		}

		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php lawyeriax_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php
		endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">

		<?php

			$pos = strpos( $post->post_content, '<!--more-->' );

		if ( $pos <= 0 ) {
			the_excerpt();
		} else {
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'lawyeriax-lite' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );
		}

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'lawyeriax-lite' ),
				'after'  => '</div>',
			) );
		?>
	<a href="<?php echo the_permalink( $id ); ?>" title="Read more" class="read-more"> <?php echo __( 'Read more...', 'lawyeriax-lite' ) ?> </a>
	</div><!-- .entry-content -->


	<footer class="entry-footer">
		<?php lawyeriax_entry_footer(); ?>
	</footer><!-- .entry-footer -->

	<?php if ( ! is_single() ) { ?>
		<div class="col-sm-10 col-sm-offset-1 section-line section-line-blog-roll"></div><div class="clearfix"></div>
	<?php } ?>

</article><!-- #post-## -->
