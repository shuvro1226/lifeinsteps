<div id="portfolio_related_list">
	<div class="text-center"><h2><?php echo esc_html__('Related Projects', 'voyager') ?></h2></div>
	<div class="owl-carousel clearfix">

		<?php
			
			global $post;
			
			$item_cats = get_the_terms( $post->ID, 'portfolio_category' );
		
			$item_array = array();
			if( $item_cats ) {
				foreach( $item_cats as $item_cat ) {
					$item_array[] = $item_cat->term_id;
				}
			}
			
			if ($item_cats) {

				$args = array(
					'post__not_in'   	=> array($post->ID),
					'posts_per_page' 	=> -1,
					'post_type'  		=> 'portfolio',
					'orderby' 			=> 'date',
					'order' 		 	=> 'DESC',
					'tax_query' => array(
								array(
									'field' 	=> 'id',
									'taxonomy' 	=> 'portfolio_category',
									'terms' 	=> $item_array,
								)
					)
				);
				
					$my_query = new WP_Query($args);
					if( $my_query->have_posts() ) {
						while ($my_query->have_posts()) : $my_query->the_post();
							
							$portfolio_category = get_the_term_list($post->ID, 'portfolio_category', '', ', ', '');
							$featured_image_url = wp_get_attachment_url(get_post_thumbnail_id());
							$featured_image = '<img src="' . aq_resize($featured_image_url, 370, 380, true, true, true) . '" alt="' . get_the_title() . '" />';
							
							echo '
								<div class="portfolio_content_wrapper clearfix">
									<div class="portfolio_format_content">';
										if( !empty( $featured_image_url ) ) {
											echo '<a href="' . get_permalink() . '">' . $featured_image . '<i class="fa fa-eye"></i></a>';
										} else {
											echo '<a class ="no_featured_img" href="' . get_permalink() . '">' . $no_featured_image . '<i class="fa fa-eye"></i></a>';
										}
									echo '</div>
									<div class="portfolio_descr_wrap clearfix">
										<span class="portfolio_likes heading_font">'; cstheme_likes(); echo '</span>
										<span class="portfolio_meta_category">' . strip_tags($portfolio_category) . '</span>
										<h2 class="portfolio-title"><a href="' . get_permalink( $post->ID ) . '">' . get_the_title() . '</a></h2>
									</div>
								</div>
							';
							
						endwhile;
						wp_reset_postdata();
					}
				
			}
		?>

	</div>
	<div class="portfolio_related_list_overlay"></div>
</div>

<script type="text/javascript">
	jQuery(window).load(function() {
		jQuery('#portfolio_related_list .owl-carousel').owlCarousel({
			margin: 30,
			dots: false,
			nav: false,
			loop: false,
			autoplay: true,
			autoplaySpeed: 1000,
			autoplayTimeout: 3000,
			navSpeed: 1000,
			autoplayHoverPause: true,
			responsive: {
				0: {items: 1},
				481: {items: 2},
				769: {items: 3},
				1025: {items: 4}
			},
			thumbs: false
		});
	});
</script>