/*global wp*/
function lawyeriax_lite_media_upload(button_class) {
    'use strict';
    jQuery('body').on('click', button_class, function() {
        var button_id ='#'+jQuery(this).attr('id');
        var display_field = jQuery(this).parent().children('input:text');
        var _custom_media = true;

        wp.media.editor.send.attachment = function(props, attachment){

            if ( _custom_media  ) {
                if(typeof display_field !== 'undefined'){
                    switch(props.size){
                        case 'full':
                            display_field.val(attachment.sizes.full.url);
                            display_field.trigger('change');
                            break;
                        case 'medium':
                            display_field.val(attachment.sizes.medium.url);
                            display_field.trigger('change');
                            break;
                        case 'thumbnail':
                            display_field.val(attachment.sizes.thumbnail.url);
                            display_field.trigger('change');
                            break;
                        case 'lawyeriax_team':
                            display_field.val(attachment.sizes.lawyeriax_team.url);
                            display_field.trigger('change');
                            break;
                        case 'lawyeriax_services':
                            display_field.val(attachment.sizes.lawyeriax_services.url);
                            display_field.trigger('change');
                            break;
                        case 'lawyeriax_customers':
                            display_field.val(attachment.sizes.lawyeriax_customers.url);
                            display_field.trigger('change');
                            break;
                        default:
                            display_field.val(attachment.url);
                            display_field.trigger('change');
                    }
                }
                _custom_media = false;
            } else {
                return wp.media.editor.send.attachment( button_id, [props, attachment] );
            }
        };
        wp.media.editor.open(button_class);
        window.send_to_editor = function() {

        };
        return false;
    });
}


/********************************************
 *** Generate uniq id ***
 *********************************************/
function lawyeriax_lite_uniqid(prefix, more_entropy) {
    'use strict';
    if (typeof prefix === 'undefined') {
        prefix = '';
    }

    var retId;
    var php_js;
    var formatSeed = function (seed, reqWidth) {
        seed = parseInt(seed, 10)
            .toString(16); // to hex str
        if (reqWidth < seed.length) { // so long we split
            return seed.slice(seed.length - reqWidth);
        }
        if (reqWidth > seed.length) { // so short we pad
            return new Array(1 + (reqWidth - seed.length))
                    .join('0') + seed;
        }
        return seed;
    };

    // BEGIN REDUNDANT
    if (!php_js) {
        php_js = {};
    }
    // END REDUNDANT
    if (!php_js.uniqidSeed) { // init seed with big random int
        php_js.uniqidSeed = Math.floor(Math.random() * 0x75bcd15);
    }
    php_js.uniqidSeed++;

    retId = prefix; // start with prefix, add current milliseconds hex string
    retId += formatSeed(parseInt(new Date()
            .getTime() / 1000, 10), 8);
    retId += formatSeed(php_js.uniqidSeed, 5); // add seed hex string
    if (more_entropy) {
        // for more entropy we add a float lower to 10
        retId += (Math.random() * 10)
            .toFixed(8)
            .toString();
    }

    return retId;
}

var entityMap = {
    '&': '&amp;',
    '<': '&lt;',
    '>': '&gt;',
    '"': '&quot;',
    '\'': '&#39;',
    '/': '&#x2F;'
};




/********************************************
 *** General Repeater ***
 *********************************************/
function lawyeriax_lite_refresh_general_control_values(){
    'use strict';
    jQuery('.lawyeriax_general_control_repeater').each(function(){
        var values = [];
        var th = jQuery(this);
        th.find('.lawyeriax_general_control_repeater_container').each(function(){
            var icon_value = jQuery(this).find('.icp').val();
            var text = jQuery(this).find('.lawyeriax_text_control').val();
            var link = jQuery(this).find('.lawyeriax_link_control').val();
            var image_url = jQuery(this).find('.custom_media_url').val();
            var choice = jQuery(this).find('.lawyeriax_image_choice').val();
            var title = jQuery(this).find('.lawyeriax_title_control').val();
            var subtitle = jQuery(this).find('.lawyeriax_subtitle_control').val();
            var button_text = jQuery(this).find('.lawyeriax_button_text_control').val();
            var id = jQuery(this).find('.lawyeriax_box_id').val();
            if( text !== '' || image_url !== '' || title !== '' || subtitle !== '' || button_text !== '' ){
                values.push({
                    'icon_value': (choice === 'lawyeriax_none' ? '' : icon_value),
                    'text': lawyeriax_lite_escapeHtml(text),
                    'button_text': lawyeriax_lite_escapeHtml(button_text),
                    'link': link,
                    'image_url': (choice === 'lawyeriax_none' ? '' : image_url),
                    'choice': choice,
                    'title': lawyeriax_lite_escapeHtml(title),
                    'subtitle': lawyeriax_lite_escapeHtml(subtitle),
                    'id': id
                });
            }

        });
        th.find('.lawyeriax_repeater_colector').val(JSON.stringify(values));
        th.find('.lawyeriax_repeater_colector').trigger('change');
    });
}




jQuery(document).ready(function(){
    'use strict';
    var theme_conrols = jQuery('#customize-theme-controls');

    theme_conrols.on('click','.repeater-customize-control-title',function(){
        jQuery(this).next().slideToggle('medium', function() {
            if (jQuery(this).is(':visible')){
                jQuery(this).css('display','block');
            }
        });
    });

    theme_conrols.on('change','.lawyeriax_image_choice',function() {
        if(jQuery(this).val() === 'lawyeriax_image'){
            jQuery(this).parent().parent().find('.lawyeriax_general_control_icon').hide();
            jQuery(this).parent().parent().find('.lawyeriax_image_control').show();
        }
        if(jQuery(this).val() === 'lawyeriax_icon'){
            jQuery(this).parent().parent().find('.lawyeriax_general_control_icon').show();
            jQuery(this).parent().parent().find('.lawyeriax_image_control').hide();
        }
        if(jQuery(this).val() === 'lawyeriax_none'){
            jQuery(this).parent().parent().find('.lawyeriax_general_control_icon').hide();
            jQuery(this).parent().parent().find('.lawyeriax_image_control').hide();
        }

        lawyeriax_lite_refresh_general_control_values();
        return false;
    });
    lawyeriax_lite_media_upload('.custom_media_button_repeater');
    jQuery('.custom_media_url').live('change',function(){
        lawyeriax_lite_refresh_general_control_values();
        return false;
    });

    jQuery('.lawyeriax_general_control_new_field').on('click',function(){

        var th = jQuery(this).parent();
        var id = 'lawyeriax_'+lawyeriax_lite_uniqid();
        if(typeof th !== 'undefined') {

            var field = th.find('.lawyeriax_general_control_repeater_container:first').clone();
            if(typeof field !== 'undefined'){
                field.find('.lawyeriax_image_choice').val('lawyeriax_icon');
                field.find('.lawyeriax_general_control_icon').show();
                if(field.find('.lawyeriax_general_control_icon').length > 0){
                    field.find('.lawyeriax_image_control').hide();
                }

                field.find('.lawyeriax_general_control_remove_field').show();
                field.find('.lawyeriax_text_control').val('');
                field.find('.lawyeriax_button_text_control').val('');
                field.find('.lawyeriax_link_control').val('');
                field.find('.lawyeriax_box_id').val(id);
                /* Empty control for icon */
                field.find( '.icp' ).iconpicker().on( 'iconpickerUpdated', function() {
                    jQuery( this ).trigger( 'change' );
                } );
                field.find( '.input-group-addon' ).find('.fa').attr('class','fa');

                /*Remove value from icon field*/
                field.find('.icp').val('');


                field.find('.custom_media_url').val('');
                field.find('.lawyeriax_title_control').val('');
                field.find('.lawyeriax_subtitle_control').val('');
                th.find('.lawyeriax_general_control_repeater_container:first').parent().append(field);
            }

        }
        return false;
    });

    theme_conrols.on('click', '.lawyeriax_general_control_remove_field',function(){
        if( typeof	jQuery(this).parent() !== 'undefined'){
            jQuery(this).parent().parent().remove();
            lawyeriax_lite_refresh_general_control_values();
        }
        return false;
    });


    theme_conrols.on('keyup', '.lawyeriax_title_control',function(){
        lawyeriax_lite_refresh_general_control_values();
    });

    theme_conrols.on('keyup', '.lawyeriax_subtitle_control',function(){
        lawyeriax_lite_refresh_general_control_values();
    });

    theme_conrols.on('keyup', '.lawyeriax_text_control',function(){
        lawyeriax_lite_refresh_general_control_values();
    });

    theme_conrols.on('keyup', '.lawyeriax_button_text_control',function(){
        lawyeriax_lite_refresh_general_control_values();
    });

    theme_conrols.on('keyup', '.lawyeriax_link_control',function(){
        lawyeriax_lite_refresh_general_control_values();
    });

    jQuery('.icp').iconpicker().on( 'iconpickerUpdated', function() {
        lawyeriax_lite_refresh_general_control_values();
    } );

    theme_conrols.on('change', '.icp',function(){
        lawyeriax_lite_refresh_general_control_values();
        return false;
    });

    /*Drag and drop to change icons order*/
    jQuery('.lawyeriax_general_control_droppable').sortable({
        update: function() {
            lawyeriax_lite_refresh_general_control_values();
        }
    });

});


function lawyeriax_lite_escapeHtml(string) {
    'use strict';
    var str = String(string).replace(new RegExp('\r?\n','g'), '<br />');
    str = String(str).replace(/\\/g,'&#92;');
    return String(str).replace(/[&<>"'\/]/g, function (s) {
        return entityMap[s];
    });

}
