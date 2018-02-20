<?php
/**
 * Core functions and definitions
 *
 * Sets up the theme
 *
 * The first function, decree_initial_setup(), sets up the theme by registering support
 * for various features in WordPress, such as theme support, post thumbnails, navigation menu, and the like.
 *
 * Decree functions and definitions
 *
 * @package Decree
 */

if ( ! function_exists( 'decree_content_width' ) ) :
	/**
	 * Set the content width in pixels, based on the theme's design and stylesheet.
	 *
	 * Priority 0 to make it available to lower priority callbacks.
	 *
	 * @global int $content_width
	 */
	function decree_content_width() {
		$GLOBALS['content_width'] = apply_filters( 'decree_content_width', 910 );
	}
endif;
add_action( 'after_setup_theme', 'decree_content_width', 0 );


if ( ! function_exists( 'decree_template_redirect' ) ) :
	/**
	 * Set the content width in pixels, based on the theme's design and stylesheet for different value other than the default one
	 *
	 * @global int $content_width
	 */
	function decree_template_redirect() {
		$layout = decree_get_theme_layout();
		$layout = decree_get_theme_layout();

		if ( 'no-sidebar-full-width' === $layout ) {
			$GLOBALS['content_width'] = 1280;
		}
	}
endif;
add_action( 'template_redirect', 'decree_template_redirect' );


if ( ! function_exists( 'decree_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which runs
	 * before the init hook. The init hook is too late for some features, such as indicating
	 * support post thumbnails.
	 */
	function decree_setup() {
		/**
		 * Get Theme Options Values
		 */
		$options = decree_get_theme_options();
		/**
		 * Make theme available for translation
		 * Translations can be filed in the /languages/ directory
		 * If you're building a theme based on Decree, use a find and replace
		 * to change 'decree' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'decree', trailingslashit( get_template_directory() ) . 'languages' );

		/**
		 * Add default posts and comments RSS feed links to head
		 */
		add_theme_support( 'automatic-feed-links' );

		/**
		 * Enable support for Post Thumbnails on posts and pages
		 *
		 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
		 */
		add_theme_support( 'post-thumbnails' );

		/**
		 * Add excerpt box in pages
		 */
		add_post_type_support( 'page', 'excerpt' );

		// Thumbnail Image, used in Archive, Team, Featured Content, Portfolio 1:1.
		set_post_thumbnail_size( 480, 480, true );

		// Slider Image, used in Slider 21:9.
		add_image_size( 'decree-slider', 1920, 823, true );

		// Hero Image, used in Hero Content 4:3.
		add_image_size( 'decree-hero', 635, 476, true );

		// Small Image, used in Testimonial and Widgets 1:1.
		add_image_size( 'decree-small', 80, 80, true );

		// Featured Image, 4:3.
		add_image_size( 'decree-featured', 910, 683, true );

		// Featured Full Width Image, 12:9.
		add_image_size( 'decree-featured-full', 1280, 549, true );

		/**
		 * This theme uses wp_nav_menu() in one location.
		 */
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary Menu', 'decree' ),
			'footer'  => esc_html__( 'Footer Menu', 'decree' ),
		) );

		/**
		 * Enable support for Post Formats
		 */
		add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

		/**
		 * Setup the WordPress core custom background feature.
		 */
		add_theme_support( 'custom-background', apply_filters( 'decree_custom_background_args', array(
			'default-color' => '#ffffff',
		) ) );

		/**
		 * Setup Editor style
		 */
		add_editor_style( 'css/editor-style.css' );

		/**
		 * Setup title support for theme
		 * Supported from WordPress version 4.1 onwards
		 * More Info: https://make.wordpress.org/core/2014/10/29/title-tags-in-4-1/
		 */
		add_theme_support( 'title-tag' );

		/**
		 * Setup Custom Logo Support for theme
		 * Supported from WordPress version 4.5 onwards
		 * More Info: https://make.wordpress.org/core/2016/03/10/custom-logo/
		 */
		add_theme_support( 'custom-logo' );

		/**
		 * Setup Infinite Scroll using JetPack if navigation type is set
		 */
		$pagination_type = $options['pagination_type'];

		if ( 'infinite-scroll' === $pagination_type ) {
			add_theme_support( 'infinite-scroll', array(
				'container' => 'main',
				'footer'    => 'page',
			) );
		}
	}
endif; // decree_setup.
add_action( 'after_setup_theme', 'decree_setup' );


/**
 * Enqueue scripts and styles
 *
 * @uses  wp_register_script, wp_enqueue_script, wp_register_style, wp_enqueue_style, wp_localize_script
 * @action wp_enqueue_scripts
 *
 * @since Decree 0.1
 */
function decree_scripts() {
	$options = decree_get_theme_options();

	wp_register_style( 'decree-web-font', decree_fonts_url(), false, null );

	$deps = array( 'decree-web-font' );

	wp_enqueue_style( 'decree-style', get_stylesheet_uri(), $deps, DECREE_THEME_VERSION );

	wp_enqueue_script( 'decree-navigation', get_template_directory_uri() . '/js/navigation.min.js', array(), DECREE_THEME_VERSION, true );

	wp_enqueue_script( 'decree-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.min.js', array(), DECREE_THEME_VERSION, true );

	/**
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Load Font Awesome.
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css' );

	/**
	 * Loads up fit vids
	 */
	wp_enqueue_script( 'jquery-fitvids', get_template_directory_uri() . '/js/fitvids.min.js', array( 'jquery' ), '1.1', true );

	/**
	 * Loads up Cycle JS
	 */
	if ( 'disabled' !== $options['news_ticker_option'] || 'disabled' !== $options['featured_slider_option'] || $options['testimonial_slider'] || 'disabled' !== $options['logo_slider_option'] ) {
		wp_enqueue_script( 'jquery-cycle2', get_template_directory_uri() . '/js/jquery.cycle/jquery.cycle2.min.js', array( 'jquery' ), '2.1.5', true );

		$transition_effects = array(
			$options['featured_slider_transition_effect'],
			$options['news_ticker_transition_effect'],
		);

		/**
		 * Condition checks for additional slider transition plugins
		 */
		// Scroll Vertical transition plugin addition.
		if ( in_array( 'scrollVert', $transition_effects, true ) ) {
			wp_enqueue_script( 'jquery-cycle2-scrollVert', get_template_directory_uri() . '/js/jquery.cycle/jquery.cycle2.scrollVert.min.js', array( 'jquery-cycle2' ), DECREE_THEME_VERSION, true );
		}

		if ( in_array( 'flipHorz', $transition_effects, true ) || in_array( 'flipVert', $transition_effects, true ) ) {
			// Flip transition plugin addition.
			wp_enqueue_script( 'jquery-cycle2-flip', get_template_directory_uri() . '/js/jquery.cycle/jquery.cycle2.flip.min.js', array( 'jquery-cycle2' ), DECREE_THEME_VERSION, true );
		}

		if ( in_array( 'tileSlide', $transition_effects, true ) || in_array( 'tileBlind', $transition_effects, true ) ) {
			// tile transition plugin addition.
			wp_enqueue_script( 'jquery-cycle2-tile', get_template_directory_uri() . '/js/jquery.cycle/jquery.cycle2.tile.min.js', array( 'jquery-cycle2' ), DECREE_THEME_VERSION, true );
		}

		if ( in_array( 'shuffle', $transition_effects, true ) ) {
			// Shuffle transition plugin addition.
			wp_enqueue_script( 'jquery-cycle2-shuffle', get_template_directory_uri() . '/js/jquery.cycle/jquery.cycle2.shuffle.min.js', array( 'jquery-cycle2' ), DECREE_THEME_VERSION, true );
		}

		if ( 'disabled' !== $options['logo_slider_option'] ) {
			wp_enqueue_script( 'jquery-cycle2-carousel', get_template_directory_uri() . '/js/jquery.cycle/jquery.cycle2.carousel.min.js', array( 'jquery-cycle2' ), DECREE_THEME_VERSION, true );
		}
	}

	/**
	 * Loads up Scroll Up script
	 */
	if ( ! $options['disable_scrollup'] ) {
		wp_enqueue_script( 'decree-scrollup', get_template_directory_uri() . '/js/scrollup.min.js', array( 'jquery' ), '20072014', true );
	}

	wp_register_script( 'jquery-match-height', get_template_directory_uri() . '/js/jquery.matchHeight.min.js', array( 'jquery' ), '20151215', true );

	/**
	 * Enqueue custom script for Decree.
	 */
	wp_enqueue_script( 'decree-custom-scripts', get_template_directory_uri() . '/js/custom-scripts.min.js', array( 'jquery', 'jquery-match-height' ), '20150507', true );

	wp_localize_script( 'decree-custom-scripts', 'screenReaderText', array(
		'expand'   => esc_html__( 'expand child menu', 'decree' ),
		'collapse' => esc_html__( 'collapse child menu', 'decree' ),
	) );

	// Load the html5 shiv.
	wp_enqueue_script( 'decree-html5', get_template_directory_uri() . '/js/html5.min.js', array(), '3.7.0' );
	wp_script_add_data( 'decree-html5', 'conditional', 'lt IE 9' );
}
add_action( 'wp_enqueue_scripts', 'decree_scripts' );


/**
 * Register Google fonts.
 */
function decree_fonts_url() {
	$fonts_url = '';
	/* Translators: If there are characters in your language that are not
	* supported by Roboto, translate this to 'off'. Do not translate
	* into your own language.
	*/
	$roboto = _x( 'on', 'Roboto: on or off', 'decree' );

	/* Translators: If there are characters in your language that are not
	* supported by Roboto Slab, translate this to 'off'. Do not translate
	* into your own language.
	*/
	$roboto_slab = _x( 'on', 'Roboto Slab font: on or off', 'decree' );

	if ( 'off' !== $roboto || 'off' !== $roboto_slab ) {
		$font_families = array();

		if ( 'off' !== $roboto ) {
			$font_families[] = 'Roboto';
		}

		if ( 'off' !== $roboto_slab ) {
			$font_families[] = 'Roboto Slab';
		}

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}


/**
 * Enqueue scripts and styles for Metaboxes
 *
 * @uses wp_register_script, wp_enqueue_script, and  wp_enqueue_style
 *
 * @param string $hook current scrreen slug.
 * @action admin_print_scripts-post-new, admin_print_scripts-post, admin_print_scripts-page-new, admin_print_scripts-page
 *
 * @since Decree 0.1
 */
function decree_enqueue_metabox_scripts( $hook ) {
	$allowed_pages = array( 'post-new.php', 'post.php' );

	// Bail if not on required page.
	if ( ! in_array( $hook, $allowed_pages, true ) ) {
		return;
	}

	// Scripts.
	wp_enqueue_script( 'decree-metabox', get_template_directory_uri() . '/js/metabox.min.js', array( 'jquery', 'jquery-ui-tabs' ), '2013-10-05' );

	// CSS Styles.
	wp_enqueue_style( 'decree-metabox-tabs', get_template_directory_uri() . '/css/metabox-tabs.css' );
}
add_action( 'admin_enqueue_scripts', 'decree_enqueue_metabox_scripts' );


// Default Options.
require trailingslashit( get_template_directory() ) . 'inc/default-options.php';

// Custom Header.
require trailingslashit( get_template_directory() ) . 'inc/custom-header.php';

// Structure for Decree.
require trailingslashit( get_template_directory() ) . 'inc/structure.php';

// Customizer additions.
require trailingslashit( get_template_directory() ) . 'inc/customizer-includes/customizer.php';

// Custom Menus.
require trailingslashit( get_template_directory() ) . 'inc/menus.php';

// Portfolio.
require trailingslashit( get_template_directory() ) . 'inc/portfolio.php';

// Team.
require trailingslashit( get_template_directory() ) . 'inc/team.php';

// Content.
require trailingslashit( get_template_directory() ) . 'inc/promotion-headline.php';

// Slider.
require trailingslashit( get_template_directory() ) . 'inc/featured-slider.php';

// Hero Content.
require trailingslashit( get_template_directory() ) . 'inc/hero-content.php';

// Featured Content.
require trailingslashit( get_template_directory() ) . 'inc/featured-content.php';

// Testimonial.
require trailingslashit( get_template_directory() ) . 'inc/testimonial.php';

// Logo Slider.
require trailingslashit( get_template_directory() ) . 'inc/logo-slider.php';

// Load Breadcrumb file.
require trailingslashit( get_template_directory() ) . 'inc/breadcrumb.php';

// Load Widgets and Sidebars.
require trailingslashit( get_template_directory() ) . 'inc/widgets/widgets.php';

// Load Social Icons.
require trailingslashit( get_template_directory() ) . 'inc/social-icons.php';

// Load Metaboxes.
require trailingslashit( get_template_directory() ) . 'inc/metabox.php';

// Load Custom CSS
require trailingslashit( get_template_directory() ) . 'inc/custom-css.php';


/**
 * Returns the options array for Decree.
 *
 * @uses  get_theme_mod
 *
 * @since Decree 0.1
 */
function decree_get_theme_options() {
	return wp_parse_args( get_theme_mod( 'decree_theme_options' ) , decree_get_default_theme_options() );
}


/**
 * Flush out all transients
 *
 * @uses delete_transient
 *
 * @action customize_save, decree_customize_preview (see decree_customizer function: decree_customize_preview)
 *
 * @since Decree 0.1
 */
function decree_flush_transients() {
	delete_transient( 'decree_contact_form' );

	delete_transient( 'decree_contact_info' );

	delete_transient( 'decree_promotion_headline' );

	delete_transient( 'decree_portfolio' );

	delete_transient( 'decree_logo_slider' );

	delete_transient( 'decree_testimonial' );

	delete_transient( 'decree_hero_content' );

	delete_transient( 'decree_featured_content' );

	delete_transient( 'decree_team' );

	delete_transient( 'decree_news_ticker' );

	delete_transient( 'decree_featured_slider' );

	delete_transient( 'decree_custom_css' );

	delete_transient( 'decree_featured_image' );

	delete_transient( 'decree_social_icons' );

	delete_transient( 'decree_scrollup' );

	delete_transient( 'all_the_cool_cats' );
}
add_action( 'customize_save', 'decree_flush_transients' );

/**
 * Flush out category transients
 *
 * @uses delete_transient
 *
 * @action edit_category
 *
 * @since Decree 0.1
 */
function decree_flush_category_transients() {
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'decree_flush_category_transients' );


/**
 * Flush out post related transients
 *
 * @uses delete_transient
 *
 * @action save_post
 *
 * @since Decree 0.1
 */
function decree_flush_post_transients() {
	delete_transient( 'decree_contact_form' );

	delete_transient( 'decree_promotion_headline' );

	delete_transient( 'decree_portfolio' );

	delete_transient( 'decree_logo_slider' );

	delete_transient( 'decree_testimonial' );

	delete_transient( 'decree_hero_content' );

	delete_transient( 'decree_featured_content' );

	delete_transient( 'decree_team' );

	delete_transient( 'decree_news_ticker' );

	delete_transient( 'decree_featured_slider' );

	delete_transient( 'decree_featured_image' );

	delete_transient( 'all_the_cool_cats' );
}
add_action( 'save_post', 'decree_flush_post_transients' );


/**
 * Alter the query for the main loop in homepage
 *
 * @action pre_get_posts
 *
 * @since Decree 0.1
 */
function decree_alter_home( $query ) {
	$options = decree_get_theme_options();

	$cats = $options['front_page_category'];

	if ( is_array( $cats ) && ! in_array( '0', $cats ) ) {
		$cats = (array) $cats ;

		if ( defined( 'ICL_LANGUAGE_CODE' ) ) {
			$category = array();
			foreach ( $cats as $cat ) {
				$category[] = apply_filters( 'wpml_object_id', $cat, 'category', true );
			}
			$cats = $category;
		}
	} else {
		$cats = '0';
	}

	$quantity	= $options['featured_slider_number'];

	$post_list	= array();	// list of valid post ids.

	for ( $i = 1; $i <= $quantity; $i++ ) {
		if ( isset( $options[ 'featured_slider_post_' . $i ] ) && $options[ 'featured_slider_post_' . $i ] > 0 ) {
			$post_list	= wp_parse_args( $post_list, array( $options[ 'featured_slider_post_' . $i ] ) );
		}
	}

	if ( '1' === $options['exclude_slider_post'] && ! empty( $post_list ) ) {
		if ( $query->is_main_query() && $query->is_home() ) {
			$query->query_vars['post__not_in'] = $post_list;
		}
	}

	if ( is_array( $cats ) && ! in_array( '0', $cats, true ) ) {
		if ( $query->is_main_query() && $query->is_home() ) {
			$query->query_vars['category__in'] = $cats;
		}
	}
}
add_action( 'pre_get_posts','decree_alter_home' );


if ( ! function_exists( 'decree_content_nav' ) ) :
	/**
	 * Display navigation to next/previous pages when applicable
	 *
	 * @since Decree 0.1
	 */
	function decree_content_nav( $nav_id ) {
		global $wp_query, $post;

		// Don't print empty markup on single pages if there's nowhere to navigate.
		if ( is_single() ) {
			$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
			$next = get_adjacent_post( false, '', false );

			if ( ! $next && ! $previous ) {
				return;
			}
		}

		// Don't print empty markup in archives if there's only one page.
		if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) ) {
			return;
		}

		$options         = decree_get_theme_options();
		$pagination_type = $options['pagination_type'];

		/**
		 * Check if navigation type is Jetpack Infinite Scroll and if it is enabled, else goto default pagination
		 * if it's active then disable pagination
		 */
		if ( 'infinite-scroll' === $pagination_type && class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'infinite-scroll' ) ) {
			return false;
		}

		?>

		<div class="main-pagination clear">
			<?php
			if ( 'numeric' === $pagination_type && function_exists( 'the_posts_pagination' ) ) {
				// Previous/next page navigation.
				the_posts_pagination( array(
					'prev_text'          => esc_html__( 'Previous', 'decree' ),
					'next_text'          => esc_html__( 'Next', 'decree' ),
					'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'decree' ) . ' </span>',
				) );
			} else {
				the_posts_navigation();
			} ?>
		</div><!-- .main-pagination -->

		<?php
	}
endif; // decree_content_nav.


if ( ! function_exists( 'decree_comment' ) ) :
	/**
	 * Template for comments and pingbacks.
	 *
	 * Used as a callback by wp_list_comments() for displaying the comments.
	 *
	 * @since Decree 0.1
	 */
	function decree_comment( $comment, $args, $depth ) {
		if ( 'pingback' === $comment->comment_type || 'trackback' === $comment->comment_type ) : ?>

		<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
			<div class="comment-body">
				<?php esc_html_e( 'Pingback:', 'decree' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( esc_html__( 'Edit', 'decree' ), '<span class="edit-link">', '</span>' ); ?>
			</div>

		<?php else : ?>

		<li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>
			<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
				<footer class="comment-meta">
					<div class="comment-author vcard">
						<?php
						if ( 0 !== $args['avatar_size'] ) {
							echo get_avatar( $comment, $args['avatar_size'] );
						}
						?>
						<?php printf( __( '%s <span class="says">says:</span>', 'decree' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
					</div><!-- .comment-author -->

					<div class="comment-metadata">
						<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
							<time datetime="<?php comment_time( 'c' ); ?>">
								<?php printf( _x( '%1$s at %2$s', '1: date, 2: time', 'decree' ), get_comment_date(), get_comment_time() ); ?>
							</time>
						</a>
						<?php edit_comment_link( esc_html__( 'Edit', 'decree' ), '<span class="edit-link">', '</span>' ); ?>
					</div><!-- .comment-metadata -->

					<?php if ( '0' === $comment->comment_approved ) : ?>
					<p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'decree' ); ?></p>
					<?php endif; ?>
				</footer><!-- .comment-meta -->

				<div class="comment-content">
					<?php comment_text(); ?>
				</div><!-- .comment-content -->

				<?php
					comment_reply_link( wp_parse_args( $args, array(
						'add_below' => 'div-comment',
						'depth'     => $depth,
						'max_depth' => $args['max_depth'],
						'before'    => '<div class="reply">',
						'after'     => '</div>',
					) ) );
				?>
			</article><!-- .comment-body -->

		<?php
		endif;
	}
endif; // decree_comment().


if ( ! function_exists( 'decree_entry_meta' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 *
	 * @since Decree 0.1
	 */
	function decree_entry_meta() {
		echo '<p class="entry-meta">';

		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		printf( '<span class="posted-on">%1$s<a href="%2$s" rel="bookmark">%3$s</a></span>',
			sprintf( _x( '<span class="screen-reader-text">Posted on</span>', 'Used before publish date.', 'decree' ) ),
			esc_url( get_permalink() ),
			$time_string
		);

		if ( is_singular() || is_multi_author() ) {
			printf( '<span class="byline"><span class="author vcard">%1$s<a class="url fn n" href="%2$s">%3$s</a></span></span>',
				sprintf( _x( '<span class="screen-reader-text">Author</span>', 'Used before post author name.', 'decree' ) ),
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				esc_html( get_the_author() )
			);
		}

		if ( ! post_password_required() && ( comments_open() || '0' !== get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link( esc_html__( 'Leave a comment', 'decree' ), esc_html__( '1 Comment', 'decree' ), esc_html__( '% Comments', 'decree' ) );
			echo '</span>';
		}

		edit_post_link( esc_html__( 'Edit', 'decree' ), '<span class="edit-link">', '</span>' );

		echo '</p><!-- .entry-meta -->';
	}
endif; //decree_entry_meta


if ( ! function_exists( 'decree_tag_category' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags.
	 *
	 * @since Decree 0.1
	 */
	function decree_tag_category() {
		echo '<p class="entry-meta">';

		if ( 'post' === get_post_type() ) {
			$categories_list = get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'decree' ) );
			if ( $categories_list && decree_categorized_blog() ) {
				printf( '<span class="cat-links">%1$s%2$s</span>',
					sprintf( _x( '<span class="screen-reader-text">Categories</span>', 'Used before category names.', 'decree' ) ),
					$categories_list
				);
			}

			$tags_list = get_the_tag_list( '', _x( ', ', 'Used between list items, there is a space after the comma.', 'decree' ) );
			if ( $tags_list ) {
				printf( '<span class="tags-links">%1$s%2$s</span>',
					sprintf( _x( '<span class="screen-reader-text">Tags</span>', 'Used before tag names.', 'decree' ) ),
					$tags_list
				);
			}
		}

		echo '</p><!-- .entry-meta -->';
	}
endif; //decree_tag_category


if ( ! function_exists( 'decree_get_highlight_meta' ) ) :
	/**
	 * Returns HTML with meta information for the categories, tags, date and author.
	 *
	 * @param [boolean] $hide_category Adds screen-reader-text class to category meta if true
	 * @param [boolean] $hide_tags Adds screen-reader-text class to tag meta if true
	 * @param [boolean] $hide_posted_by Adds screen-reader-text class to date meta if true
	 * @param [boolean] $hide_author Adds screen-reader-text class to author meta if true
	 *
	 * @since Decree 0.1
	 */
	function decree_get_highlight_meta( $hide_category = false, $hide_tags = false, $hide_posted_by = false, $hide_author = false ) {
		$output = '<p class="entry-meta">';

		if ( 'post' === get_post_type() ) {

			$class = $hide_category ? 'screen-reader-text' : '';

			$categories_list = get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'decree' ) );
			if ( $categories_list && decree_categorized_blog() ) {
				$output .= sprintf( '<span class="cat-links ' . $class . '">%1$s%2$s</span>',
					sprintf( _x( '<span class="screen-reader-text">Categories</span>', 'Used before category names.', 'decree' ) ),
					$categories_list
				);
			}

			$class = $hide_tags ? 'screen-reader-text' : '';

			$tags_list = get_the_tag_list( '', _x( ', ', 'Used between list items, there is a space after the comma.', 'decree' ) );
			if ( $tags_list ) {
				$output .= sprintf( '<span class="tags-links ' . $class . '">%1$s%2$s</span>',
					sprintf( _x( '<span class="screen-reader-text">Tags</span>', 'Used before tag names.', 'decree' ) ),
					$tags_list
				);
			}

			$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

			if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
				$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
			}

			$time_string = sprintf( $time_string,
				esc_attr( get_the_date( 'c' ) ),
				esc_html( get_the_date() ),
				esc_attr( get_the_modified_date( 'c' ) ),
				esc_html( get_the_modified_date() )
			);

			$class = $hide_posted_by ? 'screen-reader-text' : '';

			$output .= sprintf( '<span class="posted-on ' . $class . '">%1$s<a href="%2$s" rel="bookmark">%3$s</a></span>',
				sprintf( _x( '<span class="screen-reader-text">Posted on</span>', 'Used before publish date.', 'decree' ) ),
				esc_url( get_permalink() ),
				$time_string
			);

			if ( is_singular() || is_multi_author() ) {
				$class = $hide_author ? 'screen-reader-text' : '';

				$output .= sprintf( '<span class="byline ' . $class . '"><span class="author vcard">%1$s<a class="url fn n" href="%2$s">%3$s</a></span></span>',
					sprintf( _x( '<span class="screen-reader-text">Author</span>', 'Used before post author name.', 'decree' ) ),
					esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
					esc_html( get_the_author() )
				);
			}
		} // End if().

		$output .= '</p><!-- .entry-meta -->';

		return $output;
	}
endif; //decree_get_highlight_meta


/**
 * Returns true if a blog has more than 1 category
 *
 * @since Decree 0.1
 */
function decree_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( '1' !== $all_the_cool_cats ) {
		// This blog has more than 1 category so decree_categorized_blog should return true
		return true;
	} else {
		// This blog has only 1 category so decree_categorized_blog should return false
		return false;
	}
}


/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @since Decree 0.1
 */
function decree_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'decree_page_menu_args' );


/**
 * Filter in a link to a content ID attribute for the next/previous image links on image attachment pages
 *
 * @since Decree 0.1
 */
function decree_enhanced_image_navigation( $url, $id ) {
	if ( ! is_attachment() && ! wp_attachment_is_image( $id ) )
		return $url;

	$image = get_post( $id );
	if ( ! empty( $image->post_parent ) && $image->post_parent !== $id )
		$url .= '#main';

	return $url;
}
add_filter( 'attachment_link', 'decree_enhanced_image_navigation', 10, 2 );


/**
 * Count the number of footer sidebars to enable dynamic classes for the footer
 *
 * @since Decree 0.1
 */
function decree_footer_sidebar_class() {
	$count = 0;

	if ( is_active_sidebar( 'footer-1' ) )
		$count++;

	if ( is_active_sidebar( 'footer-2' ) )
		$count++;

	if ( is_active_sidebar( 'footer-3' ) )
		$count++;

	if ( is_active_sidebar( 'footer-4' ) )
		$count++;

	$class = '';

	switch ( $count ) {
		case '1':
			$class = 'footer-widget-area one';
			break;
		case '2':
			$class = 'footer-widget-area two';
			break;
		case '3':
			$class = 'footer-widget-area three';
			break;
		case '4':
			$class = 'footer-widget-area four';
			break;
	}

	if ( $class )
		echo 'class="' . $class . '"';
}


if ( ! function_exists( 'decree_excerpt_length' ) ) :
	/**
	 * Sets the post excerpt length to n words.
	 *
	 * function tied to the excerpt_length filter hook.
	 * @uses filter excerpt_length
	 *
	 * @since Decree 0.1
	 */
	function decree_excerpt_length( $length ) {
		if ( is_admin() ) {
			return $length;
		}

		// Getting data from Customizer Options
		$options = decree_get_theme_options();

		return absint( $options['excerpt_length'] );
	}
endif; //decree_excerpt_length
add_filter( 'excerpt_length', 'decree_excerpt_length' );


if ( ! function_exists( 'decree_continue_reading' ) ) :
	/**
	 * Returns a "Custom Continue Reading" link for excerpts
	 *
	 * @since Decree 0.1
	 */
	function decree_continue_reading() {
		if ( is_admin() ) {
			return;
		}

		// Getting data from Customizer Options
		$options       = decree_get_theme_options();
		$more_tag_text = $options['excerpt_more_text'];

		return ' <span class="more-button"><a class="button-minimal" href="' . esc_url( get_permalink() ) . '">' . esc_html( $more_tag_text ) . '</a></span>';
	}
endif; //decree_continue_reading
add_filter( 'excerpt_more', 'decree_continue_reading' );


if ( ! function_exists( 'decree_custom_excerpt' ) ) :
	/**
	 * Adds Continue Reading link to more tag excerpts.
	 *
	 * function tied to the get_the_excerpt filter hook.
	 *
	 * @since Decree 0.1
	 */
	function decree_custom_excerpt( $output ) {
		if ( is_admin() ) {
			return $output;
		}

		if ( has_excerpt() && ! is_attachment() ) {
			$output .= decree_continue_reading();
		}
		return $output;
	}
endif; //decree_custom_excerpt
add_filter( 'get_the_excerpt', 'decree_custom_excerpt' );


if ( ! function_exists( 'decree_more_link' ) ) :
	/**
	 * Replacing Continue Reading link to the_content more.
	 *
	 * function tied to the the_content_more_link filter hook.
	 *
	 * @since Decree 0.1
	 */
	function decree_more_link( $more_link, $more_link_text ) {
		$options       = decree_get_theme_options();
		$more_tag_text = $options['excerpt_more_text'];

		return str_replace( $more_link_text, $more_tag_text, $more_link );
	}
endif; //decree_more_link
add_filter( 'the_content_more_link', 'decree_more_link', 10, 2 );


if ( ! function_exists( 'decree_body_classes' ) ) :
	/**
	 * Adds Decree layout classes to the array of body classes.
	 *
	 * @since Decree 0.1
	 */
	function decree_body_classes( $classes ) {
		$options 		= decree_get_theme_options();

		// Adds a class of group-blog to blogs with more than 1 published author.
		if ( is_multi_author() ) {
			$classes[] = 'group-blog';
		}

		$layout = decree_get_theme_layout();

		switch ( $layout ) {
			case 'right-sidebar':
				$classes[] = 'layout-two-columns content-left';
			break;

			case 'no-sidebar-full-width':
				$classes[] = 'layout-one-column no-sidebar full-width';
			break;
		}

		$content_layout = $options['content_layout'];
		if ( '' !== $content_layout ) {
			$classes[] = $content_layout;
		}

		$classes[] = 'mobile-menu-one';

		if ( 'above-content' === $options['news_ticker_position'] ) {
			$classes[] = 'news-ticker-above-content';
		}

		$classes[] = 'active-header-right';

		$classes 	= apply_filters( 'decree_body_classes', $classes );

		return $classes;
	}
endif; //decree_body_classes().
add_filter( 'body_class', 'decree_body_classes' );


if ( ! function_exists( 'decree_post_classes' ) ) :
	/**
	 * Adds Decree post classes to the array of post classes.
	 * used for supporting different content layouts
	 *
	 * @since Decree 0.1
	 */
	function decree_post_classes( $classes ) {
		// Getting Ready to load data from Theme Options Panel.
		$options 		= decree_get_theme_options();

		$contentlayout = $options['content_layout'];

		if ( is_archive() || is_home() ) {
			$classes[] = $contentlayout;
		}

		return $classes;
	}
endif; // decree_post_classes().
add_filter( 'post_class', 'decree_post_classes' );


if ( ! function_exists( 'decree_get_theme_layout' ) ) :
	/**
	 * Returns Theme Layout prioritizing the meta box layouts
	 *
	 * @uses  get_theme_mod
	 *
	 * @action wp_head
	 *
	 * @since Decree 0.1
	 */
	function decree_get_theme_layout() {
		$id = '';

		global $post, $wp_query;

		// Front page displays in Reading Settings.
		$page_on_front  = (int) get_option( 'page_on_front' );
		$page_for_posts = (int) get_option( 'page_for_posts' );

		// Get Page ID outside Loop
		$page_id = $wp_query->get_queried_object_id();

		// Blog Page or Front Page setting in Reading Settings
		if ( $page_id === $page_for_posts || $page_id === $page_on_front ) {
			$id = $page_id;
		} else if ( is_singular() ) {
			if ( is_attachment() ) {
				$id = $post->post_parent;
			} else {
				$id = $post->ID;
			}
		}

		$layout = 'default';

		//Get appropriate metabox value of layout
		if ( '' !== $id ) {
			$layout = get_post_meta( $id, 'decree-layout-option', true );
		}

		//Load options data
		$options = decree_get_theme_options();

		//check empty and load default
		if ( empty( $layout ) || 'default' === $layout ) {
			if ( is_front_page() || is_home() || is_archive() ) {
				$layout = $options['homepage_layout'];
			} else {
				$layout = $options['theme_layout'];
			}
		}

		return $layout;
	}
endif; //decree_get_theme_layout


if ( ! function_exists( 'decree_archive_content_image' ) ) :
	/**
	 * Template for Featured Image in Archive Content
	 *
	 * To override this in a child theme
	 * simply create your own decree_archive_content_image(), and that function will be used instead.
	 *
	 * @since Decree 0.1
	 */
	function decree_archive_content_image() {
		$options  = decree_get_theme_options();
		$feat_img = $options['content_layout'];

		if ( has_post_thumbnail() && 'full-content' !== $feat_img ) { ?>
			<figure class="featured-image">
				<a rel="bookmark" href="<?php the_permalink(); ?>">

				<?php
					the_post_thumbnail();
				?>
				</a>
			</figure>
		<?php
		}
	}
endif; //decree_archive_content_image
add_action( 'decree_before_entry_container', 'decree_archive_content_image', 10 );


if ( ! function_exists( 'decree_single_content_image' ) ) :
	/**
	 * Template for Featured Image in Single Post
	 *
	 * To override this in a child theme
	 * simply create your own decree_single_content_image(), and that function will be used instead.
	 *
	 * @since Decree 0.1
	 */
	function decree_single_content_image() {
		global $post, $wp_query;

		// Get Page ID outside Loop
		$page_id = $wp_query->get_queried_object_id();
		if ( $post) {
			if ( is_attachment() ) {
				$parent = $post->post_parent;
				$individual_ft_image = get_post_meta( $parent,'decree-featured-image', true );
			} else {
				$individual_ft_image = get_post_meta( $page_id,'decree-featured-image', true );
			}
		}

		if ( empty( $individual_ft_image ) || ( !is_page() && !is_single() ) ) {
			$individual_ft_image = 'default';
		}

		// Getting data from Theme Options
		$options = decree_get_theme_options();

		$featured_image = $options['single_post_image_layout'];

		if ( ( 'disable' === $individual_ft_image  || '' === get_the_post_thumbnail() || ( $individual_ft_image=='default' && 'disabled' === $featured_image ) ) ) {
			echo '<!-- Page/Post Single Image Disabled or No Image set in Post Thumbnail -->';
			return false;
		}
		else {
			$class = '';

			if ( 'default' === $individual_ft_image ) {
				$class = $featured_image;
			}
			else {
				$class = 'from-metabox ' . $individual_ft_image;
			}

			?>
			<figure class="featured-image <?php echo $class; ?>">
				<?php the_post_thumbnail( $featured_image ); ?>
			</figure>
		<?php
		}
	}
endif; //decree_single_content_image
add_action( 'decree_before_post_container', 'decree_single_content_image', 10 );
add_action( 'decree_before_page_container', 'decree_single_content_image', 10 );


if ( ! function_exists( 'decree_get_comment_section' ) ) :
	/**
	 * Comment Section
	 *
	 * @get comment setting from theme options and display comments sections accordingly
	 * @display comments_template
	 * @action decree_comment_section
	 *
	 * @since Decree Pro 1.0
	 */
	function decree_get_comment_section() {
		if ( comments_open() || get_comments_number() ) {
			comments_template();
		}
}
endif;
add_action( 'decree_comment_section', 'decree_get_comment_section', 10 );


if ( ! function_exists( 'decree_site_generator_start' ) ) :
	/**
	 * Start Header id #masthead and class .wrapper
	 *
	 * @since Decree 0.1
	 *
	 */
	function decree_site_generator_start() {
		?>
		<div id="site-generator">
			<div class="wrapper">
		<?php
	}
endif;
add_action( 'decree_footer', 'decree_site_generator_start', 40 );


/**
 * Footer Text
 *
 * @get footer text from theme options and display them accordingly
 * @display footer_text
 * @action decree_footer
 *
 * @since Decree 0.1
 */
function decree_footer_content() {
	//decree_flush_transients();
	if ( ( !$output = get_transient( 'decree_footer_content' ) ) ) {
		$output =  '<div id="footer-content" class="copyright">' . decree_get_content() . '</div>';

	    set_transient( 'decree_footer_content', $output, 86940 );
    }

    echo $output;
}
add_action( 'decree_footer', 'decree_footer_content', 60 );


if ( ! function_exists( 'decree_site_generator_end' ) ) :
	/**
	 * Start Header id #masthead and class .wrapper
	 *
	 * @since Decree 0.1
	 */
	function decree_site_generator_end() {
		?>
			</div><!-- .wrapper -->
		</div><!-- #site-generator -->
		<?php
	}
endif;
add_action( 'decree_footer', 'decree_site_generator_end', 70 );


/**
 * Return the first image in a post. Works inside a loop.
 *
 * @param integer $post_id Post or page id.
 * @param string/array $size Image size. Either a string keyword (thumbnail, medium, large or full) or a 2-item array representing width and height in pixels, e.g. array(32,32).
 * @param string/array $attr Query string or array of attributes.
 * @return string image html
 *
 * @since Decree 0.1
 */

function decree_get_first_image( $post_id, $size, $attr ) {
	ob_start();

	ob_end_clean();

	$image 	= '';

	$output = preg_match_all( '/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', get_post_field( 'post_content', $post_id ) , $matches );

	if ( isset( $matches [1] [0] ) ) {
		//Get first image
		$first_img = $matches [1] [0];

		return '<img class="pngfix wp-post-image" src="' . esc_url( $first_img ) . '">';
	}

	return false;
}


if ( ! function_exists( 'decree_scrollup' ) ) {
	/**
	 * This function loads Scroll Up Navigation
	 *
	 * @action decree_footer action
	 * @uses set_transient and delete_transient
	 */
	function decree_scrollup() {
		//decree_flush_transients();
		if ( ! $decree_scrollup = get_transient( 'decree_scrollup' ) ) {

			// get the data value from theme options
			$options = decree_get_theme_options();
			echo '<!-- refreshing cache -->';

			//site stats, analytics header code
			if ( ! $options['disable_scrollup'] ) {
				$decree_scrollup = '<a href="#masthead" id="scrollup"><span class="screen-reader-text">' . esc_html__( 'Scroll Up', 'decree' ) . '</span></a>' ;
			}

			set_transient( 'decree_scrollup', $decree_scrollup, 86940 );
		}

		echo $decree_scrollup;
	}
}
add_action( 'decree_after', 'decree_scrollup', 10 );


if ( ! function_exists( 'decree_page_post_meta' ) ) :
	/**
	 * Post/Page Meta for Google Structure Data
	 */
	function decree_page_post_meta() {
		$meta = '';

		$categories_list = get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'decree' ) );

		if ( $categories_list && decree_categorized_blog() ) {
			$meta .= sprintf( '<span class="cat-links">%1$s%2$s</span>',
				sprintf( _x( '<span class="screen-reader-text">Categories</span>', 'Used before category names.', 'decree' ) ),
				$categories_list
			);
		}

		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		$meta .= sprintf( '<span class="posted-on">%1$s<a href="%2$s" rel="bookmark">%3$s</a></span>',
			sprintf( __( '<span class="screen-reader-text">Posted on</span>', 'decree' ) ),
			esc_url( get_permalink() ),
			$time_string
		);

		return $meta;
	}
endif; //decree_page_post_meta


if ( ! function_exists( 'decree_truncate_phrase' ) ) :
	/**
	 * Return a phrase shortened in length to a maximum number of characters.
	 *
	 * Result will be truncated at the last white space in the original string. In this function the word separator is a
	 * single space. Other white space characters (like newlines and tabs) are ignored.
	 *
	 * If the first `$max_characters` of the string does not contain a space character, an empty string will be returned.
	 *
	 * @since Decree 0.1
	 *
	 * @param string $text            A string to be shortened.
	 * @param integer $max_characters The maximum number of characters to return.
	 *
	 * @return string Truncated string
	 */
	function decree_truncate_phrase( $text, $max_characters ) {

		$text = trim( $text );

		if ( mb_strlen( $text ) > $max_characters ) {
			//* Truncate $text to $max_characters + 1
			$text = mb_substr( $text, 0, $max_characters + 1 );

			//* Truncate to the last space in the truncated string
			$text = trim( mb_substr( $text, 0, mb_strrpos( $text, ' ' ) ) );
		}

		return $text;
	}
endif; //decree_truncate_phrase


if ( ! function_exists( 'decree_get_the_content_limit' ) ) :
	/**
	 * Return content stripped down and limited content.
	 *
	 * Strips out tags and shortcodes, limits the output to `$max_char` characters, and appends an ellipsis and more link to the end.
	 *
	 * @since Decree 0.1
	 *
	 * @param integer $max_characters The maximum number of characters to return.
	 * @param string  $more_link_text Optional. Text of the more link. Default is "(more...)".
	 * @param bool    $stripteaser    Optional. Strip teaser content before the more text. Default is false.
	 *
	 * @return string Limited content.
	 */
	function decree_get_the_content_limit( $max_characters, $more_link_text = '(more...)', $stripteaser = false ) {

		$content = get_the_content( '', $stripteaser );

		//* Strip tags and shortcodes so the content truncation count is done correctly
		$content = strip_tags( strip_shortcodes( $content ), apply_filters( 'get_the_content_limit_allowedtags', '<script>,<style>' ) );

		//* Remove inline styles / scripts
		$content = trim( preg_replace( '#<(s(cript|tyle)).*?</\1>#si', '', $content ) );

		//* Truncate $content to $max_char
		$content = decree_truncate_phrase( $content, $max_characters );

		//* More link?
		if ( $more_link_text ) {
			$link   = apply_filters( 'get_the_content_more_link', sprintf( '<a href="%s" class="more-link">%s</a>', esc_url( get_permalink() ), $more_link_text ), $more_link_text );
			$output = sprintf( '<p>%s %s</p>', $content, $link );
		} else {
			$output = sprintf( '<p>%s</p>', $content );
			$link = '';
		}

		return apply_filters( 'decree_get_the_content_limit', $output, $content, $link, $max_characters );

	}
endif; //decree_get_the_content_limit


if ( ! function_exists( 'decree_post_navigation' ) ) :
	/**
	 * Displays Single post Navigation
	 *
	 * @uses  the_post_navigation
	 *
	 * @action decree_after_post
	 *
	 * @since Decree 0.1
	 */
	function decree_post_navigation() {
		// Previous/next post navigation.
		the_post_navigation( array(
			'next_text' => '<span class="meta-nav" aria-hidden="true">' . esc_html__( 'Next &rarr;', 'decree' ) . '</span> ' .
				'<span class="screen-reader-text">' . esc_html__( 'Next post:', 'decree' ) . '</span> ' .
				'<span class="post-title">%title</span>',
			'prev_text' => '<span class="meta-nav" aria-hidden="true">' . esc_html__( '&larr; Previous', 'decree' ) . '</span> ' .
				'<span class="screen-reader-text">' . esc_html__( 'Previous post:', 'decree' ) . '</span> ' .
				'<span class="post-title">%title</span>',
		) );
	}
endif; // decree_post_navigation().
add_action( 'decree_after_post', 'decree_post_navigation', 10 );



if ( ! function_exists( 'decree_date' ) ) :
	/**
	 * Displays Date
	 *
	 * @uses  date_i18n
	 *
	 * default load in decree_header_top function
	 *
	 * @since Decree 0.1
	 */
	function decree_date() {
		$options = decree_get_theme_options();
		if ( $options['disable_date'] ) {
			// Bail if date is disabled.
			return;
		}

		echo '<div class="date ctdate">' . esc_html( date_i18n( 'l, F j, Y' ) ) . '</div>';
	}
endif;  // decree_date().


/**
 * Display Multiple Select type for and array of categories
 *
 * @param  string $name  field name.
 * @param  string $id    field_id.
 * @param  array  $selected selected values.
 * @param  string $label label of the field.
 */
function decree_dropdown_categories( $name, $id, $selected, $label = '' ) {
	$dropdown = wp_dropdown_categories(
		array(
			'name'             => $name,
			'echo'             => 0,
			'hide_empty'       => false,
			'show_option_none' => false,
			'hierarchical'     => 1,
		)
	);

	if ( '' !== $label ) {
		echo '<label for="' . $id . '">
			' . $label . '
			</label>';
	}

	$dropdown = str_replace( '<select', '<select multiple = "multiple" style = "height:120px; width: 100%" ', $dropdown );

	foreach ( $selected as $selected ) {
		$dropdown = str_replace( 'value="' . $selected . '"', 'value="' . $selected . '" selected="selected"', $dropdown );
	}

	echo $dropdown;

	echo '<span class="description">' . esc_html__( 'Hold down the Ctrl (windows) / Command (Mac) button to select multiple options.', 'decree' ) . '</span>';
}


/**
 * Return registered image sizes.
 *
 * Return a two-dimensional array of just the additionally registered image sizes, with width, height and crop sub-keys.
 *
 * @since 0.1.7
 *
 * @global array $_wp_additional_image_sizes Additionally registered image sizes.
 *
 * @return array Two-dimensional, with width, height and crop sub-keys.
 */
function decree_get_additional_image_sizes() {
	global $_wp_additional_image_sizes;

	if ( $_wp_additional_image_sizes ) {
		return $_wp_additional_image_sizes;
	}

	return array();
}


/**
 * Generate a list of all available post array
 *
 * @param  string $post_type post type.
 * @return post_array
 */
function decree_generate_post_array( $post_type ) {
	$output = array();
	$posts = get_posts( array(
		'post_type'        => $post_type,
		'post_status'      => 'publish',
		'suppress_filters' => false,
		'posts_per_page'   => -1,
		)
	);

	foreach ( $posts as $post ) {
		$output[ $post->ID ] = $post->post_title;
	}

	return $output;
}


/**
 * Check if a section is enabled or not based on the $value parameter
 *
 * @param  string $value Value of the section that is to be checked.
 * @return boolean return true if section is enabled otherwise false
 */
function decree_check_section( $value ) {
	global $wp_query;

	// Get Page ID outside Loop.
	$page_id = $wp_query->get_queried_object_id();

	// Front page displays in Reading Settings.
	$page_for_posts = (int) get_option( 'page_for_posts' );

	return ( 'entire-site' === $value  || ( ( is_front_page() || ( is_home() && $page_for_posts !== $page_id ) ) && 'homepage' === $value  ) );
}
