<?php
/**
 * The template for adding Custom Sidebars and Widgets
 *
 * @package Decree
 */

/**
 * Register widgetized area
 *
 * @since Decree 0.1
 */
function decree_widgets_init() {
	// Primary Sidebar.
	register_sidebar( array(
		'name'          => esc_html__( 'Primary Sidebar', 'decree' ),
		'id'            => 'primary-sidebar',
		'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-wrap">',
		'after_widget'  => '</div><!-- .widget-wrap --></section><!-- .widget -->',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
		'description'	=> esc_html__( 'This is the primary sidebar if you are using a two or three column site layout option.', 'decree' ),
	) );

	$footer_sidebar_number = 3; // Number of footer sidebars.

	for ( $i = 1; $i <= $footer_sidebar_number; $i++ ) {
		register_sidebar( array(
			'name'          => sprintf( esc_html__( 'Footer Area %d', 'decree' ), $i ),
			'id'            => sprintf( 'footer-%d', $i ),
			'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-wrap">',
			'after_widget'  => '</div><!-- .widget-wrap --></section><!-- .widget -->',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
			'description'	=> sprintf( esc_html__( 'Footer %d widget area.', 'decree' ), $i ),
		) );
	}
}
add_action( 'widgets_init', 'decree_widgets_init' );


/**
 * Loads up Necessary JS Scripts for widgets
 *
 * @param [string] $hook current screen slug.
 */
function decree_widgets_scripts( $hook ) {
	if ( 'widgets.php' === $hook ) {
		wp_enqueue_style( 'decree-widgets-styles', get_template_directory_uri() . '/css/widgets.css' );
	}
}
add_action( 'admin_enqueue_scripts', 'decree_widgets_scripts' );

// Load Social Icon Widget.
include trailingslashit( get_template_directory() ) . 'inc/widgets/social-icons.php';
