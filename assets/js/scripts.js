(function($){
    jQuery(document).ready(function(){
        "use_strict";

        jQuery(window).on('load', function() {
            var mal = jQuery('select[id^="post-format-selector"] option:selected').attr('value'); 

            if(mal == 'gallery'){
                jQuery('#gallery').show();
            }else {
                jQuery('#gallery').hide();
            }
            if(mal == 'audio'){
                jQuery('#audio').show();
            }else {
                jQuery('#audio').hide();
            }
            if(mal == 'video'){
                jQuery('#video').show();
            }else {
                jQuery('#video').hide();
            }

            jQuery('.components-input-control__container').change(function(){
                var mal = jQuery('select[id^="post-format-selector"] option:selected').attr('value');

                if(mal == 'gallery'){
                    jQuery('#gallery').show();
                }else {
                    jQuery('#gallery').hide();
                }
                if(mal == 'audio'){
                    jQuery('#audio').show();
                }else {
                    jQuery('#audio').hide();
                }
                if(mal == 'video'){
                    jQuery('#video').show();
                }else {
                    jQuery('#video').hide();
                }    
            });
        });
    });
})(jQuery)