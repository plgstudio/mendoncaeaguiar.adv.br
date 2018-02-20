<?php
/**
 * The default template for displaying header
 *
 * @package Decree
 */

	/**
	 * decree_doctype hook
	 *
	 * @hooked decree_doctype -  10
	 *
	 */
	do_action( 'decree_doctype' );?>

<head>
<?php
	/**
	 * decree_before_wp_head hook
	 *
	 * @hooked decree_head -  10
	 *
	 */
	do_action( 'decree_before_wp_head' );

	wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php
	/**
     * decree_before_header hook
     *
     */
    do_action( 'decree_before' );

	/**
	 * decree_header hook
	 *
	 * @hooked decree_page_start -  10
	 * @hooked decree_header_top -  20
	 * @hooked decree_promotion_headline - 25
	 * @hooked decree_featured_overall_image (before-header) - 30
	 * @hooked decree_header_start- 40
	 * @hooked decree_mobile_header_nav_anchor - 50
	 * @hooked decree_site_branding - 60
	 * @hooked decree_header_right - 70
	 * @hooked decree_header_end - 100
	 * @hooked decree_header_bottom - 110
	 *
	 */
	do_action( 'decree_header' );

	/**
     * decree_after_header hook
     *
     * @hooked decree_featured_overall_image - 10
     * @hooked decree_primary_menu - 20
     * @hooked decree_news_ticker (below-menu) - 30
     * @hooked decree_add_breadcrumb - 60
     */
	do_action( 'decree_after_header' );

	/**
	 * decree_before_content hook
	 *
	 * @hooked decree_featured_slider - 10
	 * @hooked decree_featured_overall_image (after-slider)  - 30
     * @hooked decree_hero_content_display - 30
	 * @hooked decree_featured_content_display ( featured content before main content - default option) - 40
     * @hooked decree_testimonial_display_position ( testimonial main content - default option) - 50
     * @hooked decree_portfolio_display - 60
     * @hooked decree_logo_slider - 70
     * @hooked decree_promo_head_display - 80
     * @hooked decree_contact_form_display - 90
     * @hooked decree_team_display ( team before main content - default option) - 100
	 */
	do_action( 'decree_before_content' );

	/**
     * decree_main hook
     * @hooked decree_news_ticker (above-content) - 10
     * @hooked decree_before_content_sidebar - 20
     * @hooked decree_content_start - 30
     * @hooked decree_primary_start - 40
     * @hooked decree_main_start - 50
     * @hooked decree_before_posts_pages_sidebar - 60
     */
	do_action( 'decree_content' );
