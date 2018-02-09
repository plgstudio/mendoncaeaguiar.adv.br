<?php

/**
 * Review notice on theme activation
 */
function integral_review_notice() {
    global $current_user ;
        $user_id = $current_user->ID;
        /* Check that the user hasn't already clicked to ignore the message */
    if ( ! get_user_meta($user_id, 'elemental_ignore_notice') ) { ?>
        <div class="notice notice-success is-dismissible">
        <p><?php _e('Love using Integral? Submit a review and tell us how Integral helped you build your website.', 'integral'); ?> <a class="button button-primary" target="_blank" href="<?php echo esc_url('https://wordpress.org/support/theme/integral/reviews/#new-post'); ?>"><?php esc_html_e('Sure! I\'d love to review Integral', 'integral'); ?></a> <a class="button" href="?integral_review_nag_ignore=0"><?php esc_html_e('No thanks', 'integral'); ?></a></p>
        </div>
    <?php }
}
add_action('admin_notices', 'integral_review_notice', 100);

function integral_review_nag_ignore() {
    global $current_user;
        $user_id = $current_user->ID;
        /* If user clicks to ignore the notice, add that to their user meta */
        if ( isset($_GET['integral_review_nag_ignore']) && '0' == $_GET['integral_review_nag_ignore'] ) {
             add_user_meta($user_id, 'elemental_ignore_notice', 'true', true);
    }
}
add_action('admin_init', 'integral_review_nag_ignore');