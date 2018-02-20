<?php
/**
 * The template for displaying Comments
 *
 * @package Decree
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<p class="comments-title">
		<?php
		$comments_number = get_comments_number();
		if ( '1' === $comments_number ) {
			/* translators: %s: post title */
			printf( esc_html_x( 'One Reply to &ldquo;%s&rdquo;', 'comments title', 'decree' ), get_the_title() );
		} else {
			printf(
				/* translators: 1: number of comments, 2: post title */
				esc_html(
					_nx(
						'%1$s Reply to &ldquo;%2$s&rdquo;',
						'%1$s Replies to &ldquo;%2$s&rdquo;',
						$comments_number,
						'comments title',
						'decree'
					)
				),
				esc_html( number_format_i18n( $comments_number ) ),
				get_the_title()
			);
		}
		?>
		</p>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through? ?>
		<nav id="comment-nav-above" class="comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'decree' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'decree' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'decree' ) ); ?></div>
		</nav><!-- #comment-nav-above -->
		<?php endif; // check for comment navigation. ?>

		<ol class="comment-list">
			<?php
				/**
				 * Loop through and list the comments. Tell wp_list_comments()
				 * to use decree_comment() to format the comments.
				 * If you want to overload this in a child theme then you can
				 * define decree_comment() and that will be used instead.
				 * See decree_comment() in decree/functions.php for more.
				 */
				wp_list_comments( array(
					'callback' => 'decree_comment',
					'style' => 'ol',
					'avatar_size' => 48,
					'short_ping' => true,
				) );
			?>
		</ol>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through? ?>
		<nav id="comment-nav-below" class="comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'decree' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'decree' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'decree' ) ); ?></div>
		</nav><!-- #comment-nav-below -->
		<?php endif; // check for comment navigation. ?>

	<?php endif; // have_comments(). ?>

	<?php
	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && '0' !== get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'decree' ); ?></p>
	<?php endif; ?>

	<?php comment_form(); ?>

</div><!-- #comments -->
