<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package lawyeriax
 */
$phone_number   = get_theme_mod( 'lawyeriax_top_bar_phone_number' );
$email_address  = get_theme_mod( 'lawyeriax_top_bar_email_address' );
$social_icons   = get_theme_mod( 'lawyeriax_top_bar_social_icons' );
$top_bar_hide   = get_theme_mod( 'lawyeriax_top_bar_hide', true );

if ( function_exists( 'the_custom_logo' ) ) {
	$website_logo_id = get_theme_mod( 'custom_logo' );
	$website_logo_meta = wp_get_attachment_image_src( $website_logo_id, 'full' );
	$website_logo = $website_logo_meta[0];
} else {
	$website_logo = get_theme_mod( 'lawyeriax_navbar_logo', get_template_directory_uri() . '/images/logo.png' );
} ?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php
if ( is_singular() && pings_open( get_queried_object() ) ) { ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php
} ?>
<?php
wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'lawyeriax-lite' ); ?></a>

		<header id="masthead" class="site-header" role="banner">

			<div class="navbar navbar-main sticky-navigation navbar-fixed-top">
				<?php
				$classes_to_add = (bool) $top_bar_hide !== true ? 'top-bar' : (is_customize_preview() ? 'top-bar hidden-in-customizer' : '') ;
				if ( ! empty( $classes_to_add ) ) { ?>
					<div id="top-bar" class="<?php echo esc_attr( $classes_to_add ); ?>">
						<div class="container">
							<div class="top-bar-left top-bar-social">
			                    <?php
			                    if ( ! empty( $social_icons ) ) {
				                    $social_icons_decoded = json_decode( $social_icons );
				                    if ( ! empty( $social_icons_decoded ) ) {
					                    foreach ( $social_icons_decoded as $icon ) {
						                    $social_link = apply_filters( 'lawyeriax_translate_single_string', $icon->link, 'Social Icons Link' );
						                    $social_icon = apply_filters( 'lawyeriax_translate_single_string', $icon->icon_value, 'Social Icon' );
						                    if ( ! empty( $social_link ) && ! empty( $social_icon ) ) { ?>
												<a href="<?php echo esc_url( $social_link ); ?>">
													<i class="fa <?php echo esc_attr( $social_icon ); ?>"></i>
												</a>
							                    <?php
						                    }
					                    }
				                    }
			                    } else {
				                    if ( current_user_can( 'edit_theme_options' ) ) { ?>
										<p>
										<span>
											<?php
											if ( ! is_customize_preview() ) {
												printf(
													__( 'Edit social icons in <a class="link-to-customizer" href="%s">customizer</a>.', 'lawyeriax-lite' ),
													admin_url( 'customize.php?autofocus[control]=lawyeriax_top_bar_social_icons' )
												);
											} else {
												esc_html_e( 'Edit social icons in customizer.', 'lawyeriax-lite' );
											} ?>
										</span>
										</p>
					                    <?php
				                    }
			                    } ?>
							</div>
							<div class="top-bar-right top-bar-contact">
			                    <?php
			                    if ( ! empty( $phone_number ) ) { ?>
									<p>
										<a class="lawyeriax-contact-phone" href="tel:<?php echo strip_tags( $phone_number ); ?>">
											</i><span><?php echo wp_kses_post( $phone_number ); ?></span>
										</a>
									</p>
				                    <?php
			                    } else {
				                    if ( current_user_can( 'edit_theme_options' ) ) { ?>
										<p>
											<i class="fa fa-phone-square"></i>
											<span>
										<?php
										if ( ! is_customize_preview() ) {
											printf(
												__( 'Edit phone in <a class="link-to-customizer" href="%s">customizer</a>.', 'lawyeriax-lite' ),
												admin_url( 'customize.php?autofocus[control]=lawyeriax_top_bar_phone_number' )
											);
										} else {
											esc_html_e( 'Edit phone in customizer.', 'lawyeriax-lite' );
										} ?>
									</span>
										</p>
					                    <?php
				                    }
			                    }

			                    if ( ! empty( $email_address ) ) { ?>
									<p>
										<a class="lawyeriax-contact-email" href="<?php if ( filter_var( strip_tags( $email_address ), FILTER_VALIDATE_EMAIL ) ) { echo 'mailto:' . strip_tags( $email_address ); } else { echo '#'; } ?>">
											<span><?php echo wp_kses_post( $email_address ); ?></span>
										</a>
									</p>
				                    <?php
			                    } else {
				                    if ( current_user_can( 'edit_theme_options' ) ) { ?>
										<p>
											<i class="fa fa-envelope-square"></i>
											<span>
									<?php
									if ( ! is_customize_preview() ) {
										printf(
											__( 'Edit email in <a class="link-to-customizer" href="%s">customizer</a>.', 'lawyeriax-lite' ),
											admin_url( 'customize.php?autofocus[control]=lawyeriax_top_bar_email_address' )
										);
									} else {
										esc_html_e( 'Edit email in customizer.', 'lawyeriax-lite' );
									} ?>
								</span>
										</p>
					                    <?php
				                    }
			                    } ?>
							</div>
						</div> <!-- container -->
					</div>
					<?php
				} ?>

				<div class="container container-header">
					<div class="header-inner">

						<div class="header-inner-site-branding">
							<div class="site-branding-wrap">
								<div class="site-branding">
									<?php
									if ( ! empty( $website_logo ) ) { ?>
										<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php get_bloginfo( 'title' ); ?>">
											<img src="<?php echo esc_url( $website_logo ); ?>" alt="<?php get_bloginfo( 'title' ); ?>"/>
										</a>
									<?php
									} else { ?>
										<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
								        <?php
										$description = get_bloginfo( 'description', 'display' );
										if ( $description || is_customize_preview() ) { ?>
											<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
										<?php
										}
									} ?>
								</div><!-- .site-branding -->
							</div><!-- .site-branding-wrap -->

							<div class="menu-toggle-button-wrap">
								<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
									<i class="fa fa-bars"></i>
									<span><?php esc_html_e( 'Primary Menu', 'lawyeriax-lite' ); ?></span>
								</button>
							</div>
						</div>

						<div class="main-navigation-wrap">
							<nav id="site-navigation" class="main-navigation" role="navigation">
								<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
							</nav><!-- #site-navigation -->
						</div>
					</div><!-- .header-inner -->
				</div><!-- .container -->
			</div>
		</header><!-- #masthead -->

		<div id="content" class="site-content">
			<div class="container">
