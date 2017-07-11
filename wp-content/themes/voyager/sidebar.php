<?php
/**
 * The sidebar containing the main widget area
 */
 
$woo = false;
if( cstheme_woo_enabled() && get_post_type() == 'product' ) {
	$woo = true;
}

	if ( is_singular( 'portfolio' ) || is_post_type_archive( 'portfolio' ) ) {
		
		echo '<div id="portfolio_sidebar">';
			
			if ( is_active_sidebar( 'portfolio-sidebar' ) ) {
				dynamic_sidebar('portfolio-sidebar');
			}
			
		echo '</div>';
	
	} else {
		
		echo '<div id="blog_sidebar">';
			
			if ( is_active_sidebar( 'blog-sidebar' ) ) {
				dynamic_sidebar('blog-sidebar');
			}
			
		echo '</div>';
	
	}