function showHidePostFormatField(){  
    jQuery('#normal-sortables>[id*="cs-format-"]').each(function(){
       if(jQuery(this).attr('id').replace("cs","post")===jQuery('#post-formats-select input:radio:checked').attr('id').replace('image', '0')){
           jQuery(this).css('display', 'block');
       } else {
           jQuery(this).css('display', 'none');
       }
    });    
}

jQuery(function(){
		
    /* Color Picker */
    jQuery(".color_picker").ColorPicker({
        onShow: function (colpkr) {
            jQuery(colpkr).fadeIn(500);
            return false;
        },
        onHide: function (colpkr) {
            jQuery(colpkr).fadeOut(500);
            return false;
        },
        onChange: function (hsb, hex, rgb, el) {
            jQuery(el).parent().find('.color_picker_inner').css('backgroundColor', '#' + hex);
            jQuery(el).parent().find('.color_picker_value').val('#' + hex);
        }
    });

    
    /* Check show hide */
    jQuery('.check-show-hide').change(function() {
        var datashow = jQuery(this).attr('data-show');
        var datahide = jQuery(this).attr('data-hide');
        if(jQuery(this).is(':checked')) {
            jQuery(datashow).fadeIn();
            jQuery(datahide).fadeOut();
        } else {
            jQuery(datashow).fadeOut();
            jQuery(datahide).fadeIn();
        }
    });
    jQuery('.check-show-hide').each(function() {
        jQuery(this).change();
    });
	
	
	/* Page template */
    var selector = "#page_template";
    var defaultpage = "#page_meta_settings";
    var page_portfolio = "#page_portfolio_meta_settings";
	var comingsoon = "#comingsoon_meta_settings";
	jQuery(defaultpage).fadeOut();
	jQuery(page_portfolio).fadeOut();
	jQuery(comingsoon).fadeOut();
    jQuery(selector).bind('change', function(){
        var template = jQuery(this).val();
        if(template=='page-custom-blog.php'){
            jQuery(comingsoon).fadeOut();
			jQuery(defaultpage).fadeIn();
			jQuery(page_portfolio).fadeOut();
        } else if(template=='page-comingsoon.php'){
            jQuery(defaultpage).fadeOut();
            jQuery(comingsoon).fadeIn();
            jQuery('#page_custom_layout_settings').fadeOut();
			jQuery(page_portfolio).fadeOut();
		} else if(template=='page-portfolio.php'){
            jQuery(page_portfolio).fadeIn();
			jQuery(comingsoon).fadeOut();
		} else {
            jQuery(defaultpage).fadeOut();
			jQuery(comingsoon).fadeOut();
			jQuery(page_portfolio).fadeOut();
        }
    });    
    jQuery(selector).change();
	
	/* Select options */            
    jQuery(".cs-metaboxes select").each(function(){
        $this = jQuery(this);
        if( $this.attr("data-value") != "" ){
            $this.val($this.attr("data-value"));
        }
    });
	
	/* Post list chess, left image, grid background style  */
    jQuery("#blog_list_style select").change(function(){
        var $this = jQuery(this);
        if( $this.val() == "left-image" ){
            jQuery("#posts_per_page").fadeIn();
			jQuery("#blog_list_layout, #post_padding, #posts_pagin_style, #posts_in_a_row, #magazine_count_blocks, #magazine_style_orderby, #blog_list_category_magazine_block2, #magazine_style_orderby_block2, #posts_per_page_magazine_block2, #bloglist_banner2").fadeOut();
        } else if( $this.val() == "top_image" ){
            jQuery("#blog_list_layout, #posts_per_page, #posts_in_a_row").fadeIn();
			jQuery("#post_padding, #posts_pagin_style, #magazine_count_blocks, #magazine_style_orderby, #blog_list_category_magazine_block2, #magazine_style_orderby_block2, #posts_per_page_magazine_block2, #bloglist_banner2").fadeOut();
        } else if( $this.val() == "chess" ){
            jQuery("#posts_per_page").fadeIn();
			jQuery("#blog_list_layout, #posts_pagin_style, #post_padding, #posts_in_a_row, #magazine_count_blocks, #magazine_style_orderby, #blog_list_category_magazine_block2, #magazine_style_orderby_block2, #posts_per_page_magazine_block2, #bloglist_banner2").fadeOut();
        } else if( $this.val() == "grid-bg" ){
            jQuery("#blog_list_layout, #posts_per_page, #posts_in_a_row, #post_padding").fadeIn();
			jQuery("#posts_pagin_style, #magazine_count_blocks, #magazine_style_orderby, #blog_list_category_magazine_block2, #magazine_style_orderby_block2, #posts_per_page_magazine_block2, #bloglist_banner2").fadeOut();
        } else if( $this.val() == "masonry-bg" ){
            jQuery("#blog_list_layout, #posts_per_page, #posts_in_a_row, #posts_pagin_style, #post_padding").fadeIn();
            jQuery("#magazine_count_blocks, #magazine_style_orderby, #blog_list_category_magazine_block2, #magazine_style_orderby_block2, #posts_per_page_magazine_block2, #bloglist_banner2").fadeOut();
        } else if( $this.val() == "line_bg" ){
            jQuery("#posts_per_page").fadeIn();
			jQuery("#blog_list_layout, #posts_pagin_style, #post_padding, #posts_in_a_row, #magazine_count_blocks, #magazine_style_orderby, #blog_list_category_magazine_block2, #magazine_style_orderby_block2, #posts_per_page_magazine_block2, #bloglist_banner2").fadeOut();
        } else if( $this.val() == "line_thumb" ){
            jQuery("#posts_per_page").fadeIn();
			jQuery("#blog_list_layout, #posts_pagin_style, #post_padding, #posts_in_a_row, #magazine_count_blocks, #magazine_style_orderby, #blog_list_category_magazine_block2, #magazine_style_orderby_block2, #posts_per_page_magazine_block2, #bloglist_banner2").fadeOut();
        } else if( $this.val() == "fullwidth_img" ){
            jQuery("#posts_per_page").fadeIn();
			jQuery("#blog_list_layout, #posts_pagin_style, #post_padding, #posts_in_a_row, #magazine_count_blocks, #magazine_style_orderby, #blog_list_category_magazine_block2, #magazine_style_orderby_block2, #posts_per_page_magazine_block2, #bloglist_banner2").fadeOut();
        } else if( $this.val() == "metro" ){
            jQuery("#posts_per_page, #blog_list_layout, #posts_pagin_style, #posts_in_a_row").fadeIn();
			jQuery("#post_padding, #magazine_count_blocks, #magazine_style_orderby, #blog_list_category_magazine_block2, #magazine_style_orderby_block2, #posts_per_page_magazine_block2, #bloglist_banner2").fadeOut();
        } else if( $this.val() == "magazine" ){
			jQuery("#magazine_count_blocks, #magazine_style_orderby, #blog_list_category_magazine_block2, #magazine_style_orderby_block2, #posts_per_page_magazine_block2, #bloglist_banner2").fadeIn();
			jQuery("#blog_list_layout, #posts_in_a_row, #posts_pagin_style, #post_padding").fadeOut();
        } else if( $this.val() == "clean_card" ){
			jQuery("#blog_list_layout, #posts_per_page, #posts_pagin_style").fadeIn();
			jQuery("#magazine_count_blocks, #magazine_style_orderby, #blog_list_category_magazine_block2, #magazine_style_orderby_block2, #posts_per_page_magazine_block2, #bloglist_banner2, #posts_in_a_row, #post_padding").fadeOut();
        } else {
            jQuery("#blog_list_layout, #posts_per_page, #posts_in_a_row, #posts_pagin_style").fadeIn();
			jQuery("#post_padding, #magazine_style_orderby, #magazine_style_orderby, #blog_list_category_magazine_block2, #magazine_style_orderby_block2, #posts_per_page_magazine_block2").fadeOut();
        }
    });
    jQuery("#blog_list_style select").change();
	
	/* Post Slider Type */
    jQuery("#top_slider select").change(function(){
        var $this = jQuery(this);
        if( $this.val() == "disabled" ){
			jQuery("#top_slider_style, #top_slider_category, #top_slider_count").fadeOut();
        } else {
            jQuery("#top_slider_style, #top_slider_category, #top_slider_count").fadeIn();
        }
    });
    jQuery("#top_slider select").change();
    
    /* Categories List */
    jQuery("#categories_list select").change(function(){
        var $this = jQuery(this);
        if( $this.val() == "disabled" ){
			jQuery("#categories_style, #categories_filter_ids, #categories_list_position").fadeOut();
        } else {
            jQuery("#categories_style, #categories_filter_ids, #categories_list_position").fadeIn();
        }
    });
    jQuery("#categories_list select").change();
	
	/* Posts Carousel */
    jQuery("#posts_carousel select").change(function(){
        var $this = jQuery(this);
        if( $this.val() == "disabled" ){
			jQuery("#posts_carousel_position, #posts_carousel_title, #posts_carousel_cat, #posts_carousel_count, #posts_carousel_orderby").fadeOut();
        } else {
            jQuery("#posts_carousel_position, #posts_carousel_title, #posts_carousel_cat, #posts_carousel_count, #posts_carousel_orderby").fadeIn();
        }
    });
    jQuery("#posts_carousel select").change();
	
	/* Blog List */
    jQuery("#three_posts_after_slider select").change(function(){
        var $this = jQuery(this);
        if( $this.val() == "" ){
			jQuery("#three_posts_after_slider_category, #three_posts_after_slider_orderby").fadeOut();
        } else {
            jQuery("#three_posts_after_slider_category, #three_posts_after_slider_orderby").fadeIn();
        }
    });
    jQuery("#three_posts_after_slider select").change();
	
    /* Post format */
    showHidePostFormatField();
    jQuery('#post-formats-select input').change(showHidePostFormatField);
    
    
    /* Gallery */
    var frame;
    var images = script_data.image_ids;
    var selection = loadImages(images);

    jQuery('#gallery_images_upload').on('click', function(e) {
            e.preventDefault();

            // Set options for 1st frame render
            var options = {
                    title: script_data.label_create,
                    state: 'gallery-edit',
                    frame: 'post',
                    selection: selection
            };

            // Check if frame or gallery already exist
            if( frame || selection ) {
                    options['title'] = script_data.label_edit;
            }

            frame = wp.media(options).open();

            // Tweak views
            frame.menu.get('view').unset('cancel');
            frame.menu.get('view').unset('separateCancel');
            frame.menu.get('view').get('gallery-edit').el.innerHTML = script_data.label_edit;
            frame.content.get('view').sidebar.unset('gallery'); // Hide Gallery Settings in sidebar

            // When we are editing a gallery
            overrideGalleryInsert();
            frame.on( 'toolbar:render:gallery-edit', function() {
            overrideGalleryInsert();
            });

            frame.on( 'content:render:browse', function( browser ) {
                if ( !browser ) return;
                // Hide Gallery Setting in sidebar
                browser.sidebar.on('ready', function(){
                    browser.sidebar.unset('gallery');
                });
                // Hide filter/search as they don't work 
                    browser.toolbar.on('ready', function(){ 
                            if(browser.toolbar.controller._state == 'gallery-library'){ 
                                    browser.toolbar.$el.hide(); 
                            } 
                    }); 
            });

            // All images removed
            frame.state().get('library').on( 'remove', function() {
                var models = frame.state().get('library');
                    if(models.length == 0){
                        selection = false;
                        jQuery.post(ajaxurl, { 
                            ids: '',
                            action: 'cstheme_save_images',
                            post_id: script_data.post_id,
                            nonce: script_data.nonce 
                        });
                    }
            });

            // Override insert button
            function overrideGalleryInsert() {
                    frame.toolbar.get('view').set({
                            insert: {
                                    style: 'primary',
                                    text: script_data.label_save,

                                    click: function() {                                            
                                            var models = frame.state().get('library'),
                                                ids = '';

                                            models.each( function( attachment ) {
                                                ids += attachment.id + ','
                                            });

                                            this.el.innerHTML = script_data.label_saving;
                                            
                                            jQuery.ajax({
                                                    type: 'POST',
                                                    url: ajaxurl,
                                                    data: { 
                                                        ids: ids, 
                                                        action: 'cstheme_save_images', 
                                                        post_id: script_data.post_id, 
                                                        nonce: script_data.nonce 
                                                    },
                                                    success: function(){
                                                        selection = loadImages(ids);
                                                        jQuery('#gallery_image_ids').val( ids );
                                                        frame.close();
                                                    },
                                                    dataType: 'html'
                                            }).done( function( data ) {
                                                    jQuery('.gallery-thumbs').html( data );
                                            }); 
                                    }
                            }
                    });
            }
        });
					
        // Load images
        function loadImages(images) {
                if( images ){
                    var shortcode = new wp.shortcode({
                        tag:    'gallery',
                        attrs:   { ids: images },
                        type:   'single'
                    });

                    var attachments = wp.media.gallery.attachments( shortcode );

                    var selection = new wp.media.model.Selection( attachments.models, {
                            props:    attachments.props.toJSON(),
                            multiple: true
                    });

                    selection.gallery = attachments.gallery;

                    // Fetch the query's attachments, and then break ties from the
                    // query to allow for sorting.
                    selection.more().done( function() {
                            // Break ties with the query.
                            selection.props.set({ query: false });
                            selection.unmirror();
                            selection.props.unset('orderby');
                    });

                    return selection;
                }
                return false;
        }
});

function browseimage(id){
    var elementId = id;
    window.original_send_to_editor = window.send_to_editor;
    window.custom_editor = true;    
    window.send_to_editor = function(html){
        if (elementId != undefined) {
            jQuery(html).find('img').each(function(){
                    var imgurl = jQuery(this).attr('src');
                    jQuery('input[name="'+elementId+'"]').val(imgurl);
                    return;
            });
        } else {
            window.original_send_to_editor(html);
        }
        elementId = undefined;
    };
    wp.media.editor.open();
}

window.original_send_to_editor = window.send_to_editor;
window.custom_editor = true;