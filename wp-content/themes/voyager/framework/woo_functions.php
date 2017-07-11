<?php 

/* Get cart contents count */
if (!function_exists('cstheme_get_cart_icon')) {
	function cstheme_get_cart_icon() {

		$cart_count = intval( WC()->cart->cart_contents_count );

		?>
			<a class="cstheme_cart_icon" href="javascript:void(0)">
				<span><?php echo esc_attr( $cart_count ); ?></span>
			</a>
		<?php 
	}
}

//	Product image size
function eva_woocommerce_image_dimensions() {
  	$catalog = array(
		'width' 	=> '350',
		'height'	=> '435',
		'crop'		=> 1
	);
	
	$single = array(
		'width' 	=> '490',
		'height'	=> '608',
		'crop'		=> 1
	);

	$thumbnail = array(
		'width' 	=> '75',
		'height'	=> '93',
		'crop'		=> 1
	);

	// Image sizes
	update_option( 'shop_catalog_image_size', $catalog ); 		// Product category thumbs
	update_option( 'shop_single_image_size', $single ); 		// Single product image
	update_option( 'shop_thumbnail_image_size', $thumbnail ); 	// Image gallery thumbs
}
add_action( 'init', 'eva_woocommerce_image_dimensions' );


//	Products Columns
add_filter('loop_shop_columns', 'cstheme_shop_columns');
if (!function_exists('cstheme_shop_columns')) {
	function cstheme_shop_columns() {
		if(cstheme_option('shop_sidebar_layout') == 'no-sidebar') {
			return 4;
		}
		return 3;
	}
}

//	Products per page
$products_per_page = ( strlen( cstheme_option('products_per_page') ) > 0 ) ? intval( cstheme_option('products_per_page') ) : 12;
add_filter( 'loop_shop_per_page', create_function( '$cols', 'return ' . $products_per_page . ';' ), 20 );

//	Page Title
add_filter('woocommerce_show_page_title', 'cstheme_woo_title_none');
if (!function_exists('cstheme_woo_title_none')) {
	function cstheme_woo_title_none(){
		return false;
	}
}


//	WooCommerce Product Item
add_action('woocommerce_before_shop_loop_item', 'cstheme_before_shop_loop_item',5);
add_action('woocommerce_after_shop_loop_item', 'cstheme_after_shop_loop_item',5);

//	add to cart button
add_filter( 'woocommerce_product_add_to_cart_text', 'cstheme_add_to_cart_text' );
if ( ! function_exists( 'cstheme_add_to_cart_text' ) ) {
	function cstheme_add_to_cart_text() {
		global $product;

		if ( $product->product_type != 'external' ) {
			$text = '';
		}
		return $text;
	}
}

if ( ! function_exists( 'cstheme_before_shop_loop_item' ) ) {
	function cstheme_before_shop_loop_item() {
		global $woocommerce, $product, $post;
		?>
		<div class="product_wrap">
			<div class="shop_list_product_image">
				<a href="<?php the_permalink()?>">
					<?php echo woocommerce_get_product_thumbnail();?>
				</a>
				<?php if ( $product->is_on_sale() ) {

						$sale_percent = cstheme_product_get_sale_percent( $product );
							
						if ( $sale_percent > 0 ) {
							echo apply_filters( 'woocommerce_sale_flash', '<span class="onsale"><span class="nm-onsale-before">-</span>' . $sale_percent . '<span class="nm-onsale-after">%</span></span>', $post, $product );
						}
				} ?>
			</div>
			<div class="shop_list_product_descr">
				<h6 class="product-title"><a href="<?php the_permalink()?>"><?php the_title(); ?></a></h6>
				<span class="price"><?php echo $product->get_price_html(); ?></span>
			</div>

			<div class="hide">
			<?php
	}
}

if ( ! function_exists( 'cstheme_after_shop_loop_item' ) ) {
	function cstheme_after_shop_loop_item() {
		?>
			</div>
		</div>
		<?php
	}
}


/*
 *	Product: Get sale percentage
 */
function cstheme_product_get_sale_percent( $product ) {
	if ( $product->product_type === 'variable' ) {
		// Get product variation prices (regular and sale)
		$product_variation_prices = $product->get_variation_prices();
		
		$highest_sale_percent = 0;
		
		foreach( $product_variation_prices['regular_price'] as $key => $regular_price ) {
			// Get sale price for current variation
			$sale_price = $product_variation_prices['sale_price'][$key];
			
			// Is product variation on sale?
			if ( $sale_price < $regular_price ) {
				$sale_percent = round( ( ( $regular_price - $sale_price ) / $regular_price ) * 100 );
				
				// Is current sale percent highest?
				if ( $sale_percent > $highest_sale_percent ) {
					$highest_sale_percent = $sale_percent;
				}
			}
		}
		
		// Return the highest product variation sale percent
		return $highest_sale_percent;
	} else {
		$sale_percent = 0;
		
		// Make sure the percentage value can be calculated
		if ( intval( $product->regular_price ) > 0 ) {
			$sale_percent = round( ( ( $product->regular_price - $product->sale_price ) / $product->regular_price ) * 100 );
		}
		
		return $sale_percent;
	}
}


// Custom Shop Pagination
remove_action('woocommerce_after_shop_loop', 'woocommerce_pagination', 10);
add_action('woocommerce_after_shop_loop', 'cstheme_get_shop_pagination', 10);
if (!function_exists('cstheme_get_shop_pagination')) {	
	function cstheme_get_shop_pagination() {
		echo cstheme_pagination();
	}
}


/* Change Positions */
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title',5);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price',10);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt',20);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart',30);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta',40);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing',50);

add_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 10);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 30);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 40);	
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 50);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 60);


/* Product Single Share Buttons */
add_action('woocommerce_share','cstheme_wooshare');
function cstheme_wooshare(){
	
	global $post;

	$featured_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), false, '' );
?>
	
	<div class="cstheme_product_share">
		<span><?php echo esc_attr__('Share:', 'voyager'); ?></span>
		<a class="social_link facebook" href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&t=<?php the_title(); ?>" title="<?php esc_html_e( 'Facebook', 'voyager') ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><i class="fa fa-facebook"></i></a>
		<a class="social_link twitter" href="http://twitter.com/home?status=<?php the_title(); ?> <?php the_permalink(); ?>" title="<?php esc_html_e( 'Twitter', 'voyager') ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><i class="fa fa-twitter"></i></a>
		<a class="social_link pinterest" href="http://pinterest.com/pin/create/button/?url=<?php echo get_permalink(); ?>&media=<?php echo (strlen($featured_image_url[0]) > 0) ? $featured_image_url[0] : get_option( 'cstheme_logo' ); ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><i class="fa fa-pinterest-p"></i></a>
	</div>
	
<?php
}


/* Related Products on Single page */
function woo_related_products_limit() {
	global $product;
  
	$args = array(
		'post_type'             => 'product',
		'no_found_rows'         => 1,
		'posts_per_page'        => 4
	);
	return $args;
}
add_filter( 'woocommerce_related_products_args', 'woo_related_products_limit' );
?>