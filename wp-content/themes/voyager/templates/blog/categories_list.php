<?php
/**
 * The Posts Categories List with Thumbnails
 */

global $post, $categories_list_position;

$categories_style 		= get_metabox('categories_style');
$categories_filter_ids 	= get_metabox('categories_filter_ids');
?>
		
		<div id="categories_list" class="position_<?php echo $categories_list_position . ' ' . $categories_style ?>">
			<div class="container">
					
				<?php if ( $categories_style != 'grid' ) { ?>
				
					<div class="categories_carousel owl-carousel">
					
				<?php } else { ?>
				
					<div class="categories_grid clearfix">
					
				<?php } ?>
				
						<?php foreach (get_categories( array( 'include' => esc_html( $categories_filter_ids ) ) ) as $cat) : ?>
							<div class="item">
								<a href="<?php echo esc_url( get_category_link($cat->term_id) ); ?>">
									<?php $featured_image_url =  z_taxonomy_image_url($cat->term_id); ?>
									<img src="<?php echo aq_resize( $featured_image_url, 300, 200, true, true, true ) ?>" alt="" />
									<div class="categories_item_descr">
										<span class="heading_font"><?php echo $cat->cat_name; ?></span>
										<p><?php echo esc_html__('All posts','voyager'); ?></p>
									</div>
									<span class="overlay_border"></span>
								</a>
							</div>
						<?php endforeach; ?>
					</div>
			</div>
		</div>