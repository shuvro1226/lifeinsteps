<?php
/**
 * Blog Theme functions and definitions
 */


/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 1170;
}

/**
 * CSTheme Setup
 */

if ( ! function_exists( 'cstheme_setup' ) ) :
function cstheme_setup() {

	//	Make theme available for translation.
	load_theme_textdomain( 'voyager', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	//	Let WordPress manage the document title.
	add_theme_support( 'title-tag' );

	//	Enable support for Post Thumbnails on posts and pages.
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 825, 510, true );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'voyager' )
	) );

	//	Switch default core markup for search form, comment form, and comments
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );
	
	//This theme support custom header
    add_theme_support( 'custom-header' );

    //This theme support custom backgrounds
    add_theme_support( 'custom-backgrounds' );
	
	//	WooCommerce
	add_theme_support( 'woocommerce' );

}
endif; // cstheme_setup
add_action( 'after_setup_theme', 'cstheme_setup' );


function cstheme_post_type( $current_screen ) {
	if ( 'post' == $current_screen->post_type && 'post' == $current_screen->base ) {
		add_theme_support( 'post-formats', array('image', 'gallery', 'link', 'quote', 'video', 'aside', 'status'));
	}
}
add_action( 'current_screen', 'cstheme_post_type' );

add_theme_support( 'post-formats', array( 'audio', 'gallery', 'video') );
add_post_type_support( 'portfolio', 'post-formats' );


/**
 * Include files
 */

//	Theme Functions
require_once ( get_template_directory() .'/framework/theme_functions.php' );
 
//	Theme style, jQuery
require_once ( get_template_directory() .'/framework/css-js.php' );

//	Google Fonts
require_once ( get_template_directory() .'/framework/googlefonts.php' );

//	Plugin Recommendations
require_once ( get_template_directory() .'/framework/plugins/install-plugin.php' );

//	Load theme option panel
require_once ( get_template_directory() .'/admin/index.php' );

//	Load theme meta boxes
if(is_admin()) {
    require_once ( get_template_directory() .'/framework/metabox/metaboxes.php' );
}

//	Aqua Resizer
require_once( get_template_directory() .'/framework/aq_resizer.php' );

//	Widgets
require_once ( get_template_directory() .'/framework/widgets/widgets.php' );

//	Wordpress Importer
require_once( get_template_directory() .'/framework/importer/importer.php' );

//	Categories Images
require_once( get_template_directory() .'/framework/categories-images/categories-images.php' );

//	Megamenu Framework
require_once( get_template_directory() .'/framework/megamenu.php' );

//	Portfolio
if(class_exists('evatheme_cpt')) {
	require_once( get_template_directory() .'/framework/portfolio_functions.php' );
}

//	WooCommerce
if(class_exists('Woocommerce')) {
	require_once( get_template_directory() .'/framework/woo_functions.php' );
}
remove_action('wp_head', 'wp_generator');
