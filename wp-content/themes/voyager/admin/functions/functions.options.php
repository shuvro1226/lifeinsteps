<?php

add_action('init','of_options');

if (!function_exists('of_options'))
{
	function of_options()
	{
		//Access the WordPress Categories via an Array
		$of_categories 		= array();  
		$of_categories_obj 	= get_categories('hide_empty=0');
		foreach ($of_categories_obj as $of_cat) {
		    $of_categories[$of_cat->cat_ID] = $of_cat->cat_name;}
		$categories_tmp 	= array_unshift($of_categories, "Select a category:");
	       
		//Access the WordPress Pages via an Array
		$of_pages 			= array();
		$of_pages_obj 		= get_pages('sort_column=post_parent,menu_order');
		foreach ($of_pages_obj as $of_page) {
		    $of_pages[$of_page->ID] = $of_page->post_name; }
		$of_pages_tmp 		= array_unshift($of_pages, "Select a page:");       
	
		//Testing 
		$of_options_select 	= array("one","two","three","four","five"); 
		$of_options_radio 	= array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five");
		
		//Sample Homepage blocks for the layout manager (sorter)
		$of_options_homepage_blocks = array
		( 
			"disabled" => array (
				"placebo" 		=> "placebo", //REQUIRED!
				"block_one"		=> "Block One",
				"block_two"		=> "Block Two",
				"block_three"	=> "Block Three",
			), 
			"enabled" => array (
				"placebo" 		=> "placebo", //REQUIRED!
				"block_four"	=> "Block Four",
			),
		);


		//Stylesheets Reader
		$alt_stylesheet_path = LAYOUT_PATH;
		$alt_stylesheets = array();
		
		if ( is_dir($alt_stylesheet_path) ) 
		{
		    if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) 
		    { 
		        while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) 
		        {
		            if(stristr($alt_stylesheet_file, ".css") !== false)
		            {
		                $alt_stylesheets[] = $alt_stylesheet_file;
		            }
		        }    
		    }
		}
		

		/*-----------------------------------------------------------------------------------*/
		/* TO DO: Add options/functions that use these */
		/*-----------------------------------------------------------------------------------*/
		
		//More Options
		$uploads_arr 		= wp_upload_dir();
		$all_uploads_path 	= $uploads_arr['path'];
		$all_uploads 		= get_option('of_uploads');
		$other_entries 		= array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");
		$body_repeat 		= array("no-repeat","repeat-x","repeat-y","repeat");
		$body_pos 			= array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right");


		// Image Alignment radio box
		$of_options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center"); 
		
		// Image Links to Options
		$of_options_image_link_to = array("image" => "The Image","post" => "The Post"); 
		
		//default value for images
		$url =  ADMIN_DIR . 'assets/images/';
		$logo_images_uri = get_stylesheet_directory_uri() . '/images/logo.png';
		$favicon_images_uri = get_stylesheet_directory_uri() .'/images/favicon.ico';
		$subscribe_popup_bg_uri = get_stylesheet_directory_uri() . '/images/subscribe_popup_bg.jpg';


/*-----------------------------------------------------------------------------------*/
/* The Options Array */
/*-----------------------------------------------------------------------------------*/

// Set the Options Array
global $of_options,$cs_googlefonts;
$of_options = array();

//	Import Demo Content
$of_options[] = array(  'name' 		=> esc_html__( 'Demo Data Import', 'voyager' ),
						'class' 	=> 'demo_import',
						'type' 		=> 'heading'
				);
$of_options[] = array( 	'name' 		=> esc_html__('Import Demo Content', 'voyager'),
						'desc' 		=> '',
						'id' 		=> 'import_info',
						'std' 		=> esc_html__('Help you to import demo content. WARNING: This option overwrite your current theme options! If you get white screen, please refresh page(F5).', 'voyager'),
						'type' 		=> 'info-desc'
				);
$of_options[] = array( 	'name' 		=> '',
						'desc' 		=> '',
						'id' 		=> 'demo_travel',
						'std' 		=> admin_url('themes.php?page=optionsframework&import_data_content=true&demo=travel'),
						'btntext' 	=> esc_html__('Import Travel Demo', 'voyager'),
						'type' 		=> 'button'
				);
$of_options[] = array( 	'name' 		=> '',
						'desc' 		=> '',
						'id' 		=> 'demo_fashion',
						'std' 		=> admin_url('themes.php?page=optionsframework&import_data_content=true&demo=fashion'),
						'btntext' 	=> esc_html__('Import Fashion Demo', 'voyager'),
						'type' 		=> 'button'
				);
$of_options[] = array( 	'name' 		=> '',
						'desc' 		=> '',
						'id' 		=> 'demo_wedding',
						'std' 		=> admin_url('themes.php?page=optionsframework&import_data_content=true&demo=wedding'),
						'btntext' 	=> esc_html__('Import Wedding Demo', 'voyager'),
						'type' 		=> 'button'
				);
$of_options[] = array( 	'name' 		=> '',
						'desc' 		=> '',
						'id' 		=> 'demo_building',
						'std' 		=> admin_url('themes.php?page=optionsframework&import_data_content=true&demo=building'),
						'btntext' 	=> esc_html__('Import Building Demo', 'voyager'),
						'type' 		=> 'button'
				);
$of_options[] = array( 	'name' 		=> '',
						'desc' 		=> '',
						'id' 		=> 'demo_food',
						'std' 		=> admin_url('themes.php?page=optionsframework&import_data_content=true&demo=food'),
						'btntext' 	=> esc_html__('Import Food Demo', 'voyager'),
						'type' 		=> 'button'
				);
$of_options[] = array( 	'name' 		=> '',
						'desc' 		=> '',
						'id' 		=> 'demo_photography',
						'std' 		=> admin_url('themes.php?page=optionsframework&import_data_content=true&demo=photography'),
						'btntext' 	=> esc_html__('Import Photography Demo', 'voyager'),
						'type' 		=> 'button'
				);
$of_options[] = array( 	'name' 		=> '',
						'desc' 		=> '',
						'id' 		=> 'demo_magazine',
						'std' 		=> admin_url('themes.php?page=optionsframework&import_data_content=true&demo=magazine'),
						'btntext' 	=> esc_html__('Import Magazine Demo', 'voyager'),
						'type' 		=> 'button'
				);
$of_options[] = array( 	'name' 		=> '',
						'desc' 		=> '',
						'id' 		=> 'demo_voyager_2017',
						'std' 		=> admin_url('themes.php?page=optionsframework&import_data_content=true&demo=voyager_2017'),
						'btntext' 	=> esc_html__('Import Voyager 2017 Demo', 'voyager'),
						'type' 		=> 'button'
				);


// General //
$of_options[] = array( 	"name" 		=> esc_html__( 'General', 'voyager' ),
						"type" 		=> "heading"
				);

$of_options[] = array( 	"name" 		=> "Theme Layout",
						"desc" 		=> "",
						"id" 		=> "layout_theme_info",
						"std" 		=> "<h3 style=\"margin: 3px;\">Theme Layout</h3>",
						"icon" 		=> true,
						"type" 		=> "info"
				);
$of_options[] = array( 	"name" 		=> "Theme Layout Style",
						"desc" 		=> "Choose the Theme layout style.",
						"id" 		=> "theme_layout",
						"std" 		=> "fullwidth",
						"type" 		=> "select",
						"options" 	=> array("fullwidth" => "Full width","boxed" => "Boxed Layout")
				);
$of_options[] = array( 	"name" 		=> "Layout Options if boxed",
						"desc" 		=> "",
						"id" 		=> "layout_opt_boxed_info",
						"std" 		=> "<h3 style=\"margin: 3px;\">If boxed Theme Layout Style chosen.</h3>",
						"icon" 		=> true,
						"type" 		=> "info"
				);
$of_options[] = array( 	"name" 		=> "Background Color",
						"desc" 		=> "Choose the background color.",
						"id" 		=> "background_color",
						"std" 		=> "#d1d1d1",
						"type" 		=> "color"
				);
$of_options[] = array( 	"name" 		=> "Background Image",
						"desc" 		=> "This option will only works under boxed layout chosen.",
						"id" 		=> "background_image",
						"std" 		=> "",
						"mod" 		=> "min",
						"type" 		=> "upload"
				);
$of_options[] = array( 	"name" 		=> "Background Image Repeat",
						"desc" 		=> "Choose the repeat or stretch image option.",
						"id" 		=> "background_repeat",
						"std" 		=> "repeat",
						"type" 		=> "select",
						"options" 	=> array(
											'stretch' => esc_html__('Stretch Image','voyager'),
											'repeat' => esc_html__('repeat','voyager'),
											'no-repeat' => esc_html__('no-repeat','voyager'),
											'repeat-y' => esc_html__('repeat-y','voyager'),
											'repeat-x' => esc_html__('repeat-x','voyager'),
									),
				);
$of_options[] = array( 	"name" 		=> "Margin from Top",
						"desc" 		=> "Boxed Layout margin top.",
						"id" 		=> "margin_top",
						"std" 		=> "0",
						"type" 		=> "text"
				);
$of_options[] = array( 	"name" 		=> "Margin from Bottom",
						"desc" 		=> "Boxed Layout margin bottom.",
						"id" 		=> "margin_bottom",
						"std" 		=> "0",
						"type" 		=> "text"
				);
				
$of_options[] = array( 	"name" 		=> esc_html__( 'Subscribe Popup Heading', 'voyager' ),
						"desc" 		=> "",
						"id" 		=> "subscribe_popup_info",
						"std" 		=> "<h3 style=\"margin: 3px;\">". esc_html__( 'Subscribe Popup Options', 'voyager' ) ."</h3>",
						"icon" 		=> true,
						"type" 		=> "info"
				);
$of_options[] = array( 	"name" 		=> esc_html__( 'Subscribe Popup', 'voyager' ),
						"desc" 		=> "",
						"id" 		=> "subscribe_popup_enable",
						"std" 		=> 1,
						"folds" 	=> 1,
						"type" 		=> "switch"
				);
$of_options[] = array( 	"name" 		=> esc_html__( 'Background image', 'voyager' ),
						"desc" 		=> esc_html__( 'Upload a image for the popup background', 'voyager' ),
						"id" 		=> "subscribe_popup_bg",
						"std" 		=> $subscribe_popup_bg_uri,
						"fold" 		=> "subscribe_popup_enable",
						"type" 		=> "media"
				);
$of_options[] = array( 	"name" 		=> esc_html__( 'Heading', 'voyager' ),
						"desc" 		=> esc_html__( 'enter a heading for the subscribe popup', 'voyager' ),
						"id" 		=> "subscribe_popup_heading",
						"std" 		=> "Subscribe to newsletter",
						"fold" 		=> "subscribe_popup_enable",
						"type" 		=> "text"
				);
$of_options[] = array( 	"name" 		=> esc_html__( 'Description', 'voyager' ),
						"desc" 		=> esc_html__( 'enter a description for the subscribe popup', 'voyager' ),
						"id" 		=> "subscribe_popup_descr",
						"std" 		=> "Subscribe to the newsletter and you will know about latest events and activities. Podpisyvayse and you will not regret.",
						"fold" 		=> "subscribe_popup_enable",
						"type" 		=> "textarea"
				);
$of_options[] = array( 	"name" 		=> esc_html__( 'MailChimp Form ID', 'voyager' ),
						"desc" 		=> esc_html__( 'enter a Form ID fron MailChimp Plugin', 'voyager' ),
						"id" 		=> "subscribe_popup_mailChimpid",
						"std" 		=> "3313",
						"fold" 		=> "subscribe_popup_enable",
						"type" 		=> "text"
				);
				
$of_options[] = array( 	"name" 		=> esc_html__( 'Fixed Right Panel Heading', 'voyager' ),
						"desc" 		=> "",
						"id" 		=> "subscribe_popup_info",
						"std" 		=> "<h3 style=\"margin: 3px;\">". esc_html__( 'Fixed Right Panel With Widgets', 'voyager' ) ."</h3>",
						"icon" 		=> true,
						"type" 		=> "info"
				);
$of_options[] = array( 	"name" 		=> esc_html__( 'Right Fixed Panel', 'voyager' ),
						"desc" 		=> esc_html__( 'Right Fixed Panel for all pages.', 'voyager' ),
						"id" 		=> "fixed_sidebar_enable",
						"std" 		=> 0,
						"type" 		=> "switch"
				);
				
$of_options[] = array( 	"name" 		=> esc_html__( 'Fuction for Fixed Sidebar Heading', 'voyager' ),
						"desc" 		=> "",
						"id" 		=> "subscribe_popup_info",
						"std" 		=> "<h3 style=\"margin: 3px;\">". esc_html__( 'Fixed Sidebar With Widgets (function)', 'voyager' ) ."</h3>",
						"icon" 		=> true,
						"type" 		=> "info"
				);
$of_options[] = array( 	"name" 		=> esc_html__( 'Function for Fixed Sidebar Enable', 'voyager' ),
						"desc" 		=> esc_html__( 'Enable this function for Fixed Sidebar for pages, post, shop.', 'voyager' ),
						"id" 		=> "function_fixed_sidebar_enable",
						"std" 		=> 1,
						"type" 		=> "switch"
				);

$of_options[] = array( 	"name" 		=> esc_html__( 'Page 404', 'voyager' ),
						"desc" 		=> "",
						"id" 		=> "page_404_info",
						"std" 		=> "<h3 style=\"margin: 3px;\">". esc_html__( 'Page 404', 'voyager' ) ."</h3>",
						"icon" 		=> true,
						"type" 		=> "info"
				);
$of_options[] = array( 	"name" 		=> "Background Image",
						"desc" 		=> "",
						"id" 		=> "page_404_bg",
						"std" 		=> "",
						"mod" 		=> "min",
						"type" 		=> "upload"
				);
				
$of_options[] = array( 	"name" 		=> esc_html__( 'Magnific Popup for Images', 'voyager' ),
						"desc" 		=> "",
						"id" 		=> "magnific_popup_info",
						"std" 		=> "<h3 style=\"margin: 3px;\">". esc_html__( 'Magnific Popup for Images', 'voyager' ) ."</h3>",
						"icon" 		=> true,
						"type" 		=> "info"
				);
$of_options[] = array( 	"name" 		=> esc_html__('Enable Magnific Popup','voyager'),
						"desc" 		=> esc_html__('Enable magnific popup function for images','voyager'),
						"id" 		=> "magnific_popup",
						"std" 		=> "enabled",
						"type" 		=> "select",
						"options" 	=> array(
											'enabled' => esc_html__('Enabled','voyager'),
											'disabled' => esc_html__('Disabled','voyager'),
									),
				);


// Header and Footer //
$of_options[] = array( 	"name" 		=> esc_html__( 'Header and Footer', 'voyager' ),
						"type" 		=> "heading"
				);
				
$of_options[] = array( 	"name" 		=> esc_html__( 'Header Type option heading', 'voyager' ),
						"desc" 		=> "",
						"id" 		=> "logo_opt_info",
						"std" 		=> "<h3 style=\"margin: 3px;\">". esc_html__( 'Header Type', 'voyager' ) ."</h3>",
						"icon" 		=> true,
						"type" 		=> "info"
				);
$of_options[] = array( "name" 		=> esc_html__("Select a Header Layout", "voyager"),
						"desc" 		=> "",
						"id" 		=> "header_layout",
						"std" 		=> "type1",
						"type" 		=> "images",
						"options" => array(
										"type1" => get_template_directory_uri() . "/admin/assets/images/header1.jpg",
										"type2" => get_template_directory_uri() . "/admin/assets/images/header2.jpg",
										"type3" => get_template_directory_uri() . "/admin/assets/images/header3.jpg",
										"type4" => get_template_directory_uri() . "/admin/assets/images/header4.jpg",
										"type5" => get_template_directory_uri() . "/admin/assets/images/header5.jpg",
										"type6" => get_template_directory_uri() . "/admin/assets/images/header6.jpg",
										"type7" => get_template_directory_uri() . "/admin/assets/images/header7.jpg",
										"type8" => get_template_directory_uri() . "/admin/assets/images/header8.jpg",
										"type9" => get_template_directory_uri() . "/admin/assets/images/header9.jpg",
									)
				);
$of_options[] = array( 	"name" 		=> "Background Color",
						"desc" 		=> "Choose color for header background.",
						"id" 		=> "header_color_bg",
						"std" 		=> "",
						"type" 		=> "color"
				);
$of_options[] = array( 	"name" 		=> "Background Image",
						"desc" 		=> "Choose image or patern for header background.",
						"id" 		=> "header_img_bg",
						"std" 		=> "",
						"mod" 		=> "min",
						"type" 		=> "upload"
				);
$of_options[] = array( 	"name" 		=> "Background Image Repeat",
						"desc" 		=> "Choose the repeat or stretch image option.",
						"id" 		=> "header_img_repeat",
						"std" 		=> "stretch",
						"type" 		=> "select",
						"options" 	=> array("stretch" => "Stretch Image","repeat" => "repeat","no-repeat" => "no-repeat","repeat-y" => "repeat-y","repeat-x" => "repeat-x")
				);
$of_options[] = array( 	"name" 		=> "Text and Iocns Color",
						"desc" 		=> "Choose color for text and icons from the header.",
						"id" 		=> "header_text_color",
						"std" 		=> "#333",
						"type" 		=> "color"
				);
				
$of_options[] = array( 	"name" 		=> esc_html__( 'Header section', 'voyager' ),
						"desc" 		=> "",
						"id" 		=> "footer_section_info",
						"std" 		=> "<h3 style=\"margin: 3px;\">". esc_html__( 'Header Icons', 'voyager' ) ."</h3>",
						"icon" 		=> true,
						"type" 		=> "info"
				);
$of_options[] = array( 	"name" 		=> esc_html__( 'Social Icons', 'voyager'),
						"desc" 		=> "",
						"id" 		=> "social_icons_enabled",
						"std" 		=> 1,
						"type" 		=> "switch"
				);
$of_options[] = array( 	"name" 		=> esc_html__( 'Search Icon', 'voyager'),
						"desc" 		=> "",
						"id" 		=> "search_icon_enabled",
						"std" 		=> 1,
						"type" 		=> "switch"
				);
				
$of_options[] = array( 	"name" 		=> esc_html__( 'Header ADS', 'voyager' ),
						"desc" 		=> "",
						"id" 		=> "header_ads",
						"std" 		=> "<h3 style=\"margin: 3px;\">". esc_html__( 'Header ADS', 'voyager' ) ."</h3>",
						"icon" 		=> true,
						"type" 		=> "info"
				);
$of_options[] = array( 	"name" 		=> esc_html__( 'Header ADS Link', 'voyager' ),
						"desc" 		=> esc_html__( 'You need to insert banner ulr. Only for Header Type 8', 'voyager' ),
						"id" 		=> "header_ads_url",
						"std" 		=> "",
						"type" 		=> "text"
				);			
$of_options[] = array( 	"name" 		=> esc_html__( 'Upload Banner', 'voyager' ),
						"desc" 		=> esc_html__( 'Please upload your header banner. Only for Header Type 8. Recommended size 900x125', 'voyager' ),
						"id" 		=> "header_ads_img",
						"std" 		=> '',
						"mod" 		=> "min",
						"type" 		=> "upload"
				);

$of_options[] = array( 	"name" 		=> esc_html__( 'Logo option heading', 'voyager' ),
						"desc" 		=> "",
						"id" 		=> "logo_opt_info",
						"std" 		=> "<h3 style=\"margin: 3px;\">". esc_html__( 'Logo options', 'voyager' ) ."</h3>",
						"icon" 		=> true,
						"type" 		=> "info"
				);
$of_options[] = array( 	"name" 		=> esc_html__( 'Upload Standard Logo', 'voyager' ),
						"desc" 		=> esc_html__( 'Please insert your logo.', 'voyager' ),
						"id" 		=> "theme_logo",
						"std" 		=> $logo_images_uri,
						"mod" 		=> "min",
						"type" 		=> "upload"
				);
$of_options[] = array( 	"name" 		=> esc_html__( 'Retina Logo', 'voyager' ),
						"desc" 		=> "",
						"id" 		=> "logo_retina",
						"std" 		=> 0,
						"folds" 	=> 1,
						"type" 		=> "switch"
				);
$of_options[] = array( 	"name" 		=> esc_html__( 'Upload Retina Logo (2x)', 'voyager' ),
						"desc" 		=> esc_html__( 'Note: You retina logo must be larger than 2x. Example: Main logo 120x200 then Retina must be 240x400.', 'voyager' ),
						"id" 		=> "theme_logo_retina",
						"std" 		=> "",
						"mod" 		=> "min",
						"fold" 		=> "logo_retina",
						"type" 		=> "upload"
				);
$of_options[] = array( 	"name" 		=> esc_html__( 'Standard Logo Width', 'voyager' ),
						"desc" 		=> esc_html__( 'You need to insert Non retina logo width. Height auto', 'voyager' ),
						"id" 		=> "logo_width",
						"std" 		=> "",
						"fold" 		=> "logo_retina",
						"type" 		=> "text"
				);				

$of_options[] = array( 	"name" 		=> esc_html__( 'Favicon option heading', 'voyager' ),
						"desc" 		=> "",
						"id" 		=> "favicon_opt_info",
						"std" 		=> "<h3 style=\"margin: 3px;\">". esc_html__( 'Favicon options', 'voyager' ) ."</h3>",
						"icon" 		=> true,
						"type" 		=> "info"
				);
$of_options[] = array( 	"name" 		=> esc_html__( 'Upload Standard Favicon', 'voyager' ),
						"desc" 		=> esc_html__( 'Please insert your favicon 16x16px or 32x32px icon. You may use <a href="http://www.favicon.cc/" target="_blank">favicon.cc</a>. Please note that if you\'ve already uploaded the Site Icon in the Theme Customizer (Appearance -> Customize), the settings from the theme options panel will be ignored.', 'voyager' ),
						"id" 		=> "theme_favicon",
						"std" 		=> $favicon_images_uri,
						"mod" 		=> "min",
						"type" 		=> "upload"
				);
$of_options[] = array( 	"name" 		=> esc_html__( 'Retina Favicon', 'voyager' ),
						"desc" 		=> "",
						"id" 		=> "favicon_retina",
						"std" 		=> 0,
						"folds" 	=> 1,
						"type" 		=> "switch"
				);
$of_options[] = array( 	"name" 		=> esc_html__( 'Favicon for iPhone (57x57)', 'voyager' ),
						"desc" 		=> esc_html__( 'Please upload your favicon 57x57px. Please note that if you\'ve already uploaded the Site Icon in the Theme Customizer (Appearance -> Customize), the settings from the theme options panel will be ignored.', 'voyager' ),
						"id" 		=> "favicon_iphone",
						"std" 		=> '',
						"mod" 		=> "min",
						"fold" 		=> "favicon_retina",
						"type" 		=> "upload"
				);
$of_options[] = array( 	"name" 		=> esc_html__( 'Favicon for iPad (72x72)', 'voyager' ),
						"desc" 		=> esc_html__( 'Please upload your favicon 72x72px. Please note that if you\'ve already uploaded the Site Icon in the Theme Customizer (Appearance -> Customize), the settings from the theme options panel will be ignored.', 'voyager' ),
						"id" 		=> "favicon_ipad",
						"std" 		=> '',
						"mod" 		=> "min",
						"fold" 		=> "favicon_retina",
						"type" 		=> "upload"
				);
$of_options[] = array( 	"name" 		=> esc_html__( 'Retina Favicon for iPhone (114x114)', 'voyager' ),
						"desc" 		=> esc_html__( 'Please upload your favicon 114x114px. Please note that if you\'ve already uploaded the Site Icon in the Theme Customizer (Appearance -> Customize), the settings from the theme options panel will be ignored.', 'voyager' ),
						"id" 		=> "favicon_iphone_retina",
						"std" 		=> '',
						"mod" 		=> "min",
						"fold" 		=> "favicon_retina",
						"type" 		=> "upload"
				);
				
$of_options[] = array( 	"name" 		=> esc_html__( 'Footer section', 'voyager' ),
						"desc" 		=> "",
						"id" 		=> "footer_section_info",
						"std" 		=> "<h3 style=\"margin: 3px;\">". esc_html__( 'Footer section', 'voyager' ) ."</h3>",
						"icon" 		=> true,
						"type" 		=> "info"
				);
$of_options[] = array( 	"name" 		=> esc_html__( 'Prefooter Area', 'voyager'),
						"desc" 		=> "",
						"id" 		=> "prefooter_area_enable",
						"std" 		=> "disabled",
						"folds" 	=> 1,
						"type" 		=> "select",
						"options" 	=> array( 'disabled' => 'Disabled', 'enabled' => 'Enabled' )
				);
$of_options[] = array( 	"name" 		=> esc_html__( 'Footer Layout', 'voyager'),
						"desc" 		=> esc_html__( 'Choose Prefooter Area layout.', 'voyager'),
						"id" 		=> "prefooter_area_layout",
						"std" 		=> "3-3-3-3",
						"type" 		=> "images",
						"fold" 		=> "prefooter_area_enable",
						"type" 		=> "select",
						"options" 	=> array( '12' => '1 Column', '6-6' => '2 Columns', '4-4-4' => '3 Columns', '3-3-3-3' => '4 Columns', )
				);
$of_options[] = array( 	"name" 		=> esc_html__( 'Footer Section', 'voyager' ),
						"desc" 		=> esc_html__( 'show/hide', 'voyager' ),
						"id" 		=> "footer_section",
						"std" 		=> 1,
						"folds" 	=> 1,
						"type" 		=> "switch"
				);
$of_options[] = array( 	"name" 		=> "Background Color",
						"desc" 		=> "Choose color for footer background.",
						"id" 		=> "footer_bg",
						"std" 		=> "",
						"fold" 		=> "footer_section",
						"type" 		=> "color"
				);
$of_options[] = array( 	"name" 		=> esc_html__( 'Copyright Text', 'voyager'),
						"desc" 		=> esc_html__( 'Insert Copyright Text.', 'voyager'),
						"id" 		=> "copyright_text",
						"std" 		=> "Copyrights &copy; 2015 Voyager. All Rights Reserved",
						"fold" 		=> "footer_section",
						"type" 		=> "textarea"
				);


// Typography 
$of_options[] = array( 	"name" 		=> esc_html__( 'Typography', 'voyager' ),
						"type" 		=> "heading"
				);
$of_options[] = array( 	"name" 		=> esc_html__( 'Body', 'voyager' ),
						"desc" 		=> "",
						"id" 		=> "body_info",
						"std" 		=> "<h3 style=\"margin: 3px;\">". esc_html__( 'Body', 'voyager' ) ."</h3>",
						"icon" 		=> true,
						"type" 		=> "info"
				);
$of_options[] = array( 	"name" 		=> esc_html__( 'Body text font', 'voyager' ),
						"desc" 		=> esc_html__( 'Specify the body font properties', 'voyager' ),
						"id" 		=> "global_text_font",
						"std" 		=> array(
											'size' 	=> '16px',
											'face' 	=> 'Open Sans',
											'style' => '300',
											'color' => '#333333'
										),
						"type" 		=> "typography"
				);

$of_options[] = array( 	"name" 		=> esc_html__( 'Headers font styling', 'voyager' ),
						"desc" 		=> "",
						"id" 		=> "header_font_info",
						"std" 		=> "<h3 style=\"margin: 3px;\">". esc_html__( 'Headlines', 'voyager' ) ."</h3>",
						"icon" 		=> true,
						"type" 		=> "info"
				);
$of_options[] = array( 	"name" 		=> esc_html__( 'Heading Font Family', 'voyager' ),
						"desc" 		=> "",
						"id" 		=> "heading_font",
						"std" 		=> "Oswald",
						"type" 		=> "select_google_font",
						"options"	=> 	$cs_googlefonts
				);
$of_options[] = array( 	"name" 		=> esc_html__( 'H1 - Specify Font Properties', 'voyager' ),
						"desc" 		=> "",
						"id" 		=> "h1_spec_font",
						"std" 		=> array('size' => '58px','color' => '#333333'),
						"type" 		=> "typography"
				);
$of_options[] = array( 	"name" 		=> esc_html__( 'H2 - Specify Font Properties', 'voyager' ),
						"desc" 		=> "",
						"id" 		=> "h2_spec_font",
						"std" 		=> array('size' => '38px','color' => '#333333'),
						"type" 		=> "typography"
				);
$of_options[] = array( 	"name" 		=> esc_html__( 'H3 - Specify Font Properties', 'voyager' ),
						"desc" 		=> "",
						"id" 		=> "h3_spec_font",
						"std" 		=> array('size' => '28px','color' => '#333333'),
						"type" 		=> "typography"
				);
$of_options[] = array( 	"name" 		=> esc_html__( 'H4 - Specify Font Properties', 'voyager' ),
						"desc" 		=> "",
						"id" 		=> "h4_spec_font",
						"std" 		=> array('size' => '18px','color' => '#333333'),
						"type" 		=> "typography"
				);
$of_options[] = array( 	"name" 		=> esc_html__( 'H5 - Specify Font Properties', 'voyager' ),
						"desc" 		=> "",
						"id" 		=> "h5_spec_font",
						"std" 		=> array('size' => '16px','color' => '#333333'),
						"type" 		=> "typography"
				);
$of_options[] = array( 	"name" 		=> esc_html__( 'H6 - Specify Font Properties', 'voyager' ),
						"desc" 		=> "",
						"id" 		=> "h6_spec_font",
						"std" 		=> array('size' => '14px','color' => '#333333'),
						"type" 		=> "typography"
				);
$of_options[] = array( 	"name" 		=> esc_html__( 'Google Font Weight', 'voyager' ),
						"desc" 		=> "",
						"id" 		=> "google_font_info",
						"std" 		=> "<h3 style=\"margin: 3px;\">". esc_html__( 'Google Font Weight', 'voyager' ) ."</h3>",
						"icon" 		=> true,
						"type" 		=> "info"
				);
$of_options[] = array( 	"name" 		=> esc_html__( 'Google Font Weight', 'voyager' ),
						"desc" 		=> esc_html__( 'Some of Google font has narrow style or unqiue weights and you can define here your custom.', 'voyager' ),
						"id" 		=> "google_font_weight",
						"std" 		=> "300,400,700",
						"type" 		=> "text"
				);
$of_options[] = array( 	"name" 		=> esc_html__( 'Google Font Subset', 'voyager' ),
						"desc" 		=> '',
						"id" 		=> "google_font_subset_inf",
						"std" 		=> "<h3 style=\"margin: 3px;\">". esc_html__( 'Google Font Subset', 'voyager' ) ."</h3>",
						"icon" 		=> true,
						"type" 		=> "info"
				);
$of_options[] = array( 	"name" 		=> esc_html__( 'Google Font Subset', 'voyager' ),
						"desc" 		=> '',
						"id" 		=> "google_font_subset",
						"std" 		=> 'latin',
						"type" 		=> "text"
				);


//      Colors and Styling TAB
$of_options[] = array( 	"name" 		=> "Colors and Styling",
						"type" 		=> "heading"
				);

$of_options[] = array( 	"name" 		=> "Theme Color",
						"desc" 		=> "Pick the color of theme (default: #99ccff).",
						"id" 		=> "theme_color",
						"std" 		=> "#99ccff",
						"type" 		=> "color"
				);
$of_options[] = array( 	"name" 		=> "Posts Carousel Background Color",
						"desc" 		=> "Pick the background color of Posts Carousel element (default: #f0f7ff).",
						"id" 		=> "posts_carousel_bg",
						"std" 		=> "#f0f7ff",
						"type" 		=> "color"
				);


//	Blog
$of_options[] = array( 	"name" 		=> esc_html__( 'Blog', 'voyager' ),
						"type" 		=> "heading"
				);
				
$of_options[] = array( 	"name" 		=> esc_html__( 'Sidebar', 'voyager' ),
						"desc" 		=> "",
						"id" 		=> "sidebar_layout_section",
						"std" 		=> "<h3 style=\"margin: 3px;\">". esc_html__( 'Sidebar', 'voyager' ) ."</h3>",
						"icon" 		=> true,
						"type" 		=> "info"
				);
$of_options[] = array( 	"name" 		=> esc_html__( 'Default Sidebar Layout', 'voyager'),
						"desc" 		=> "",
						"id" 		=> "sidebar_layout",
						"std" 		=> "no-sidebar",
						"type" 		=> "select",
						"options" 	=> array(
											"right-sidebar" 	=> esc_html__("Right sidebar", "voyager"),
											"left-sidebar" 		=> esc_html__("Left sidebar", "voyager"),
											"no-sidebar" 		=> esc_html__("Without sidebar", "voyager"),
										),
				);
				
$of_options[] = array( 	"name" 		=> esc_html__( 'Posts Style', 'voyager'),
						"desc" 		=> esc_html__( 'Style posts for standard pages (standard blog page, category pages, archive)',  'voyager' ),
						"id" 		=> 'blog_list_style_stand_pages',
						"std" 		=> '',
						"type" 		=> 'select',
						'options' 	=> array(
											'default' 			=> esc_html__('Default', 'voyager'),
											'left-image' 		=> esc_html__('Left Image', 'voyager'),
											'chess' 			=> esc_html__('Chess', 'voyager'),
											'grid-bg' 			=> esc_html__('Grid Background', 'voyager'),
											'masonry-bg' 		=> esc_html__('Masonry Background', 'voyager'),
										),
				);
$of_options[] = array( 	"name" 		=> esc_html__( 'Posts in Row', 'voyager'),
						"desc" 		=> esc_html__( 'Posts in row for standard pages (standard blog page, category pages, archive). This setting only for Posts Styles: "Grid Background", "Masonry Background"',  'voyager' ),
						"id" 		=> 'posts_in_a_row_stand_pages',
						"std" 		=> 'default',
						"type" 		=> 'select',
						'options' 	=> array('2' => '2', '3' => '3'),
				);
$of_options[] = array( 	"name" 		=> esc_html__('Instagram Type', 'voyager'),
						"desc" 		=> esc_html__( 'select the type of Instagram Block for Posts page, Categories page, Tags page, Search Result page.', 'voyager' ),
						"id" 		=> "blog_instagram_type",
						"std" 		=> "type1",
						"type" 		=> "select",
						"options" 	=> array(
										'type1' => esc_html__( 'Type 1', 'voyager' ),
										'type2' => esc_html__( 'Type 2', 'voyager' ),
										'type3' => esc_html__( 'Type 3', 'voyager' )
									)
				);
				
$of_options[] = array( 	"name" 		=> esc_html__( 'Category Font Family', 'voyager' ),
						"desc" 		=> esc_html__('Select a font for the post categories','voyager'),
						"id" 		=> "blog_category_font",
						"std" 		=> "Pacifico",
						"type" 		=> "select_google_font",
						"options"	=> 	$cs_googlefonts
				);

$of_options[] = array( 	"name" 		=> esc_html__( 'Single Post Settings', 'voyager' ),
						"desc" 		=> "",
						"id" 		=> "single_post_settings_section",
						"std" 		=> "<h3 style=\"margin: 3px;\">". esc_html__( 'Single Post Settings', 'voyager' ) ."</h3>",
						"icon" 		=> true,
						"type" 		=> "info"
				);
$of_options[] = array(  "name" 		=> esc_html__( 'Sidebar', 'voyager' ),
						"desc" 		=> esc_html__( 'Choose layout on single post view', 'voyager' ),
						"id" 		=> "single_post_sidebar",
						"std" 		=> "left-sidebar",
						"type" 		=> "select",
						"options" 	=> array(
										"no-sidebar" => esc_html__('Without sidebar','voyager'),
										"left-sidebar" => esc_html__('Left sidebar','voyager'),
										"right-sidebar" => esc_html__('Right sidebar','voyager'),
									),
				);
$of_options[] = array(  "name" 		=> esc_html__( 'Sidebar and Featured Image', 'voyager' ),
						"desc" 		=> esc_html__( 'Select the sidebar position. Sidebar under or next to the featured image', 'voyager' ),
						"id" 		=> "single_post_sidebar_under",
						"std" 		=> "under",
						"type" 		=> "select",
						"options" 	=> array(
										'under' => esc_html__('Under', 'voyager'),
										'next' => esc_html__('Next', 'voyager'),
									),
				);
$of_options[] = array(  "name" 		=> esc_html__( 'Featured Image Style', 'voyager' ),
						"desc" 		=> esc_html__( 'Select the style of a single post page. featured image in full screen or standard', 'voyager' ),
						"id" 		=> "single_post_featured_img",
						"std" 		=> "",
						"type" 		=> "select",
						"options" 	=> array(
										"" 				=> esc_html__('Default', 'voyager'),
										"fullwidth" 	=> esc_html__('Full Width', 'voyager'),
									),
				);
$of_options[] = array(  "name" 		=> esc_html__( 'Author info', 'voyager' ),
						"desc" 		=> esc_html__( 'Enable author info on single post view?', 'voyager' ),
						"id" 		=> "single_post_authorinfo",
						"std" 		=> 1,
						"type" 		=> "switch"
				);
$of_options[] = array(  "name" 		=> esc_html__( 'Single Post Navigation', 'voyager' ),
						"desc" 		=> esc_html__( 'Enable navigation on single post view?', 'voyager' ),
						"id" 		=> "single_post_navigation",
						"std" 		=> 1,
						"type" 		=> "switch"
				);
$of_options[] = array(  "name" 		=> esc_html__( 'Related Posts', 'voyager' ),
						"desc" 		=> esc_html__( 'Enable related posts on single post view?', 'voyager' ),
						"id" 		=> "single_post_relatedposts",
						"folds" 	=> "1",
						"std" 		=> 1,
						"type" 		=> "switch"
				);
$of_options[] = array( 	"name" 		=> esc_html__('Related Posts Style', 'voyager'),
						"desc" 		=> esc_html__( 'choose style to displaying related posts', 'voyager' ),
						"id" 		=> "single_post_relatedposts_style",
						"fold" 		=> "single_post_relatedposts",
						"std" 		=> "grid",
						"type" 		=> "select",
						"options" 	=> array('carousel' => esc_html__( 'Carousel', 'voyager' ), 'grid' => esc_html__( 'Grid', 'voyager' ))
				);
				
$of_options[] = array( 	"name" 		=> esc_html__('Instagram Type', 'voyager'),
						"desc" 		=> esc_html__( 'select the type of Instagram Block for Single Post page.', 'voyager' ),
						"id" 		=> "single_post_instagram_type",
						"std" 		=> "type1",
						"type" 		=> "select",
						"options" 	=> array(
										'type1' => esc_html__( 'Type 1', 'voyager' ),
										'type2' => esc_html__( 'Type 2', 'voyager' ),
										'type3' => esc_html__( 'Type 3', 'voyager' )
									)
				);
				
$of_options[] = array(  "name" 		=> esc_html__( 'Enable Prefooter Area on single post view?', 'voyager' ),
						"desc" 		=>"",
						"id" 		=> "single_post_prefooter_area_enable",
						"std"		=> 0,
						"type" 		=> "switch"
				);

$of_options[] = array(  "name" 		=> "",
						"desc" 		=> "",
						"id" 		=> "general_heading",
						"std" 		=> "<h3 style=\"margin: 3px;\">". esc_html__( 'Social sharing box icons', 'voyager' ) ."</h3>",
						"icon" 		=> false,
						"type" 		=> "info"
				);
$of_options[] = array(  "name" 		=> esc_html__( 'Enable social share-box on single post view?', 'voyager' ),
						"desc" 		=>"",
						"id" 		=> "single_post_sharebox",
						"std"		=> 1,
						"type" 		=> "switch"
				);
$of_options[] = array(  "name" 		=> esc_html__( 'Enable Facebook in social sharing box', 'voyager' ),
						"desc" 		=> esc_html__( 'Check to enable Facebook in social sharing box', 'voyager' ),
						"id" 		=> "check_sharingboxfacebook",
						"fold" 		=> "single_post_sharebox",
						"std" 		=> 1,
						"type" 		=> "checkbox"
				);
$of_options[] = array(  "name" 		=> esc_html__( 'Enable Twitter in social sharing box', 'voyager' ),
						"desc" 		=> esc_html__( 'Check to enable Twitter in social sharing box', 'voyager' ),
						"id" 		=> "check_sharingboxtwitter",
						"fold"		=> "single_post_sharebox",
						"std" 		=> 1,
						"type"		=> "checkbox"
				);
$of_options[] = array(  "name" 		=> esc_html__( 'Enable LinkedIn in Social sharing box', 'voyager' ),
						"desc" 		=> esc_html__( 'Check to enable LinkedIn in social sharing box', 'voyager' ),
						"id" 		=> "check_sharingboxlinkedin",
						"fold" 		=> "single_post_sharebox",
						"std" 		=> 0,
						"type" 		=> "checkbox"
				);
$of_options[] = array( 	"name" 		=> esc_html__( 'Enable Reddit in social sharing box', 'voyager' ),
						"desc" 		=> esc_html__( 'Check to enable Reddit in social sharing box', 'voyager' ),
						"id" 		=> "check_sharingboxreddit",
						"fold" 		=> "single_post_sharebox",
						"std" 		=> 0,
						"type" 		=> "checkbox"
				); 
$of_options[] = array( 	"name" 		=> esc_html__("Enable Digg in social sharing box",'voyager'),
						"desc" 		=> esc_html__("Check to enable Digg in social sharing box",'voyager'),
						"id" 		=> "check_sharingboxdigg",
						"fold" 		=> "single_post_sharebox",
						"std" 		=> 0,
						"type" 		=> "checkbox"
				);
$of_options[] = array( 	"name" 		=> esc_html__("Enable Delicious in social sharing box",'voyager'),
						"desc" 		=> esc_html__("Check to enable Delicious in social sharing box",'voyager'),
						"id" 		=> "check_sharingboxdelicious",
						"fold" 		=> "single_post_sharebox",
						"std" 		=> 0,
						"type" 		=> "checkbox"
				);
$of_options[] = array(  "name" 		=> esc_html__( 'Enable Google plus in social sharing box', 'voyager' ),
						"desc" 		=> esc_html__( 'Check to enable Google plus in social sharing box', 'voyager' ),
						"id" 		=> "check_sharingboxgoogle",
						"fold" 		=> "single_post_sharebox",
						"std" 		=> 1,
						"type" 		=> "checkbox"
				);
$of_options[] = array(  "name" 		=> esc_html__( 'Enable Pinterest in social sharing box', 'voyager' ),
						"desc" 		=> esc_html__( 'Check to enable Pinterest in social sharing box', 'voyager' ),
						"id" 		=> "check_sharingboxpinterest",
						"fold" 		=> "single_post_sharebox",
						"std" 		=> 1,
						"type" 		=> "checkbox"
				);
$of_options[] = array(  "name" 		=> esc_html__( 'Enable Tumblr in social sharing box', 'voyager' ),
						"desc" 		=> esc_html__( 'Check to enable Tumblr in social sharing box', 'voyager' ),
						"id" 		=> "check_sharingboxtumblr",
						"fold" 		=> "single_post_sharebox",
						"std" 		=> 1,
						"type" 		=> "checkbox"
				);
				
		
//	Portfolio
if (evatheme_cpt_enabled()) {
	$of_options[] = array( 	"name" 		=> esc_html__( 'Portfolio', 'voyager' ),
							"type" 		=> "heading"
					);
	$of_options[] = array( 	"name" 		=> esc_html__( 'Portfolio Single Settings', 'voyager' ),
							"desc" 		=> "",
							"id" 		=> "portfolio_single_settings_section",
							"std" 		=> "<h3 style=\"margin: 3px;\">". esc_html__( 'Portfolio Single Settings', 'voyager' ) ."</h3>",
							"icon" 		=> true,
							"type" 		=> "info"
					);
	$of_options[] = array(  "name" 		=> esc_html__( 'Portfolio Single Navigation', 'voyager' ),
							"desc" 		=> esc_html__( 'Enable navigation on portfolio single view?', 'voyager' ),
							"id" 		=> "portfolio_single_navigation",
							"std" 		=> 1,
							"type" 		=> "switch"
					);
	$of_options[] = array(  "name" 		=> esc_html__( 'Related Posts', 'voyager' ),
							"desc" 		=> esc_html__( 'Enable related posts on single post view?', 'voyager' ),
							"id" 		=> "portfolio_single_relatedposts",
							"folds" 	=> "1",
							"std" 		=> 1,
							"type" 		=> "switch"
					);
	
	$of_options[] = array( 	"name" 		=> esc_html__('Instagram Type', 'voyager'),
							"desc" 		=> esc_html__( 'select the type of Instagram Block for this page.', 'voyager' ),
							"id" 		=> "portfolio_single_instagram_type",
							"std" 		=> "type1",
							"type" 		=> "select",
							"options" 	=> array(
											'type1' => esc_html__( 'Type 1', 'voyager' ),
											'type2' => esc_html__( 'Type 2', 'voyager' ),
											'type3' => esc_html__( 'Type 3', 'voyager' )
										)
					);

	$of_options[] = array(  "name" 		=> "",
							"desc" 		=> "",
							"id" 		=> "general_heading",
							"std" 		=> "<h3 style=\"margin: 3px;\">". esc_html__( 'Social sharing box icons', 'voyager' ) ."</h3>",
							"icon" 		=> false,
							"type" 		=> "info"
					);
	$of_options[] = array(  "name" 		=> esc_html__( 'Enable social share-box on portfolio single view?', 'voyager' ),
							"desc" 		=>"",
							"id" 		=> "portfolio_single_sharebox",
							"std"		=> 1,
							"type" 		=> "switch"
					);
	$of_options[] = array(  "name" 		=> esc_html__( 'Enable Facebook in social sharing box', 'voyager' ),
							"desc" 		=> esc_html__( 'Check to enable Facebook in social sharing box', 'voyager' ),
							"id" 		=> "check_portfolio_sharingboxfacebook",
							"fold" 		=> "portfolio_single_sharebox",
							"std" 		=> 1,
							"type" 		=> "checkbox"
					);
	$of_options[] = array(  "name" 		=> esc_html__( 'Enable Twitter in social sharing box', 'voyager' ),
							"desc" 		=> esc_html__( 'Check to enable Twitter in social sharing box', 'voyager' ),
							"id" 		=> "check_portfolio_sharingboxtwitter",
							"fold"		=> "portfolio_single_sharebox",
							"std" 		=> 1,
							"type"		=> "checkbox"
					);
	$of_options[] = array(  "name" 		=> esc_html__( 'Enable LinkedIn in Social sharing box', 'voyager' ),
							"desc" 		=> esc_html__( 'Check to enable LinkedIn in social sharing box', 'voyager' ),
							"id" 		=> "check_portfolio_sharingboxlinkedin",
							"fold" 		=> "portfolio_single_sharebox",
							"std" 		=> 0,
							"type" 		=> "checkbox"
					);
	$of_options[] = array( 	"name" 		=> esc_html__( 'Enable Reddit in social sharing box', 'voyager' ),
							"desc" 		=> esc_html__( 'Check to enable Reddit in social sharing box', 'voyager' ),
							"id" 		=> "check_portfolio_sharingboxreddit",
							"fold" 		=> "portfolio_single_sharebox",
							"std" 		=> 0,
							"type" 		=> "checkbox"
					); 
	$of_options[] = array( 	"name" 		=> esc_html__("Enable Digg in social sharing box",'voyager'),
							"desc" 		=> esc_html__("Check to enable Digg in social sharing box",'voyager'),
							"id" 		=> "check_portfolio_sharingboxdigg",
							"fold" 		=> "portfolio_single_sharebox",
							"std" 		=> 0,
							"type" 		=> "checkbox"
					);
	$of_options[] = array( 	"name" 		=> esc_html__("Enable Delicious in social sharing box",'voyager'),
							"desc" 		=> esc_html__("Check to enable Delicious in social sharing box",'voyager'),
							"id" 		=> "check_portfolio_sharingboxdelicious",
							"fold" 		=> "portfolio_single_sharebox",
							"std" 		=> 0,
							"type" 		=> "checkbox"
					);
	$of_options[] = array(  "name" 		=> esc_html__( 'Enable Google plus in social sharing box', 'voyager' ),
							"desc" 		=> esc_html__( 'Check to enable Google plus in social sharing box', 'voyager' ),
							"id" 		=> "check_portfolio_sharingboxgoogle",
							"fold" 		=> "portfolio_single_sharebox",
							"std" 		=> 1,
							"type" 		=> "checkbox"
					);
	$of_options[] = array(  "name" 		=> esc_html__( 'Enable Pinterest in social sharing box', 'voyager' ),
							"desc" 		=> esc_html__( 'Check to enable Pinterest in social sharing box', 'voyager' ),
							"id" 		=> "check_portfolio_sharingboxpinterest",
							"fold" 		=> "portfolio_single_sharebox",
							"std" 		=> 1,
							"type" 		=> "checkbox"
					);
	$of_options[] = array(  "name" 		=> esc_html__( 'Enable Tumblr in social sharing box', 'voyager' ),
							"desc" 		=> esc_html__( 'Check to enable Tumblr in social sharing box', 'voyager' ),
							"id" 		=> "check_portfolio_sharingboxtumblr",
							"fold" 		=> "portfolio_single_sharebox",
							"std" 		=> 1,
							"type" 		=> "checkbox"
					);
}


//	Shop
if (cstheme_woo_enabled()) {
	$of_options[] = array( 	"name" 		=> esc_html__( 'Shop', 'voyager' ),
							"type" 		=> "heading"
					);

	$of_options[] = array(  "name" 		=> esc_html__( 'Mini Cart', 'voyager' ),
							"desc" 		=> esc_html__( 'Enable related posts on single post view?', 'voyager' ),
							"id" 		=> "mini_cart_enabled",
							"folds" 	=> "1",
							"std" 		=> 1,
							"type" 		=> "switch"
					);

	$of_options[] = array( 	"name" 		=> esc_html__( 'Sidebar', 'voyager' ),
							"desc" 		=> "",
							"id" 		=> "shop_sidebar_layout_section",
							"std" 		=> "<h3 style=\"margin: 3px;\">". esc_html__( 'Sidebar', 'voyager' ) ."</h3>",
							"icon" 		=> true,
							"type" 		=> "info"
					);
	$of_options[] = array( 	"name" 		=> esc_html__( 'Default Sidebar Layout', 'voyager'),
							"desc" 		=> "",
							"id" 		=> "shop_sidebar_layout",
							"std" 		=> "no-sidebar",
							"type" 		=> "select",
							"options" 	=> array("no-sidebar" => "Without sidebar", "left-sidebar" => "Left sidebar","right-sidebar" => "Right sidebar")
					);

	$of_options[] = array( 	"name" 		=> esc_html__( 'Products List', 'voyager' ),
							"desc" 		=> "",
							"id" 		=> "shop_page_section",
							"std" 		=> "<h3 style=\"margin: 3px;\">". esc_html__( 'Products List', 'voyager' ) ."</h3>",
							"icon" 		=> true,
							"type" 		=> "info"
					);
	$of_options[] = array( 	"name" 		=> esc_html__( 'Products per Page', 'voyager' ),
							"id" 		=> "products_per_page",
							"std" 		=> "12",
							"type" 		=> "text"
					);
	$of_options[] = array( 	"name" 		=> esc_html__( 'Shop Title', 'voyager' ),
							"id" 		=> "shop_title",
							"std" 		=> "Shop",
							"type" 		=> "text"
					);
	$of_options[] = array( 	"name" 		=> esc_html__( 'Page Title Background', 'voyager' ),
							"desc" 		=> esc_html__( 'Upload a picture to be displayed after the menu on the full width of the screen', 'voyager' ),
							"id" 		=> "shop_pagetitle_bg",
							"std" 		=> "",
							"type" 		=> "media"
					);
}

				
//      Social Icons TAB
$of_options[] = array( 	"name" 		=> esc_html__( 'Social Icons', 'voyager' ),
						"type" 		=> "heading",
				);
$of_options[] = array( 	"name" 		=> esc_html__( 'Social Icons heading', 'voyager' ),
						"desc" 		=> "",
						"id" 		=> "social_icons_info",
						"std" 		=> "<h3 style=\"margin: 3px;\">". esc_html__( 'This will displayed on Header and Footer', 'voyager' ) ."</h3>",
						"icon" 		=> true,
						"type" 		=> "info"
				);
$of_options[] = array( 	"name" 		=> esc_html__( 'Facebook ID', 'voyager' ),
						"desc" 		=> esc_html__( 'Enter the Facebook ID.', 'voyager' ),
						"id" 		=> "facebook_username",
						"std" 		=> "evatheme",
						"type" 		=> "text"
				);
$of_options[] = array( 	"name" 		=> esc_html__( 'Flickr Username', 'voyager' ),
						"desc" 		=> esc_html__( 'Enter the Flickr Username.', 'voyager' ),
						"id" 		=> "flickr_username",
						"std" 		=> "",
						"type" 		=> "text"
				);
$of_options[] = array( 	"name" 		=> esc_html__( 'Google + ID', 'voyager' ),
						"desc" 		=> esc_html__( 'Enter full url Google +', 'voyager' ),
						"id" 		=> "googleplus_username",
						"std" 		=> "https://plus.google.com/u/0/118081511278726903377/posts",
						"type" 		=> "text"
				);
$of_options[] = array( 	"name" 		=> esc_html__( 'Twitter Username', 'voyager' ),
						"desc" 		=> esc_html__( 'Enter the Twitter Username.', 'voyager' ),
						"id" 		=> "tweets_username",
						"std" 		=> "EVATHEME",
						"type" 		=> "text"
				);
$of_options[] = array( 	"name" 		=> esc_html__( 'Instagram Username', 'voyager' ),
						"desc" 		=> esc_html__( 'Enter the Instagram Username.', 'voyager' ),
						"id" 		=> "instagram_username",
						"std" 		=> "",
						"type" 		=> "text"
				);
$of_options[] = array( 	"name" 		=> esc_html__( 'Pinterest Username', 'voyager' ),
						"desc" 		=> esc_html__( 'Enter the Pinterest Username.', 'voyager' ),
						"id" 		=> "pinterest_username",
						"std" 		=> "",
						"type" 		=> "text"
				);
$of_options[] = array( 	"name" 		=> esc_html__( 'Skype Username', 'voyager' ),
						"desc" 		=> esc_html__( 'Enter the Skype Username.', 'voyager' ),
						"id" 		=> "skype_username",
						"std" 		=> "",
						"type" 		=> "text"
				);
$of_options[] = array( 	"name" 		=> esc_html__( 'Youtube Username', 'voyager' ),
						"desc" 		=> esc_html__( 'Enter the Youtube Username.', 'voyager' ),
						"id" 		=> "youtube_username",
						"std" 		=> "",
						"type" 		=> "text"
				);
$of_options[] = array( 	"name" 		=> esc_html__( 'Dribbble Username', 'voyager' ),
						"desc" 		=> esc_html__( 'Enter the Dribbble Username.', 'voyager' ),
						"id" 		=> "dribbble_username",
						"std" 		=> "",
						"type" 		=> "text"
				);
$of_options[] = array( 	"name" 		=> esc_html__( 'Linkedin URL', 'voyager' ),
						"desc" 		=> esc_html__( 'Enter the Linkedin URL.', 'voyager' ),
						"id" 		=> "linkedin_username",
						"std" 		=> "",
						"type" 		=> "text"
				);
$of_options[] = array( 	"name" 		=> esc_html__( 'RSS URL', 'voyager' ),
						"desc" 		=> esc_html__( 'Enter the RSS URL.', 'voyager' ),
						"id" 		=> "rss_username",
						"std" 		=> "",
						"type" 		=> "text"
				);
$of_options[] = array( 	"name" 		=> esc_html__( 'VK URL', 'voyager' ),
						"desc" 		=> esc_html__( 'Enter the VK URL ( without reference http://vk.com/ ).', 'voyager' ),
						"id" 		=> "vk_username",
						"std" 		=> "",
						"type" 		=> "text"
				);
$of_options[] = array( 	"name" 		=> esc_html__( 'Tumblr URL', 'voyager' ),
						"desc" 		=> esc_html__( 'Enter the Tumblr URL ( full url ).', 'voyager' ),
						"id" 		=> "tumblr_username",
						"std" 		=> "",
						"type" 		=> "text"
				);
$of_options[] = array( 	"name" 		=> esc_html__( 'Vimeo URL', 'voyager' ),
						"desc" 		=> esc_html__( 'Enter the Vimeo URL ( full url ).', 'voyager' ),
						"id" 		=> "vimeo_username",
						"std" 		=> "",
						"type" 		=> "text"
				);

				
// Instagram
$of_options[] = array( 	"name" 		=> esc_html__( 'Instagram', 'voyager' ),
						"type" 		=> "heading",
				);
$of_options[] = array( 	"name" 		=> esc_html__( 'Instagram', 'voyager' ),
						"desc" 		=> "",
						"id" 		=> "instagram_section",
						"std" 		=> "<h3 style=\"margin: 3px;\">". esc_html__( 'Instagram Section', 'voyager' ) ."</h3>",
						"type" 		=> "info"
				);
$of_options[] = array(  "name" 		=> esc_html__( 'Instagram', 'voyager' ),
						"desc" 		=> esc_html__( 'Enable instagram on footer of the site?', 'voyager' ),
						"id" 		=> "instagram_enable",
						"std" 		=> 1,
						"type" 		=> "switch"
				);
$of_options[] = array( 	"name" 		=> esc_html__('Instagram Type', 'voyager'),
						"desc" 		=> esc_html__( 'select the type of Instagram Block for Pages.', 'voyager' ),
						"id" 		=> "page_instagram_type",
						"std" 		=> "type1",
						"type" 		=> "select",
						"options" 	=> array(
										'type1' => esc_html__( 'Type 1', 'voyager' ),
										'type2' => esc_html__( 'Type 2', 'voyager' ),
										'type3' => esc_html__( 'Type 3', 'voyager' )
									)
				);
$of_options[] = array( 	"name" 		=> esc_html__( 'Instagram Block Title', 'voyager' ),
						"desc" 		=> esc_html__( 'Only for Type 1 and Type 2','voyager' ),
						"id" 		=> "instagram_title",
						"std" 		=> "More beautiful photos of our readers",
						"fold"		=> "instagram_enable",
						"type" 		=> "text"
				);
$of_options[] = array( 	"name" 		=> esc_html__( 'Description', 'voyager' ),
						"desc" 		=> esc_html__( 'Only for Type 1','voyager' ),
						"id" 		=> "instagram_descr",
						"std" 		=> "",
						"fold"		=> "instagram_enable",
						"type" 		=> "textarea"
				);
$of_options[] = array( 	"name" 		=> esc_html__( 'Account Link', 'voyager' ),
						"desc" 		=> '',
						"id" 		=> "instagram_link",
						"std" 		=> "",
						"fold"		=> "instagram_enable",
						"type" 		=> "text"
				);
$of_options[] = array( 	"name" 		=> esc_html__( 'User Id', 'voyager' ),
						"desc" 		=> esc_html__( 'Required. Your API client id from Instagram. Instructions on how to generate your account information <a href="http://lab.strategio.fr/instagram-id.php?lang=en" target="_blank">link</a>', 'voyager' ),
						"id" 		=> "instagram_userId",
						"std" 		=> "",
						"fold"		=> "instagram_enable",
						"type" 		=> "text"
				);
$of_options[] = array( 	"name" 		=> esc_html__( 'Access Token', 'voyager' ),
						"desc" 		=> esc_html__( 'A valid oAuth token. Can be used in place of a client ID. <a href="http://instagram.pixelunion.net/" target="_blank">link</a>', 'voyager' ),
						"id" 		=> "instagram_accessToken",
						"std" 		=> "",
						"fold"		=> "instagram_enable",
						"type" 		=> "text"
				);
				

/* HTML BLOCKS */
$of_options[] = array( 	"name" 		=> esc_html__( 'HTML blocks', 'voyager' ),
						"type" 		=> "heading"
				);
$of_options[] = array( 	"name" 		=> esc_html__( 'Custom CSS', 'voyager' ),
						"desc" 		=> esc_html__( 'Add custom CSS code here', 'voyager' ),
						"id" 		=> "html_custom_css",
						"std" 		=> "div {}",
						"type" 		=> "textarea"
				);
				
//	Backup
$of_options[] = array( 	'name' 		=> esc_html__('Backup options', 'voyager'),
						'id' 		=> 'backupoptions',
						'type' 		=> 'heading'
				);	
$of_options[] = array( 	'name' 		=> esc_html__('Backup and restore options', 'voyager'),
						'id' 		=> 'of_backup',
						'std' 		=> '',
						'type' 		=> 'backup',
						'desc' 		=> esc_html__('You can backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.', 'voyager'),
				);
$of_options[] = array( 	'name' 		=> esc_html__('Transfer theme options data', 'voyager'),
						'id' 		=> 'of_transfer',
						'std' 		=> '',
						'type' 		=> 'transfer',
						'desc' 		=> esc_html__('You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click "import options".', 'voyager'),
				);

/* Do not remove */
$of_options[] = array(  "name" 		=> "",
						"desc" 		=> "",
						"id" 		=> "hide",
						"std" 		=> "",
						"type" 		=> "media"
				);

}//End function: of_options()
}//End chack if function exists: of_options()
?>
