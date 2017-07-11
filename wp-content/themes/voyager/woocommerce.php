<?php
/**
 * The template for displaying pages
 */

get_header();

$featured_image_url = cstheme_option('shop_pagetitle_bg');

$shop_sidebar_layout = cstheme_option( 'shop_sidebar_layout' ) ? cstheme_option( 'shop_sidebar_layout' ) : 'no-sidebar';
if( $shop_sidebar_layout == 'left-sidebar' && is_shop() ) {
	$shop_sidebar_class = 'pull-left';
	$shop_page_content_class = 'col-md-9 pull-right ';
} elseif( $shop_sidebar_layout == 'right-sidebar' && is_shop() ) {
	$shop_sidebar_class = 'pull-right ';
	$shop_page_content_class = 'col-md-9 pull-left ';
} else {
	$shop_sidebar_class = '';
	$shop_page_content_class = 'col-md-12 ';
}

$shop_title = cstheme_option('shop_title');
?>

		<div id="shop_page">
			
			<?php
				if ( !empty($featured_image_url )) {
					echo '<div class="page_featured_image" style="background-image:url(' . $featured_image_url . ');"></div>';
				}
			?>
			
			<div class="container">
				<div class="row">
					<div class="<?php echo $shop_page_content_class ?>">
						<div class="page_title text-center">
							<?php	
								if ( !empty( $shop_title ) && is_shop() ) {
									echo '<h1>' . esc_attr( $shop_title ) . '</h1>';
								}
							?>
						</div>
						
						<div class="shop_wrap clearfix">
				
							<?php woocommerce_content(); ?>
						
						</div>
					</div>
					
					<?php 
						if( $shop_sidebar_layout != 'no-sidebar' ) {
							echo '<div id="shop_sidebar" class="col-md-3 ' . $shop_sidebar_class . '">';
								if( !dynamic_sidebar('woocommerce-sidebar') ) {
									dynamic_sidebar('blog-sidebar');
								}
							echo '</div>';
						}
					?>
					
				</div>
			</div>
		</div>

<?php get_footer(); ?>