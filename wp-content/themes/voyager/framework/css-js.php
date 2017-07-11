<?php

//	Admin Styles
function cstheme_admin_style() {
    wp_enqueue_style('cstheme_admin', get_template_directory_uri() . '/framework/assets/css/cstheme-admin.css');
}
add_action('admin_enqueue_scripts', 'cstheme_admin_style');

#Frontend
if (!function_exists('cstheme_css_js_register')) {
    function cstheme_css_js_register() {

        #CSS
        wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '3.3.4', 'all');
		wp_enqueue_style('fontawesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '4.6.3', 'all' );
		wp_enqueue_style('fluidbox', get_template_directory_uri() . '/css/fluidbox.css');
		wp_enqueue_style('voyager-owlcarousel', get_template_directory_uri() . '/css/owl.carousel.css');
		if (cstheme_woo_enabled()) {
			wp_enqueue_style('voyager-woo', get_template_directory_uri() . '/css/woo.css');
		}
		wp_enqueue_style('voyager-default', get_stylesheet_uri());
		wp_enqueue_style('voyager-theme', get_template_directory_uri() . '/css/theme-style.css');
		wp_add_inline_style( 'voyager-theme', voyager_generate_dynamic_css() );
		wp_enqueue_style('voyager-responsive', get_template_directory_uri() . '/css/responsive.css');

        #JS
		wp_enqueue_script("jquery");
		wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array(), '3.3.4', true);
		if ( cstheme_option('magnific_popup') != 'disabled') {
			wp_enqueue_script('voyager-magnificpopup', get_template_directory_uri() . '/js/jquery.magnific-popup.min.js', 'jquery', '', true);
			wp_enqueue_script('voyager-fluidbox', get_template_directory_uri() . '/js/jquery.fluidbox.min.js', 'jquery', '', true);
		}
		wp_enqueue_script('voyager-jscrollpane', get_template_directory_uri() . '/js/jquery.jscrollpane.min.js', 'jquery', '', true);
		wp_enqueue_script('voyager-owlcarousel', get_template_directory_uri() . '/js/owl.carousel.min.js', array(), false, true);
		if ( cstheme_option('function_fixed_sidebar_enable') != 0) {
			wp_enqueue_script('voyager-stickysidebar', get_template_directory_uri() . '/js/theia-sticky-sidebar.min.js', array(), false, true);
		}
		if (cstheme_woo_enabled()) {
			wp_enqueue_script('voyager-woo', get_template_directory_uri() . '/js/woo.js', 'jquery', '', true);
		}
		wp_enqueue_script('voyager-theme', get_template_directory_uri() . '/js/cstheme-script.js', 'jquery', '', true);
		
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
		
		// Google Fonts
		$protocol = is_ssl() ? 'https' : 'http';
		global $cs_simplefonts;
		$cs_googlefonts = array(
			cstheme_option('global_text_font', 'face'),
			cstheme_option('heading_font'),
			cstheme_option('blog_category_font'),
		);
		$googlefont = '';
		foreach ($cs_googlefonts as $font) {
			if (!in_array($font, $cs_simplefonts)) {
				$googlefont = str_replace(' ', '+', $font) . ':' . cstheme_option('google_font_weight') . '|' . $googlefont;
			}
		}
		if ($googlefont != '') {
			wp_enqueue_style('google-font', "$protocol://fonts.googleapis.com/css?family=" . substr_replace($googlefont, "", -1) . "&subset=" . cstheme_option('google_font_subset'));
		}
		
    }
}
add_action('wp_enqueue_scripts', 'cstheme_css_js_register');


/* Custom styles */
function voyager_dynamic_css() {
?>

	body{
		font-family:<?php echo cstheme_option('global_text_font', 'face'); ?>, Arial, Helvetica, sans-serif;
		font-weight:<?php echo cstheme_option('global_text_font', 'style'); ?>;
		line-height:<?php echo cstheme_option('global_text_font', 'height'); ?>;
		font-size:<?php echo cstheme_option('global_text_font', 'size'); ?>;
		font-weight:<?php echo cstheme_option('global_text_font', 'style'); ?>;
		color:<?php echo cstheme_option('global_text_font', 'color'); ?>;
		<?php
            if (cstheme_option('theme_layout') == 'boxed') {
                if (cstheme_option('background_color') != "") {
                    echo 'background-color:' . cstheme_option('background_color') . ';';
                }
                if (cstheme_option('background_image') != "") {
                    echo 'background-image:url(' . cstheme_option('background_image') . ');';
                }
                if (cstheme_option('background_repeat') != 'stretch') {
                    echo 'background-repeat:' . cstheme_option('background_repeat') . ';';
                } else {
                    echo '-webkit-background-size:cover;-moz-background-size:cover;-o-background-size:cover;background-size:cover;';
                }
                echo "background-attachment:fixed;";
                echo "padding-top:" . cstheme_option('margin_top') . "px;";
                echo "padding-bottom:" . cstheme_option('margin_bottom') . "px;";
            }
		?>
	}
	
	<?php
		if (cstheme_option('theme_layout') == 'boxed') {
			echo '
				#page-wrap{overflow:hidden;width:1230px;margin:0 auto;}
				body.header-fixed .header_wrap{width:1230px;left:50%;margin-left:-615px;}
			';
		}
	?>
	
	/* header */
	<?php
		if ( cstheme_option('header_color_bg') != "" ) {
			echo '
				.header_wrap .header_wrap_bg, #header_mobile_wrap .header_wrap_bg{
					background-color:' . cstheme_option('header_color_bg') . ';
				}
				#page-content{padding-top:60px;}
				.top_slider_blog.type3, .top_slider_blog.type4, .top_slider_blog.type5{margin-top:-60px;}
			';
		}
		if (cstheme_option('header_img_bg') != "") {
			echo '
				.header_wrap .header_wrap_bg, #header_mobile_wrap .header_wrap_bg{
					background-image:url(' . cstheme_option('header_img_bg') . ');';
					if (cstheme_option('header_img_repeat') != 'stretch') {
						echo 'background-repeat:' . cstheme_option('header_img_repeat') . ';';
					} else {
						echo '-webkit-background-size:cover;-moz-background-size:cover;-o-background-size:cover;background-size:cover;';
					}
					echo 'background-position:center center;';
			echo '
				}
				#page-content{margin-top:110px;}
				';
		}
	?>
	
	/* footer */
	<?php
		if ( cstheme_option('footer_bg') != "" ) {
			echo '
				footer{
					background-color:' . cstheme_option('footer_bg') . ';
				}
				.instagram_wrap.type2{margin-bottom:80px;}
			';
		}
	?>
	
	/* Typography */
	h1, h2, h3, h4, h5, h6{font-family:'<?php echo cstheme_option('heading_font') ?>', sans-serif;}
	h1{font-size:<?php echo cstheme_option('h1_spec_font', 'size'); ?>;color:<?php echo cstheme_option('h1_spec_font', 'color'); ?>;}
	h2{font-size:<?php echo cstheme_option('h2_spec_font', 'size'); ?>;color:<?php echo cstheme_option('h2_spec_font', 'color'); ?>;}
	h3{font-size:<?php echo cstheme_option('h3_spec_font', 'size'); ?>;color:<?php echo cstheme_option('h3_spec_font', 'color'); ?>;}
	h4{font-size:<?php echo cstheme_option('h4_spec_font', 'size'); ?>;color:<?php echo cstheme_option('h4_spec_font', 'color'); ?>;}
	h5{font-size:<?php echo cstheme_option('h5_spec_font', 'size'); ?>;color:<?php echo cstheme_option('h5_spec_font', 'color'); ?>;}
	h6{font-size:<?php echo cstheme_option('h6_spec_font', 'size'); ?>;color:<?php echo cstheme_option('h6_spec_font', 'color'); ?>;}
	blockquote{border:1px solid <?php echo cstheme_option('theme_color') ?>;}
	.heading_font{font-family:'<?php echo cstheme_option('heading_font') ?>', sans-serif;}
	textarea, input{font-family:<?php echo cstheme_option('global_text_font', 'face'); ?>, Arial, Helvetica, sans-serif;}
	.contentarea ul li:before, .single-post-content ul li:before{background-color:<?php echo cstheme_option('theme_color'); ?>;}
	.contentarea ol > li:before, .single-post-content ol > li:before{color:<?php echo cstheme_option('theme_color'); ?>;}
	input[type="text"]:focus, input[type="email"]:focus, input[type="url"]:focus, input[type="password"]:focus, input[type="search"]:focus, textarea:focus{border-color:<?php echo cstheme_option('theme_color'); ?>;}
	.single-post-content h1, .single-post-content h2, .single-post-content h3, .single-post-content h4, .single-post-content h5, .single-post-content h6{font-family:<?php echo cstheme_option('global_text_font', 'face'); ?>, Arial, Helvetica, sans-serif;font-weight:400;}
	.contentarea h1, .single-post-content h1, .contentarea h2, .single-post-content h2, .contentarea h3, .single-post-content h3, .contentarea h4, .single-post-content h4, .contentarea h5, .single-post-content h5, .contentarea h6, .single-post-content h6{font-family:<?php echo cstheme_option('global_text_font', 'face'); ?>, Arial, Helvetica, sans-serif;font-weight:400;}
	#respond-inputs input:focus, #commentform textarea:focus{border-color:<?php echo cstheme_option('theme_color'); ?>;}
	
	/* Menu */
	.menu-primary-menu-container-wrap .sub-menu, .menu-primary-menu-container-wrap .sub-menu .sub-menu{border-color:<?php echo cstheme_option('theme_color') ?>;}
	.menu-primary-menu-container-wrap .sub-menu:after{border-bottom-color:<?php echo cstheme_option('theme_color') ?>;border-left-color:<?php echo cstheme_option('theme_color') ?>;}
	.menu-primary-menu-container-wrap .sub-menu .sub-menu:after{border-top-color:<?php echo cstheme_option('theme_color') ?>;border-right-color:<?php echo cstheme_option('theme_color') ?>;}
	.menu-primary-menu-container-wrap li a:hover, .menu-primary-menu-container-wrap ul li.current_page_item > a, .menu-primary-menu-container-wrap ul li.current-menu-item > a, .menu-primary-menu-container-wrap li.current-menu-parent > a, .menu-primary-menu-container-wrap li.current-menu-ancestor > a, .menu-primary-menu-container-wrap .sub-menu li.current_page_item a{color:<?php echo cstheme_option('theme_color') ?>;}
	#header_mobile_wrap .menu-primary-menu-container-wrap li a:hover, #header_mobile_wrap .menu-primary-menu-container-wrap ul li.current_page_item > a, #header_mobile_wrap .menu-primary-menu-container-wrap ul li.current-menu-item > a, #header_mobile_wrap .menu-primary-menu-container-wrap li.current-menu-parent > a, #header_mobile_wrap .menu-primary-menu-container-wrap li.current-menu-ancestor > a, #header_mobile_wrap .menu-primary-menu-container-wrap .sub-menu li.current_page_item a{color:<?php echo cstheme_option('theme_color') ?>;}
	.menu-item-mega-parent .cstheme_mega_menu_wrap{border-color:<?php echo cstheme_option('theme_color') ?>;}
	.menu-item-mega-parent .cstheme_mega_menu_wrap:after{border-bottom-color:<?php echo cstheme_option('theme_color') ?>;border-left-color:<?php echo cstheme_option('theme_color') ?>;}
	
	/* Shortcodes */
	.btn{font-family:'<?php echo cstheme_option('heading_font') ?>', sans-serif;}
	.btn-default.active, .btn-default.focus, .btn-default:active, .btn-default:focus, .btn-default:hover, .btn-primary{background-color:<?php echo cstheme_option('theme_color') ?>;}
	.btn-primary.active, .btn-primary.focus, .btn-primary:active, .btn-primary:focus{background:<?php echo cstheme_option('theme_color') ?>;}
	
	/* Custom Colors */
	a:hover, a:focus{color:<?php echo cstheme_option('theme_color'); ?>;}
	.single-post-content p a, .contentarea p a, .comment-text a{color:<?php echo cstheme_option('theme_color'); ?>;}
	::selection{background:<?php echo cstheme_option('theme_color'); ?>;}
	::-moz-selection{background:<?php echo cstheme_option('theme_color'); ?>;}
	.theme_color{color:<?php echo cstheme_option('theme_color'); ?>;}
	.bg_primary{background-color:<?php echo cstheme_option('theme_color'); ?>;}
	button, input[type="button"], input[type="reset"], input[type="submit"], input[type="button"], input[type="reset"]{font-family:'<?php echo cstheme_option('heading_font'); ?>', sans-serif;}
	button:hover, input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover, input[type="submit"]:focus, input[type="button"]:hover, input[type="reset"]:hover{background-color:<?php echo cstheme_option('theme_color') ?>;}
	.header_search i.fa-search:hover{color:<?php echo cstheme_option('theme_color'); ?>;}
	.sidebar_btn:hover span{background-color:<?php echo cstheme_option('theme_color'); ?>;}
	.subscribe_popup_bg{background-image:url( <?php echo cstheme_option('subscribe_popup_bg'); ?> );}
	.owl-controls .owl-dot{font-family:'<?php echo cstheme_option('heading_font'); ?>', sans-serif;}
	.owl-controls .owl-dot:before{background-color:<?php echo cstheme_option('theme_color'); ?>;}
	.owl-controls .owl-nav > div:hover{border-color:<?php echo cstheme_option('theme_color'); ?>;color:<?php echo cstheme_option('theme_color'); ?>;}
	.top_slider_blog.type4 .owl-controls .owl-nav > div:hover i{border-color:<?php echo cstheme_option('theme_color'); ?>;}
	.cstheme_widget_last_tweets .owl-controls .owl-dot:hover, .cstheme_widget_last_tweets .owl-controls .owl-dot.active{background-color:<?php echo cstheme_option('theme_color'); ?>;}
	.recent_posts_list.carousel .owl-controls .owl-dot:hover, .recent_posts_list.carousel .owl-controls .owl-dot.active{background-color:<?php echo cstheme_option('theme_color'); ?>;}
	.top_slider_blog.type1 .top_slider_blog_descr h2:hover a{color:<?php echo cstheme_option('theme_color'); ?>;}
	.top_slider_blog.type1 .top_slider_blog_post_author .post-author-name:hover{color:<?php echo cstheme_option('theme_color'); ?>;}
	.top_slider_blog.type2 .top_slider_blog_title a:hover, .top_slider_blog.type2 .top_slider_blog_post_author a:hover{color:<?php echo cstheme_option('theme_color'); ?>;}
	.top_slider_blog.type3 .top_slider_blog_title a:hover, .top_slider_blog.type3 .top_slider_blog_post_author a:hover{color:<?php echo cstheme_option('theme_color'); ?>;}
	#blog_list.blog_list_style_grid-bg .row{margin-left:-<?php echo get_metabox('post_padding'); ?>px;margin-right:-<?php echo get_metabox('post_padding'); ?>px;margin-bottom:-<?php echo get_metabox('post_padding'); ?>px;}
	#blog_list.blog_list_style_grid-bg .post{padding:<?php echo get_metabox('post_padding'); ?>px;}
	#blog_list.blog_list_style_grid-bg #blog_sidebar{padding-top:<?php echo get_metabox('post_padding'); ?>px;}
	#blog_list.blog_list_style_grid-bg .post-title a:hover{color:<?php echo cstheme_option('theme_color'); ?>;}
	#blog_list.blog_list_style_grid-bg .format-link .post-title a:hover,
	#related_posts_list .format-link .post-title a:hover,
	#author_posts_page .format-link .post-title a:hover{
		color:<?php echo cstheme_option('h1_spec_font', 'color'); ?>;
	}
	#blog_list .post-content-link-wrapper,
	#related_posts_list .post-content-link-wrapper,
	#author_posts_page .post-content-link-wrapper{
		background-color:<?php echo cstheme_option('theme_color'); ?>;
	}
	.cstheme_widget_last_tweets .twitter-text a{color:<?php echo cstheme_option('theme_color'); ?>;}
	.recent_posts_list.carousel .recent_post_title a:hover{color:<?php echo cstheme_option('theme_color'); ?>;}
	.single_post_meta_tags a:hover, .tagcloud a:hover{border-color:<?php echo cstheme_option('theme_color'); ?>;color:<?php echo cstheme_option('theme_color'); ?>;}
	.single_post_meta_tags a:hover:before, .tagcloud a:hover:before{border-color:<?php echo cstheme_option('theme_color'); ?>;}
	.single_post_meta_tags a:hover i:before, .tagcloud a:hover i:before, .single_post_meta_tags a:hover i:after, .tagcloud a:hover i:after{background-color:<?php echo cstheme_option('theme_color'); ?>;}
	.post_format_content .post-link:before, .post_format_content .post-quote:before{background-color:<?php echo cstheme_option('theme_color'); ?>;}
	h6.comment_author .comment-edit-link{font-family:<?php echo cstheme_option('global_text_font', 'face'); ?>, Arial, Helvetica, sans-serif;}
	.comment-reply-link{font-family:'<?php echo cstheme_option('heading_font'); ?>', sans-serif;}
	#blog_list.blog_list_style_chess .format-quote .post-meta-author a:hover{color:<?php echo cstheme_option('theme_color'); ?>;}
	#blog_list.blog_list_style_chess .format-quote h2.post-title a:hover{color:<?php echo cstheme_option('theme_color'); ?>;}
	#blog_list.blog_list_style_chess .format-link .post-content-wrapper{background-color:<?php echo cstheme_option('theme_color'); ?>;}
	#blog_list.blog_list_style_masonry-bg .row{margin-left:-<?php echo get_metabox('post_padding'); ?>px;margin-right:-<?php echo get_metabox('post_padding'); ?>px;margin-bottom:-<?php echo get_metabox('post_padding'); ?>px;}
	#blog_list.blog_list_style_masonry-bg .post{padding:<?php echo get_metabox('post_padding'); ?>px;}
	#blog_list.blog_list_style_masonry-bg .post-title a:hover{color:<?php echo cstheme_option('theme_color') ?>;}
	#blog_list.blog_list_style_masonry-bg .format-link .post-title a:hover{color:<?php echo cstheme_option('h1_spec_font', 'color'); ?>;}
	#categories_list .item a:hover span{color:<?php echo cstheme_option('theme_color') ?>;}
	#blog_list.blog_list_style_default .format-quote .post-meta-author a:hover{color:<?php echo cstheme_option('theme_color') ?>;}
	#blog_list.blog_list_style_default .format-quote h2.post-title a:hover,
	#related_posts_list .format-quote h2.post-title a:hover,
	#author_posts_page .format-quote h2.post-title a:hover{
		color:<?php echo cstheme_option('theme_color') ?>;
	}
	#blog_list.blog_list_style_default .format-link .post-content-wrapper{background-color:<?php echo cstheme_option('theme_color') ?>;}
	.top_slider_blog.type4 .top_slider_blog_title a:hover{color:<?php echo cstheme_option('theme_color') ?>;}
	.top_slider_blog.type4 .post-author-name:hover{color:<?php echo cstheme_option('theme_color') ?>;}
	#blog_list.blog_list_style_masonry_top_image .format-quote .post-title a:hover{color:<?php echo cstheme_option('theme_color') ?>;}
	#blog_list.blog_list_style_masonry_top_image .format-link .featured_img_bg:before{background-color:<?php echo cstheme_option('theme_color') ?>;}
	.instagram_wrap.type3 .custom_inst_link:hover{background-color:<?php echo cstheme_option('theme_color') ?>;}
	.coming_soon_wrapper{background-color:<?php echo get_metabox('coming_color_bg') ?>;}
	.coming_soon_wrapper h3 span:before, .coming_soon_wrapper h3 span:after, .comingsoon_subscribe_form .mc4wp-form:before, .comingsoon_subscribe_form .mc4wp-form:after{background-color:<?php echo cstheme_option('theme_color') ?>;}
	.coming_soon_wrapper ul.countdown:before, .coming_soon_wrapper ul.countdown:after{background-color:<?php echo cstheme_option('theme_color') ?>;}
	.contentarea form.wpcf7-form label{font-family:'<?php echo cstheme_option('heading_font') ?>', sans-serif;}
	.contentarea form.wpcf7-form input:focus, .contentarea form.wpcf7-form textarea:focus{border-color:<?php echo cstheme_option('theme_color') ?>;}
	#related_posts_list.owl-carousel .post-title:hover a{color:<?php echo cstheme_option('theme_color') ?>;}
	#posts_carousel .owl-carousel .posts_carousel_title:hover a{color:<?php echo cstheme_option('theme_color') ?>;}
	#posts_carousel .with_title .owl-controls .owl-nav > div{border-color:<?php echo cstheme_option('theme_color') ?>;color:<?php echo cstheme_option('theme_color') ?>;}
	#blog_list.blog_list_style_default.search-result-list h2.post-title:hover a, #blog_list.blog_list_style_default.search-result-list .post_content_readmore:hover{color:<?php echo cstheme_option('theme_color') ?>;}
	.top_slider_blog.type5 .top_slider_blog_title a:hover{color:<?php echo cstheme_option('theme_color') ?>;}
	.top_slider_blog.type5 .top_slider_blog_post_author .post-author-name:hover{color:<?php echo cstheme_option('theme_color') ?>;}
	blockquote cite, blockquote small{font-family:'<?php echo cstheme_option('heading_font') ?>', sans-serif;}
	#related_posts_list .owl-carousel .post-title a:hover{color:<?php echo cstheme_option('theme_color') ?>;}
	#categories_list .item:hover .overlay_border:before, #categories_list .item:hover .overlay_border:after{border-color:<?php echo cstheme_option('theme_color') ?>;}
	#blog_list .post-content-quote-wrapper .overlay_border:before, #blog_list .post-content-quote-wrapper .overlay_border:after,
	#related_posts_list .post-content-quote-wrapper .overlay_border:before, #related_posts_list .post-content-quote-wrapper .overlay_border:after,
	#author_posts_page .post-content-quote-wrapper .overlay_border:before, #author_posts_page .post-content-quote-wrapper .overlay_border:after{
		border-color:<?php echo cstheme_option('theme_color') ?>;
	}
	#instafeed .instafeed_item .overlay_border:before, #instafeed .instafeed_item .overlay_border:after{border-color:<?php echo cstheme_option('theme_color') ?>;}
	.posts_carousel_overlay{background-color:<?php echo cstheme_option('posts_carousel_bg') ?>;}
	.related_posts_list_overlay, .portfolio_related_list_overlay{background-color:<?php echo cstheme_option('theme_color') ?>;}
	#blog_list.blog_list_style_chess h2.post-title{border-color:<?php echo cstheme_option('theme_color') ?> !important;}
	#blog_list.blog_list_style_left-image .format-link .post-title:hover a{color:<?php echo cstheme_option('theme_color') ?> !important;}
	#blog_list.blog_list_style_left-image h2.post-title{border-left-color:<?php echo cstheme_option('theme_color') ?> !important;}
	#blog_list.blog_list_style_left-image .format-quote h2.post-title, #blog_list.blog_list_style_left-image .format-link h2.post-title{border-left-color:<?php echo cstheme_option('theme_color') ?> !important;}
	#blog_list.blog_list_style_top_image .format-quote .post-title:hover a, #blog_list.blog_list_style_top_image .format-link .post-title:hover a{color:<?php echo cstheme_option('theme_color') ?> !important;}
	#blog_list.blog_list_style_top_image .post-title, #blog_list.blog_list_style_top_image .format-quote h2.post-title{border-top:5px solid <?php echo cstheme_option('theme_color') ?> !important;}
	#blog_list.blog_list_style_masonry_top_image .post-title{border-top:5px solid <?php echo cstheme_option('theme_color') ?> !important;}
	aside .widget-title span:before, aside .widget-title span:after{background-color:<?php echo cstheme_option('theme_color') ?>;}
	#blog_list.blog_list_style_chess .post_content_readmore i, #blog_list.blog_list_style_left-image .post_content_readmore i{color:<?php echo cstheme_option('theme_color') ?>;}
	.widget_meta li a:hover, .widget_archive li a:hover, .widget_categories li a:hover{color:<?php echo cstheme_option('theme_color') ?>;}
	#blog_list.blog_list_style_line_bg .post-content-wrapper h2.post-title a:hover{color:<?php echo cstheme_option('theme_color') ?>;}
	#blog_list.blog_list_style_line_bg .post-meta:before{background-color:<?php echo cstheme_option('theme_color') ?>;}
	
	.social_link, .menu-primary-menu-container-wrap ul > li > a, .header_search i.fa-search{color:<?php echo cstheme_option('header_text_color') ?>;}
	.sidebar_btn span{background-color:<?php echo cstheme_option('header_text_color') ?>;}
	
	#blog_list.blog_list_style_line_thumb .line_thumb_overlay,
	.blog_list_style_clean_card .post.format-quote .post_title:after{
		background-color:<?php echo cstheme_option('theme_color') ?>;
	}
	
	#blog_list.blog_list_style_fullwidth_img h2.post-title a:hover{color:<?php echo cstheme_option('theme_color') ?>;}
	#blog_list.blog_list_style_metro .post-descr-wrap .post-title a:hover,
	#blog_list.blog_list_style_metro .format-quote h2.post-title a:hover,
	.blog_list_style_clean_card .clean_card_img_bg.post.format-standard .post_title a:hover,
	.blog_list_style_clean_card .clean_card_img_bg.post.format-image .post_title a:hover,
	.blog_list_style_clean_card .post.format-standard .post_meta_author:hover b,
	.blog_list_style_clean_card .post.format-image .post_meta_author:hover b,
	.blog_list_style_clean_card .post.format-gallery .post_meta_author:hover b,
	.blog_list_style_clean_card .post.format-video .post_meta_author:hover b{
		color:<?php echo cstheme_option('theme_color') ?>;
	}
	
	.top_slider_blog.type6 .top_slider_blog_title a:hover{
		color:<?php echo cstheme_option('theme_color') ?>;
	}
	
	#three_posts_after_slider .col-md-6 .post-title a:hover{
		color:<?php echo cstheme_option('theme_color') ?>;
	}
	#blog_list.style_magazine .col-md-12 .post_title a:hover,
	#posts_carousel .owl-carousel .bg_image h2.post-title a:hover{
		color:<?php echo cstheme_option('theme_color') ?>;
	}
	
	body.header_type9 .menu-primary-menu-container-wrap li a:hover,
	body.header_type9 .menu-primary-menu-container-wrap ul li.current_page_item > a,
	body.header_type9 .menu-primary-menu-container-wrap ul li.current-menu-item > a,
	body.header_type9 .menu-primary-menu-container-wrap li.current-menu-parent > a,
	body.header_type9 .menu-primary-menu-container-wrap li.current-menu-ancestor > a,
	body.header_type9 .menu-primary-menu-container-wrap .sub-menu li.current_page_item a,
	body.header_type9 .sidebar_btn:hover i,
	body.header_type9 .search_form_wrap:hover > i{
		color:<?php echo cstheme_option('theme_color') ?> !important;
	}
	body.header_type9 .sidebar_btn:hover{
		border-color:<?php echo cstheme_option('theme_color') ?>;
	}
	
	.recent_posts_list.carousel .recent_post_meta_category,
	.recent_posts_list.carousel .recent_post_meta_category a,
	.top_slider_blog.type1 .top_slider_blog_meta_category,
	.top_slider_blog.type1 .top_slider_blog_meta_category a,
	.top_slider_blog.type2 .top_slider_blog_meta_category,
	.top_slider_blog.type2 .top_slider_blog_meta_category a,
	body.boxed .top_slider_blog.type3 .top_slider_blog_descr,
	.top_slider_blog.type3 .top_slider_blog_meta_category,
	.top_slider_blog.type3 .top_slider_blog_meta_category a,
	.top_slider_blog.type4 .top_slider_blog_meta_category,
	.top_slider_blog.type4 .top_slider_blog_meta_category a,
	.top_slider_blog.type5 .top_slider_blog_meta_category,
	.top_slider_blog.type5 .top_slider_blog_meta_category a,
	.top_slider_blog.type6 .top_slider_blog_meta_category,
	.top_slider_blog.type6 .top_slider_blog_meta_category a,
	#posts_carousel .owl-carousel .bg_image .post_meta_category a,
	#blog_list.blog_list_style_grid-bg .post_meta_category,
	#related_posts_list .post_meta_category,
	#author_posts_page .post_meta_category,
	#blog_list.blog_list_style_grid-bg .post_meta_category a,
	#related_posts_list .post_meta_category a,
	#author_posts_page .post_meta_category a,
	#blog_list.blog_list_style_chess .post_meta_category a,
	#blog_list.blog_list_style_masonry-bg .post_meta_category,
	#blog_list.blog_list_style_masonry-bg .post_meta_category a,
	#blog_list.blog_list_style_left-image .post_meta_category a,
	#blog_list.blog_list_style_top_image .post_meta_category a,
	#blog_list.blog_list_style_masonry_top_image .post_meta_category a,
	#blog_list.blog_list_style_line_bg .post_meta_category,
	#blog_list.blog_list_style_line_thumb .post_meta_category,
	#blog_list.blog_list_style_line_thumb .post_meta_category a,
	#blog_list.blog_list_style_default .post_meta_category,
	#blog_list.blog_list_style_default .post_meta_category a,
	#blog_list.blog_list_style_fullwidth_img .post_meta_category a,
	#three_posts_after_slider .col-md-6 .post_meta_category a,
	#three_posts_after_slider .col-md-3 .post_meta_category a,
	#blog_list.style_magazine .col-md-12.post_big .post_meta_category a,
	.single_post_header .single_post_meta_category,
	.single_post_header .single_post_meta_category a,
	.blog_list_style_clean_card article.post span.post_meta_category a,
	.post_category_fontfamily{
		font-family:'<?php echo cstheme_option('blog_category_font') ?>', sans-serif;
	}
	
	/* Portfolio */
	#portfolio_related_list .portfolio_descr_wrap .portfolio-title:before, #portfolio_list .portfolio_descr_wrap .portfolio-title:before{background-color:<?php echo cstheme_option('theme_color'); ?>;}
	.filter_block li a:hover{color:<?php echo cstheme_option('theme_color'); ?>;}
	#blog_list.blog_list_style_line_thumb .format-quote h2.post-title a:hover{color:<?php echo cstheme_option('theme_color'); ?>;}
	
	
	<?php if (cstheme_woo_enabled()) { ?>
		
		/* WooCommerce */
		.shop_table .product-name a,
		.cs_mini_cart_links a,
		#cs-mini-cart ul.cart_list li a,
		#cs-mini-cart .widget_shopping_cart_content a.button,
		.woocommerce ul.cart_list li a,
		.woocommerce ul.product_list_widget li a,
		.woocommerce-page ul.cart_list li a,
		.woocommerce-page ul.product_list_widget li a,
		.woocommerce #respond input#submit,
		.woocommerce a.button,
		.woocommerce button.button,
		.woocommerce input.button,
		.woocommerce div.product .woocommerce-tabs ul.tabs li a,
		.woocommerce-page div.product .woocommerce-tabs ul.tabs li a,
		.contentarea h1,
		.single-post-content h1,
		.contentarea h2,
		.single-post-content h2,
		.contentarea h3,
		.single-post-content h3,
		.contentarea h4,
		.single-post-content h4,
		.contentarea h5,
		.single-post-content h5,
		.contentarea h6,
		.single-post-content h6{
			font-family:'<?php echo cstheme_option('heading_font') ?>', sans-serif;
		}
		.widget_product_categories ul li a:hover{color:<?php echo cstheme_option('theme_color') ?>;}
		#cs-mini-cart a.button:hover,
		.woocommerce #respond input#submit.alt:hover,
		.woocommerce a.button.alt:hover,
		.woocommerce button.button.alt:hover,
		.woocommerce input.button.alt:hover,
		.woocommerce #respond input#submit:hover,
		.woocommerce a.button:hover,
		.woocommerce button.button:hover,
		.woocommerce input.button:hover{
			color:#333;
			background-color:<?php echo cstheme_option('theme_color') ?>;
		}
		.woocommerce div.product ul > li:before{background-color:<?php echo cstheme_option('theme_color') ?>;}
		.woocommerce div.product ol > li:before{color:<?php echo cstheme_option('theme_color'); ?>;}
		.woocommerce .widget_price_filter .price_slider_amount .button:hover{background-color:<?php echo cstheme_option('theme_color'); ?>;}
		.woocommerce .widget_price_filter .ui-slider .ui-slider-range, .woocommerce-page .widget_price_filter .ui-slider .ui-slider-range{background-color:<?php echo cstheme_option('theme_color'); ?>;}
		.woocommerce .widget_shopping_cart_content a.button:hover{background-color:<?php echo cstheme_option('theme_color'); ?>;}
		.woocommerce ul.products li.product .onsale, .woocommerce-page ul.products li.product .onsale{background-color:<?php echo cstheme_option('theme_color'); ?>;}
		.woocommerce ul.products li.product .price ins span{color:<?php echo cstheme_option('theme_color'); ?>;}
		.woocommerce ul.products li.product .shop_list_product_image:before, .woocommerce-page ul.products li.product .shop_list_product_image:before{background-color:<?php echo cstheme_option('theme_color'); ?>;}
		.cstheme_cart_icon{background-color:<?php echo cstheme_option('theme_color'); ?>;}
		.cstheme_cart_icon:before{border-right-color:<?php echo cstheme_option('theme_color'); ?>;}
		
	<?php } ?>
	
	/* Custom CSS from Theme Options */
	<?php echo cstheme_option('html_custom_css'); ?>
	
<?php }

/**
 * Generate dynamic css
 */

if ( !function_exists( 'voyager_generate_dynamic_css' ) ):
	function voyager_generate_dynamic_css() {
		ob_start();
			voyager_dynamic_css();
		$output = ob_get_contents();
		ob_end_clean();
		return voyager_compress_css_code( $output );
	}
endif;


/**
 * Compress CSS Code
 */

if ( !function_exists( 'voyager_compress_css_code' ) ) :
	function voyager_compress_css_code( $code ) {

		// Remove Comments
		$code = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $code );

		// Remove tabs, spaces, newlines, etc.
		$code = str_replace( array( "\r\n", "\r", "\n", "\t", '  ', '    ', '    ' ), '', $code );

		return $code;
	}
endif;
?>