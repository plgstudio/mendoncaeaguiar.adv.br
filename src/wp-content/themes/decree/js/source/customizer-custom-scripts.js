/**
 * Add a listener to the Color Scheme control to update other color controls to new values/defaults.
 */

( function( api ) {
   wp.customize( 'decree_theme_options[reset_all_settings]', function( setting ) {
        setting.bind( function( value ) {
            var code = 'needs_refresh';
            if ( value ) {
                setting.notifications.add( code, new wp.customize.Notification(
                    code,
                    {
                        type: 'info',
                        message: decree_data.reset_message
                    }
                ) );
            } else {
                setting.notifications.remove( code );
            }
        } );
    } );

    // Pagination: Show description only when Infinite Scroll is selected.
    wp.customize( 'decree_theme_options[pagination_type]', function( setting ) {
        setting.bind( function( value ) {
            if( 'infinite-scroll' == value ) {
                jQuery('#sub-accordion-section-decree_pagination_options .description.customize-section-description').show();
            }else{
                jQuery('#sub-accordion-section-decree_pagination_options .description.customize-section-description').hide();
            }
        } );
    } );
} )( wp.customize );

jQuery( document ).ready(function() {
    // Check and hide or show description as per the options.
    var pagination_type = jQuery('#customize-control-decree_theme_options-pagination_type select').val();
    if( 'infinite-scroll' == pagination_type ) {
        jQuery('#sub-accordion-section-decree_pagination_options .description.customize-section-description').show();
    }else{
        jQuery('#sub-accordion-section-decree_pagination_options .description.customize-section-description').hide();
    }

} );
