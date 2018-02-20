<?php
/**
 * The template for displaying the footer
 *
 * @package Decree
 */


/**
 * decree_after_content hook
 *
 * @hooked decree_content_end - 10
 * @hooked decree_after_content_sidebar - 20
 * @hooked decree_featured_content_display ( featured content below main content ) - 30
 * @hooked decree_testimonial_display ( testimonial below main content ) - 40
 * @hooked decree_team_display ( team content below main content ) - 50
 *
 */
do_action( 'decree_after_content' );


/**
 * decree_footer hook
 *
 * @hooked decree_footer_content_start - 10
 * @hooked decree_contact_info_display - 20
 * @hooked decree_footer_sidebar - 30
 * @hooked decree_site_generator_start - 40
 * @hooked decree_footer_menu - 50
 * @hooked decree_footer_content - 60
 * @hooked decree_site_generator_end - 70
 * @hooked decree_footer_content_end - 80
 * @hooked decree_page_end - 90
 *
 */
do_action( 'decree_footer' );


/**
 * decree_after hook
 *
 * @hooked decree_scrollup - 10
 * @hooked decree_mobile_menus- 20
 *
 */
do_action( 'decree_after' );

wp_footer(); ?>
</body>
</html>
