<?php
/**
 * LawyeriaX functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package lawyeriax
 */

define( 'LAWYERIAX_PHP_INCLUDE',  get_template_directory() . '/inc' );

if ( ! function_exists( 'lawyeriax_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function lawyeriax_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on lawyeriax, use a find and replace
		 * to change 'lawyeriax' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'lawyeriax', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 825, 450, true );
		add_image_size( 'lawyeriax-post-thumbnail-home', 350, 230, true );
		add_image_size( 'lawyeriax-team-member-custom-thumbnail', 150, 150, true );

		/*
		 * Enable support for Excerpt for pages.
		 */
		add_post_type_support( 'page', 'excerpt' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary', 'lawyeriax-lite' ),
		) );

			/*
			 * Switch default core markup for search form, comment form, and comments
			 * to output valid HTML5.
			 */
			add_theme_support( 'html5', array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			) );

			/*
			 * Enable support for Post Formats.
			 * See https://developer.wordpress.org/themes/functionality/post-formats/
			 */
			add_theme_support( 'post-formats', array(
				'quote',
			) );

			// Set up the WordPress core custom background feature.
			add_theme_support( 'custom-background', apply_filters( 'lawyeriax_custom_background_args', array(
				'default-color' => 'ffffff',
				'default-image' => '',
			) ) );

			// Set up the WordPress core custom logo feature.
		if ( function_exists( 'the_custom_logo' ) ) {
			add_theme_support( 'custom-logo', array(
				'height'      => 28,
				'width'       => 200,
				'flex-height' => true,
				'flex-width'  => true,
			) );

			if ( get_theme_mod( 'lawyeriax_navbar_logo' ) ) {
					$logo = attachment_url_to_postid( get_theme_mod( 'lawyeriax_navbar_logo' ) );
				if ( is_int( $logo ) ) {
					set_theme_mod( 'custom_logo', $logo );
				}
					remove_theme_mod( 'lawyeriax_navbar_logo' );
			}
		}

			add_theme_support( 'custom-header', array( 'width' => 1800, 'height' => 650 ) );

	}
endif;
add_action( 'after_setup_theme', 'lawyeriax_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function lawyeriax_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'lawyeriax_content_width', 640 );
}
add_action( 'after_setup_theme', 'lawyeriax_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function lawyeriax_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'lawyeriax-lite' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer left widget', 'lawyeriax-lite' ),
		'id'            => 'footer_widget_col_1',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer center widget', 'lawyeriax-lite' ),
		'id'            => 'footer_widget_col_2',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer right widget', 'lawyeriax-lite' ),
		'id'            => 'footer_widget_col_3',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Team Widgets', 'lawyeriax-lite' ),
		'id'            => 'team_widgets',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_widget( 'LawyeriaX_Contact_Widget' );

}
add_action( 'widgets_init', 'lawyeriax_widgets_init' );

/**
 * Class LawyeriaX_Contact_Widget
 */
/**
 * Class LawyeriaX_Contact_Widget
 */
class LawyeriaX_Contact_Widget extends WP_Widget {
	/**
	 * LawyeriaX_Contact_Widget constructor.
	 */
	public function __construct() {
		parent::__construct( 'lawyeriax_contact_widget', __( 'LawyeriaX - Contact', 'lawyeriax-lite' ), array( 'description' => __( 'A contact widget with included social icons options', 'lawyeriax-lite' ) ) );
	}
	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options.
	 */
	public function form( $instance ) {
		if ( ! empty( $instance ) ) {
			$title 						= $instance['title'];
			$addres_line_one 	= $instance['addres_line_one'];
			$addres_line_two 	= $instance['addres_line_two'];
			$phone_number 		= $instance['phone_number'];
			$email_address		= $instance['email_address'];
			$facebook_link		= $instance['facebook_link'];
			$twitter_link			= $instance['twitter_link'];
			$google_link			= $instance['google_link'];
			$linekdin_link		= $instance['linekdin_link'];
			$rss_link					= $instance['rss_link'];
		} ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Widget Title:</label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php  echo ( ! empty( $title )) ? esc_html( $title ) : '' ?>">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'addres_line_one' ); ?>">Address Line One:</label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'addres_line_one' ); ?>" name="<?php echo $this->get_field_name( 'addres_line_one' ); ?>" value="<?php echo ( ! empty( $addres_line_one )) ? esc_html( $addres_line_one ) : ''; ?>">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'addres_line_two' ); ?>">Address Line Two:</label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'addres_line_two' ); ?>" name="<?php echo $this->get_field_name( 'addres_line_two' ); ?>" value="<?php echo ( ! empty( $addres_line_two )) ? esc_html( $addres_line_two ) : ''; ?>">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'phone_number' ); ?>">Phone Number:</label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'phone_number' ); ?>" name="<?php echo $this->get_field_name( 'phone_number' ); ?>" value="<?php echo ( ! empty( $phone_number )) ? esc_html( $phone_number ) : ''; ?>">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'email_address' ); ?>">Email Address:</label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'email_address' ); ?>" name="<?php echo $this->get_field_name( 'email_address' ); ?>" value="<?php echo ( ! empty( $email_address )) ? esc_html( $email_address ) : ''; ?>">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'facebook_link' ); ?>">Facebook Link:</label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'facebook_link' ); ?>" name="<?php echo $this->get_field_name( 'facebook_link' ); ?>" value="<?php echo ( ! empty( $facebook_link )) ? esc_html( $facebook_link ) : ''; ?>">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'twitter_link' ); ?>">Twitter Link:</label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'twitter_link' ); ?>" name="<?php echo $this->get_field_name( 'twitter_link' ); ?>" value="<?php echo ( ! empty( $twitter_link )) ? esc_html( $twitter_link ) : ''; ?>">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'google_link' ); ?>">Google Link:</label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'google_link' ); ?>" name="<?php echo $this->get_field_name( 'google_link' ); ?>" value="<?php echo ( ! empty( $google_link )) ? esc_html( $google_link ) : ''; ?>">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'linekdin_link' ); ?>">LinkedIn Link:</label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'linekdin_link' ); ?>" name="<?php echo $this->get_field_name( 'linekdin_link' ); ?>" value="<?php echo ( ! empty( $linekdin_link )) ? esc_html( $linekdin_link ) : ''; ?>">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'rss_link' ); ?>">Google Link:</label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'rss_link' ); ?>" name="<?php echo $this->get_field_name( 'rss_link' ); ?>" value="<?php echo ( ! empty( $rss_link )) ? esc_html( $rss_link ) : ''; ?>">
		</p>

		<?php
	}
	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options.
	 * @param array $old_instance The previous options.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] 						= strip_tags( $new_instance['title'] );
		$instance['addres_line_one'] 	= strip_tags( $new_instance['addres_line_one'] );
		$instance['addres_line_two'] 	= strip_tags( $new_instance['addres_line_two'] );
		$instance['email_address'] 		= strip_tags( $new_instance['email_address'] );
		$instance['phone_number'] 		= strip_tags( $new_instance['phone_number'] );
		$instance['facebook_link'] 		= strip_tags( $new_instance['facebook_link'] );
		$instance['twitter_link'] 		= strip_tags( $new_instance['twitter_link'] );
		$instance['google_link'] 			= strip_tags( $new_instance['google_link'] );
		$instance['linekdin_link'] 		= strip_tags( $new_instance['linekdin_link'] );
		$instance['rss_link'] 				= strip_tags( $new_instance['rss_link'] );
		return $instance;
	}
	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Widget instance.
	 */
	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		if ( ! empty( $instance ['title'] ) ) :
			echo $args['before_title'] . esc_html( $instance ['title'] ) . $args['after_title'];
		endif;
		?>
		<div class="border-left">

			<div class="address">
				<p><?php if ( ! empty( $instance['addres_line_one'] ) ) :echo esc_html( $instance['addres_line_one'] ); endif; ?></p>
				<p><?php if ( ! empty( $instance['addres_line_two'] ) ) : echo esc_html( $instance['addres_line_two'] ); endif; ?></p>
			</div>

			<p class="contact-widget-email"><?php if ( ! empty( $instance['email_address'] ) ) : echo esc_html( $instance['email_address'] ); endif ?></p>

			<p class="contact-widget-phone"><?php if ( ! empty( $instance['phone_number'] ) ) : echo esc_html( $instance['phone_number'] ); endif; ?></p>

			<p class="contact-widget-social-icons">

				<?php
				if ( ! empty( $instance['facebook_link'] ) ) :
					echo '<a href="' . esc_url( $instance['facebook_link'] ) . '"><i class="fa fa-facebook-square"></i></a>';
				endif;
				if ( ! empty( $instance['twitter_link'] ) ) :
					echo '<a href="' . esc_url( $instance['twitter_link'] ) . '"><i class="fa fa-twitter-square"></i></a>';
				endif;
				if ( ! empty( $instance['google_link'] ) ) :
					echo '<a href="' . esc_url( $instance['google_link'] ) . '"><i class="fa fa-google-plus-square"></i></a>';
				endif;
				if ( ! empty( $instance['linekdin_link'] ) ) :
					echo '<a href="' . esc_url( $instance['linekdin_link'] ) . '"><i class="fa fa-linkedin-square"></i></a>';
				endif;
				if ( ! empty( $instance['rss_link'] ) ) :
					echo '<a href="' . esc_url( $instance['rss_link'] ) . '"><i class="fa fa-rss-square"></i></a>';
				endif;
				?>

			</p>

		</div><!-- border-left -->
		<?php
		echo $args['after_widget'];
	}
}

/**
 * Enqueue scripts and styles.
 */
function lawyeriax_scripts() {
	wp_enqueue_style( 'lawyeriax-style', get_stylesheet_uri(), array( 'boostrap-css' ) );

	wp_enqueue_style( 'boostrap-css', get_template_directory_uri() . '/css/bootstrap.min.css', array(), 'v3.3.6', 'all' );

	wp_enqueue_script( 'boostrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), '20130115', true );

	wp_enqueue_script( 'lawyeriax-navigation', get_template_directory_uri() . '/js/functions.js', array(), '20120206', true );

	wp_enqueue_script( 'skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), 'v4.5.0', false );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'lawyeriax_scripts' );

/**
 * Enqueue customizer scripts and styles.
 */
function lawyeriax_customizer_script() {

	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), 'v4.5.0', false );

	wp_enqueue_style( 'selectric-css', get_stylesheet_directory_uri() . '/css/selectric.css',array(), '1.0.0' );

	wp_enqueue_script( 'selectric', get_template_directory_uri() . '/js/jquery.selectric.js', array( 'jquery' ), '1.0.0' );

}
add_action( 'customize_controls_enqueue_scripts', 'lawyeriax_customizer_script', 10 );

/**
 * LawyeriaX Fonts
 *
 * @return string
 */
function lawyeriax_fonts_url() {
	$fonts_url = '';

	/*
	Translators: If there are characters in your language that are not
	supported by Lora, translate this to 'off'. Do not translate
	into your own language.
	*/
	$playfair_display = _x( 'on', 'Playfair Display font: on or off', 'lawyeriax-lite' );
	$open_sans = _x( 'on', 'Open Sans font: on or off', 'lawyeriax-lite' );
	if ( 'off' !== $playfair_display || 'off' !== $open_sans ) {
		$font_families = array();
		if ( 'off' !== $playfair_display ) {
			$font_families[] = 'Playfair Display:400,700';
		}
		if ( 'off' !== $open_sans ) {
			$font_families[] = 'Open Sans:400,300,600,700';
		}
		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);
		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}
	return $fonts_url;
}

/**
 * Enqueue Fonts
 */
function lawyeriax_scripts_styles() {
	wp_enqueue_style( 'lawyeriax-fonts', lawyeriax_fonts_url(), array(), null );
}
add_action( 'wp_enqueue_scripts', 'lawyeriax_scripts_styles' );

/**
 * Enqueue admin style.
 */
function lawyeriax_admin_styles() {
	wp_enqueue_style( 'lawyeriax-admin-stylesheet', get_template_directory_uri() . '/css/admin-style.css', '1.0.0' );
}
add_action( 'admin_enqueue_scripts', 'lawyeriax_admin_styles', 10 );

/**
 * Custom logo.
 */
function lawyeriax_the_custom_logo() {
	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}
}

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';


/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 *TGM Plugin activation.
 */
require_once get_template_directory() . '/inc/class/class-tgm-plugin-activation.php';

/**
 * TGMPA register
 */
function lawyeriax_register_required_plugins() {
	$plugins = array(
		array(
			'name'     => 'Teammates',
			'slug' 	   => 'teammates',
			'required' => false,
			),

			array(
				'name'     => 'Pirate Forms',
				'slug' 	   => 'pirate-forms',
				'required' => false,
			),
	);

	$config = array(
		'default_path' => '',
		'menu'         => 'tgmpa-install-plugins',
		'has_notices'  => true,
		'dismissable'  => true,
		'dismiss_msg'  => '',
		'is_automatic' => false,
		'message'      => '',
		'strings'      => array(
			'page_title'                      => esc_html__( 'Install Required Plugins', 'lawyeriax-lite' ),
			'menu_title'                      => esc_html__( 'Install Plugins', 'lawyeriax-lite' ),
			'installing'                      => esc_html__( 'Installing Plugin: %s', 'lawyeriax-lite' ),
			'oops'                            => esc_html__( 'Something went wrong with the plugin API.', 'lawyeriax-lite' ),
			'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'lawyeriax-lite' ),
			'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'lawyeriax-lite' ),
			'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'lawyeriax-lite' ),
			'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'lawyeriax-lite' ),
			'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'lawyeriax-lite' ),
			'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'lawyeriax-lite' ),
			'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'lawyeriax-lite' ),
			'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'lawyeriax-lite' ),
			'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'lawyeriax-lite' ),
			'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins', 'lawyeriax-lite' ),
			'return'                          => esc_html__( 'Return to Required Plugins Installer', 'lawyeriax-lite' ),
			'plugin_activated'                => esc_html__( 'Plugin activated successfully.', 'lawyeriax-lite' ),
			'complete'                        => esc_html__( 'All plugins installed and activated successfully. %s', 'lawyeriax-lite' ),
			'nag_type'                        => 'updated',
		),
	);
	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'lawyeriax_register_required_plugins' );

/**
 * Define Allowed Files to be included
 *
 * @return array
 */
function lawyeriax_filter_phpfiles() {
	return array(

		/* Customizer Controls */
		'/customizer/customizer-theme-info',
		'/customizer/customizer-lite-header',
		'/customizer/customizer-top-bar',

		'/customizer/customizer-navbar-logo',
		'/customizer/customizer-slider-controls',
		'/customizer/customizer-ribbon-controls',
		'/customizer/customizer-features-controls',
		'/customizer/customizer-lawyers-controls',
		'/customizer/customizer-practice-controls',
		'/customizer/customizer-about-controls',
		'/customizer/customizer-clients-controls',
		'/customizer/customizer-news-controls',
		'/customizer/customizer-case-studies-controls',
		'/customizer/customizer-testimonials-controls',

		'/customizer/customizer-advanced-controls',
		'/customizer/customizer-colors-controls',
		'/customizer/customizer-footer-controls',

		'/customizer/customizer-pro-manager',

		/* Sections */
		'/sections/frontpage-slider',
		'/sections/frontpage-bigtitle',
		'/sections/frontpage-ribbon',
		'/sections/frontpage-features-pro',
		'/sections/frontpage-lawyers',
		'/sections/frontpage-practice',
		'/sections/frontpage-about',
		'/sections/frontpage-clients',
		'/sections/frontpage-news',
		'/sections/frontpage-testimonials',
		'/sections/frontpage-features',

	);
}
add_filter( 'lawyeriax_filter_phpfiles', 'lawyeriax_filter_phpfiles' );

/**
 * Include features files.
 */
function lawyeriax_include_files() {
	$inc_dir = rtrim( LAWYERIAX_PHP_INCLUDE, '/' );
	$allowed_phps = array();
	$allowed_phps = apply_filters( 'lawyeriax_filter_phpfiles',$allowed_phps );
	foreach ( $allowed_phps as $file ) {
		$file_to_include = $inc_dir . $file . '.php';
		if ( file_exists( $file_to_include ) ) {
			include_once( $file_to_include );
		}
	}
}
add_action( 'after_setup_theme','lawyeriax_include_files' );

/**
 * Get the slider shortcode for the header area
 *
 * @return string
 */
function lawyeriax_get_slider_shortcode() {
	$slider_content = '';
	$lite_content = get_option( 'theme_mods_lawyeriax-lite' );
	if ( ! empty( $lite_content ) ) {
		if ( array_key_exists( 'lawyeriax_slider_shortcode', $lite_content ) ) {
			$slider_content = $lite_content['lawyeriax_slider_shortcode'];
		}
	}
	return $slider_content;
}


/**
 * Function for returning section priority
 *
 * @param int    $value Default priority.
 * @param string $key Section id.
 *
 * @return int
 */
function lawyeriax_get_section_priority( $value, $key = '' ) {
	$orders = get_theme_mod( 'sections_order' );
	if ( ! empty( $orders ) ) {
		$json = json_decode( $orders );
		if ( isset( $json->$key ) ) {
			return $json->$key;
		}
	}
	return $value;
}
add_filter( 'lawyeriax_section_priority', 'lawyeriax_get_section_priority', 10, 2 );


/**
 * Filter to translate strings
 */
function lawyeriax_translate_single_string( $original_value, $domain ) {
	if ( is_customize_preview() ) {
		$wpml_translation = $original_value;
	} else {
		$wpml_translation = apply_filters( 'wpml_translate_single_string', $original_value, $domain, $original_value );
		if ( $wpml_translation === $original_value && function_exists( 'pll__' ) ) {
			return pll__( $original_value );
		}
	}
	return $wpml_translation;
}
add_filter( 'lawyeriax_translate_single_string', 'lawyeriax_translate_single_string', 10, 3 );

/**
 * Helper to register pll string.
 *
 * @param String    $theme_mod Theme mod name.
 * @param bool/json $default Default value.
 * @param String    $name Name for polylang backend.
 */
function lawyeriax_pll_string_register_helper( $theme_mod, $default = false, $name ) {
	if ( ! function_exists( 'pll_register_string' ) ) {
		return;
	}

	$repeater_content = get_theme_mod( $theme_mod, $default );
	$repeater_content = json_decode( $repeater_content );
	if ( ! empty( $repeater_content ) ) {
		foreach ( $repeater_content as $repeater_item ) {
			foreach ( $repeater_item as $field_name => $field_value ) {
				if ( $field_name === 'social_repeater' ) {
					$social_repeater_value = json_decode( $field_value );
					foreach ( $social_repeater_value as $social ) {
						foreach ( $social as $key => $value ) {
							if ( $key === 'link' ) {
								pll_register_string( 'Social link', $value, $name );
							}
							if ( $key === 'icon' ) {
								pll_register_string( 'Social icon', $value, $name );
							}
						}
					}
				} else {
					if ( $field_name !== 'id' ) {
						if ( function_exists( 'ucfirst' ) ) {
							$f_n = ucfirst( $field_name );
						} else {
							$f_n = $field_name;
						}
						pll_register_string( $f_n, $field_value, $name );
					}
				}
			}
		}
	}

}
