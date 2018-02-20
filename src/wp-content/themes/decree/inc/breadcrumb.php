<?php
/**
 * The template for displaying the Breadcrumb
 *
 * @package Decree
 */

/**
 * Add breadcrumb.
 *
 * @action decree_after_header
 *
 * @since Decree 0.1
 */
if ( ! function_exists( 'decree_add_breadcrumb' ) ) :

	/**
	 * Breadcrumb display
	 *
	 * @return string breadcrumb output.
	 */
	function decree_add_breadcrumb() {
		$options 	= decree_get_theme_options(); // Get options.

		if ( $options['breadcrumb_option'] ) {
			$show_on_home = $options['breadcrumb_on_homepage'];

			$delimiter = '<span class="sep">' . wp_kses_post( $options['breadcrumb_seperator'] ) . '</span><!-- .sep -->'; // delimiter between crumbs.

			echo decree_custom_breadcrumbs( $show_on_home, $delimiter );
		} else {
			return false;
		}
	}

endif;
add_action( 'decree_after_header', 'decree_add_breadcrumb', 60 );


if ( ! function_exists( 'decree_custom_breadcrumbs' ) ) :
	/**
	 * Breadcrumb Lists
	 * Allows visitors to quickly navigate back to a previous section or the root page.
	 *
	 * Adopted from Dimox
	 *
	 * @since Decree 0.1
	 */
	function decree_custom_breadcrumbs( $show_on_home, $delimiter ) {

		/* === OPTIONS === */
		$text['home']     = esc_html__( 'Home', 'decree' ); // text for the 'Home' link
		$text['category'] = esc_html__( '%1$s Archive for %2$s', 'decree' ); // text for a category page
		$text['search']   = esc_html__( '%1$sSearch results for: %2$s', 'decree' ); // text for a search results page
		$text['tag']      = esc_html__( '%1$sPosts tagged %2$s', 'decree' ); // text for a tag page
		$text['author']   = esc_html__( '%1$sView all posts by %2$s', 'decree' ); // text for an author page
		$text['404']      = esc_html__( 'Error 404', 'decree' ); // text for the 404 page

		$show_current = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show.
		$before       = '<span class="breadcrumb-current">'; // tag before the current crumb
		$after        = '</span>'; // tag after the current crumb
		/* === END OF OPTIONS === */

		global $post, $paged, $page;
		$homelink   = home_url( '/' );
		$link_before = '<span class="breadcrumb" typeof="v:Breadcrumb">';
		$link_after  = '</span>';
		$link_attr   = ' rel="v:url" property="v:title"';
		$link       = $link_before . '<a' . $link_attr . ' href="%1$s">%2$s ' . $delimiter . '</a>' . $link_after;

		if ( is_front_page() ) {
			if ( $show_on_home ) {
				echo '<div id="breadcrumb-list">
					<div class="wrapper">';

					echo $link_before . '<a href="' . esc_url( $homelink ) . '">' . $text['home'] . '</a>' . $link_after;

					echo '</div><!-- .wrapper -->
				</div><!-- #breadcrumb-list -->';
			}
		} else {
			echo '<div id="breadcrumb-list">
					<div class="wrapper">';

			echo sprintf( $link, $homelink, $text['home'] );

			if ( is_home() ) {
				if ( $show_current ) {
					echo $before . get_the_title( get_option( 'page_for_posts', true ) ) . $after;
				}
			} elseif ( is_category() ) {
				$this_cat = get_category( get_query_var( 'cat' ), false );

				if ( 0 !== $this_cat->parent ) {
					$cats = get_category_parents( $this_cat->parent, true, false );
					$cats = str_replace( '<a', $link_before . '<a' . $link_attr, $cats );
					$cats = str_replace( '</a>', $delimiter . '</a>' . $link_after, $cats );
					echo $cats;
				}

				echo $before . sprintf( $text['category'], '<span class="archive-text">', '&nbsp</span>' . single_cat_title( '', false ) ) . $after;

			} elseif ( is_search() ) {
				echo $before . sprintf( $text['search'], '<span class="search-text">', '&nbsp</span>' . get_search_query() ) . $after;
			} elseif ( is_day() ) {
				echo sprintf( $link, get_year_link( get_the_time( 'Y' ) ), get_the_time( 'Y' ) );
				echo sprintf( $link, get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ), get_the_time( 'F' ) );
				echo $before . get_the_time( 'd' ) . $after;
			} elseif ( is_month() ) {
				echo sprintf( $link, get_year_link( get_the_time( 'Y' ) ), get_the_time( 'Y' ) );
				echo $before . get_the_time( 'F' ) . $after;
			} elseif ( is_year() ) {
				echo $before . get_the_time( 'Y' ) . $after;

			} elseif ( is_single() && ! is_attachment() ) {
				if ( 'post' !== get_post_type() ) {
					$post_type = get_post_type_object( get_post_type() );
					$post_link = get_post_type_archive_link( $post_type->name );
					printf( $link, esc_url( $post_link ), $post_type->labels->singular_name );
					if ( $show_current ) {
						echo $before . get_the_title() . $after;
					}
				} else {
					$cat  = get_the_category();
					$cat  = $cat[0];
					$cats = get_category_parents( $cat, true, '' );
					if ( ! $show_current ) {
						$cats = preg_replace( '#^(.+)$#', '$1', $cats );
					}
					$cats = str_replace( '<a', $link_before . '<a' . $link_attr, $cats );
					$cats = str_replace( '</a>', $delimiter . '</a>' . $link_after, $cats );
					echo $cats;
					if ( $show_current ) {
						echo $before . get_the_title() . $after;
					}
				}
			} elseif ( ! is_single() && ! is_page() && 'post' !== get_post_type() && ! is_404() ) {
				$post_type = get_post_type_object( get_post_type() );
				echo isset( $post_type->labels->singular_name ) ? $before . $post_type->labels->singular_name . $after : '';
			} elseif ( is_attachment() ) {
				$parent = get_post( $post->post_parent );
				$cat    = get_the_category( $parent->ID );

				if ( isset( $cat[0] ) ) {
					$cat = $cat[0];
				}

				if ( $cat ) {
					$cats = get_category_parents( $cat, true );
					$cats = str_replace( '<a', $link_before . '<a' . $link_attr, $cats );
					$cats = str_replace( '</a>', $delimiter . '</a>' . $link_after, $cats );
					echo $cats;
				}

				printf( $link, get_permalink( $parent ), $parent->post_title );
				if ( $show_current ) {
					echo $before . get_the_title() . $after;
				}
			} elseif ( is_page() && ! $post->post_parent ) {
				if ( $show_current ) {
					echo $before . get_the_title() . $after;
				}
			} elseif ( is_page() && $post->post_parent ) {
				$parent_id   = $post->post_parent;
				$breadcrumbs = array();

				while ( $parent_id ) {
					$page_child    = get_post( $parent_id );
					$breadcrumbs[] = sprintf( $link, get_permalink( $page_child->ID ), get_the_title( $page_child->ID ) );
					$parent_id     = $page_child->post_parent;
				}

				$breadcrumbs = array_reverse( $breadcrumbs );
				for ( $i = 0; $i < count( $breadcrumbs ); $i++ ) {
					echo $breadcrumbs[ $i ];
				}
				if ( $show_current ) {
					echo $before . get_the_title() . $after;
				}
			} elseif ( is_tag() ) {
				echo $before . sprintf( $text['tag'], '<span class="tag-text">', '&nbsp</span>' . single_tag_title( '', false ) ) . $after;
			} elseif ( is_author() ) {
				global $author;
				$userdata = get_userdata( $author );
				echo $before . sprintf( $text['author'], '<span class="author-text">', '&nbsp</span>' . $userdata->display_name ) . $after;
			} elseif ( is_404() ) {
				echo $before . $text['404'] . $after;
			} // End if().

			if ( get_query_var( 'paged' ) ) {
				if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) {
					echo ' (';
				}
				echo sprintf( esc_html__( 'Page %s', 'decree' ), max( $paged, $page ) );
				if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) {
					echo ')';
				}
			}

			echo '</div><!-- .wrapper -->
			</div><!-- #breadcrumb-list -->';
		}// End if().
	} // end decree_breadcrumb_lists
endif;
