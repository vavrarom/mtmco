/**
 * Icon selection code
 * @param {type} param
 */
jQuery(window).load(function () {
    /**
     * Add active class on the selected icon list from icon pool
     */
    jQuery('ul.icon_pool li input.selected_icon').each(function () {
        select_val = jQuery(this).val();
        jQuery(this).parent().parent().each(function () {
            if (jQuery(this).find('i').hasClass(select_val)) {
                jQuery(this).find('i.' + select_val.replace(/ /, '.')).parent('li').addClass('active')
            }
        });
    });
    /**
     * Dynamic change icon on icon selection
     */
    jQuery('ul.icon_pool li').each(function () {
        jQuery(this).click(function () {
            var icon_class = jQuery(this).find('i').attr('class');
            jQuery('ul.icon_pool li').removeAttr('class');
            jQuery(this).addClass('active');
            this_select_value = jQuery(this).parents('div.dropdown').find('input.selected_icon').val(jQuery(this).find('i').attr('class')).trigger('change');
            jQuery(this).parents('div.dropdown').find('button#IconMenu').html("<li class='active'><i class='" + icon_class + " fa-2x'></i></li><span class='caret'></span>");
        });
    });
});


//jQuery(document).ready(function($){
//    $('textarea[name="onepage_custom_editor"]').attr('data-customize-setting-link','onepage_custom_editor');
//
//    setTimeout(function(){
//
//        var editor2 = tinyMCE.get('onepage_custom_editor');
//
//
//        if(editor2){
//            editor2.onChange.add(function (ed, e) {
//                // Update HTML view textarea (that is the one used to send the data to server).
//
//                ed.save();
//
//                $('textarea[name="onepage_custom_editor"]').trigger('change');
//            });
//        }
//    },1000);
//})