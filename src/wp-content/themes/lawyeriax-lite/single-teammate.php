<?php
/**
 * Single Team Member
 *
 * @package lawyeriax
 */

$role_meta = get_post_meta( $post->ID, 'role_text', true );
$social_meta = get_post_meta( $post->ID,'social_icons',true );
$group_heading_meta = get_post_meta( $post->ID,'group_heading_text',true );
$terms = get_the_terms( $post->ID, 'member-group' );


get_header();
?>

	<div id="primary" class="col-sm-12 content-area">
		<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) : the_post(); ?>

	  <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	  	<div class="entry-content">
			<?php $member_image = get_the_post_thumbnail();

			if ( ! empty( $member_image ) ) { ?>

				<div class="lawyer-image">

				<?php the_post_thumbnail( 'teammate-single-page-thumbnail' ); ?>

				</div>

				<?php } ?>

	  		<div class="entry-content-lawyer">
	  			<header class="entry-header">
	  				<div class="entry-content-lawyer-top">
	  					<?php the_title( '<h1 class="entry-title">', '</h1>' );

						if ( ! empty( $role_meta ) ) {

								  echo '<h3>' . $role_meta . '</h3>';

						}

						if ( ! empty( $social_meta ) ) {

								echo '<p class="team-member-social-icons">';

							foreach ( $social_meta as $social_icon ) {

								if ( ! empty( $social_icon['title'] ) && ! empty( $social_icon['icons'] ) ) { ?>

											<a href="<?php echo esc_html( $social_icon['title'] ); ?>"><i class="fa <?php echo esc_html( $social_icon['icons'] );?>"></i></a>

							<?php }
							}

									echo '</p>';

						} ?>
	  				</div>
	  			</header><!-- .entry-header -->

	  			<?php
	  				the_content();

	  				wp_link_pages( array(
	  					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'lawyeriax-lite' ),
	  					'after'  => '</div>',
	  				) );
	  			?>
	  		</div>
	  	</div><!-- .entry-content -->




	  	<div class="practice-aria-lawyers-page">

	  		<?php	if ( ! empty( $group_heading_meta ) ) {

						echo '<h3>' . esc_html( $group_heading_meta ) . '</h3>';

}

if ( ! empty( $terms ) ) { ?>

	  		<div class="practice-aria-lawyers-inner">

	  			<ul class="practice-aria-lawyer">

				<?php foreach ( $terms as $term ) {

					echo '<li class="col-md-2"><a href="' . get_term_link( $term ) . '">' . esc_html( $term->name ) . '</a></li>';

} ?>

	  			</ul>

			<?php } ?>

	  		</div>

	  	</div>



	  	<footer class="entry-footer">
	  		<?php
	  			edit_post_link(
	  				sprintf(
	  					/* translators: %s: Name of current post */
	  					esc_html__( 'Edit %s', 'lawyeriax-lite' ),
	  					the_title( '<span class="screen-reader-text">"', '"</span>', false )
	  				),
	  				'<span class="edit-link">',
	  				'</span>'
	  			);
	  		?>
	  	</footer><!-- .entry-footer -->
	  </article><!-- #post-## -->

<?php
endwhile; // End of the loop.
?>

</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer(); ?>
