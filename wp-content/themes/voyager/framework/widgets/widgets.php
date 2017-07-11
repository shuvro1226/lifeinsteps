<?php

/**
 * Register sidebars
 */
function cstheme_widgets_init() {
	
	//	Blog Sidebar
	register_sidebar( array(
		'name'          	=> esc_html__( 'Blog Sidebar', 'voyager' ),
		'id'            	=> 'blog-sidebar',
		'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  	=> '</aside>',
		'before_title'  	=> '<h4 class="widget-title"><span>',
		'after_title'   	=> '</span></h4>',
	) );
	
	//	Portfolio Sidebar
	register_sidebar( array(
		'name'          	=> esc_html__( 'Portfolio Sidebar', 'voyager' ),
		'id'            	=> 'portfolio-sidebar',
		'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  	=> '</aside>',
		'before_title'  	=> '<h4 class="widget-title"><span>',
		'after_title'   	=> '</span></h4>',
	) );
	
	//	Fixed Sidebar
	register_sidebar( array(
		'name'          	=> esc_html__( 'Fixed Sidebar', 'voyager' ),
		'id'            	=> 'sidebar-fixed',
		'description'       => esc_html__( 'Here you can create a set of widgets to display in the Fixed Sidebar. It should be enable in the Theme Options', 'voyager'),
		'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  	=> '</aside>',
		'before_title'  	=> '<h4 class="widget-title"><span>',
		'after_title'   	=> '</span></h4>',
	) );
	
	//	Footer sidebars
	if( cstheme_option('prefooter_area_enable') != 'disabled' ) {
		$grid = cstheme_option('prefooter_area_layout')!="" ? cstheme_option('prefooter_area_layout') : '3-3-3-3';
		$i = 1;
		foreach (explode('-', $grid) as $g) {
			register_sidebar(array(
				'name' => esc_html__("Footer sidebar ", "voyager") . $i,
				'id' => "footer-sidebar-$i",
				'description' => esc_html__('The footer sidebar widget area', 'voyager'),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget' => '</aside>',
				'before_title' => '<h4 class="widget-title"><span>',
				'after_title' => '</span></h4>',
			));
			$i++;
		}
	}
	
	//	WooCommerce
	if (cstheme_woo_enabled()) {
		
		//	Shop Sidebar
		register_sidebar( array(
			'name'          	=> esc_html__( 'Shop Sidebar', 'voyager' ),
			'id'            	=> 'woocommerce-sidebar',
			'description'       => esc_html__( 'Here you can create a set of widgets to display in the Shop Sidebar. It should be enable in the Theme Options', 'voyager'),
			'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  	=> '</aside>',
			'before_title'  	=> '<h4 class="widget-title"><span>',
			'after_title'   	=> '</span></h4>',
		) );
		
	}
	
}
add_action( 'widgets_init', 'cstheme_widgets_init' );


/**
 * Include widgets
 */
include_once ( 'widget-flickr.php' );
include_once ( 'widget-posts.php' );
include_once ( 'widget-facebook.php' );
include_once ( 'widget-social.php' );
include_once ( 'widget-twitter.php' );
include_once ( 'widget-instagram.php' );