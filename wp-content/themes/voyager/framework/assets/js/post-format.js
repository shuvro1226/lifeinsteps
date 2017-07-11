function showHidePostFormatField(){
    selectedFrmt=(''+jQuery('#post-formats-select input:radio:checked').val());
    jQuery('#cstheme_custom_post_format > div').each(function(){
        if(jQuery(this).hasClass('cstheme_format_'+jQuery('#post-formats-select input:radio:checked').val())){
            jQuery(this).show('fast');
        }else{
            jQuery(this).hide('fast');
        }
    });
}

jQuery(document).ready(function(){    
    // active tab
    showHidePostFormatField();
    jQuery('#post-formats-select input:radio').change(showHidePostFormatField);
    
    
    jQuery(".gallery-images").sortable({
        update: function(event, ui){
            var newimages = '';
            jQuery('.gallery-images img').each(function(){
               newimages += jQuery(this).attr('src')+'""';
            });
            jQuery("input#gallery_images").val(newimages);
        }
    });    
    deleteGalleryImage();
    
});

function deleteGalleryImage() {
    var elementId = '.gallery-images';
    var elementVal = '#gallery_images';
    jQuery('.gallery-delete').unbind('click').bind('click',function(){
        var newimages = '';            
        jQuery(this).closest('.gallery-block').fadeOut('slow',function(){
            jQuery(this).remove();
            jQuery(elementId+' img').each(function(){
                    newimages += jQuery(this).attr('src')+'""';
            });
            jQuery("input"+elementVal).val(newimages);
        });
    });
}

function browseAudio(id){
    var elementIdd = id;
    window.original_send_to_editor = window.send_to_editor;
    window.custom_editor = true;    
    window.send_to_editor = function(html){
        if (elementIdd != undefined) {
            var $audio = jQuery(html).attr('href');
            jQuery('input[name="'+elementIdd+'"]').val($audio);
            return;
        } else {
            window.original_send_to_editor(html);
        }
        elementIdd = undefined;
    };
    wp.media.editor.open();
}

function browseMediaGallery(post_id){
    var elementId = '.gallery-images';
    var elementVal = '#gallery_images';
    var pID=post_id;
    window.original_send_to_editor = window.send_to_editor;
    window.custom_editor = true;   
    window.send_to_editor = function(html){
        jQuery(elementVal).parent().find('img').fadeIn();
        if (elementId != undefined) {            
            html = jQuery("<div />").html(html);
            jQuery(html).find('img').each(function(){
                    var imgurl = jQuery(this).attr('src');
                    var images = imgurl+'""'+jQuery(elementVal).val();
                    jQuery(elementVal).val(images);
                    jQuery(elementId).prepend('<div class="gallery-block" style="position: relative;"><img src="'+imgurl+'" height="100"/><div class="gallery-delete" style="position: absolute;cursor: pointer;top: 0px;width: 15px;height: 15px;background: red;"></div></div>');
                    deleteGalleryImage();
            }).promise().done( function(){ jQuery(elementVal).parent().find('img').fadeOut(); } );
        } else {
            window.original_send_to_editor(html);
        }
        elementId = undefined;
    };
    wp.media.editor.open();
}

window.original_send_to_editor = window.send_to_editor;
window.custom_editor = true;