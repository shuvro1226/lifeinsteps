<?php

$single_post_relatedposts_style = cstheme_option('single_post_relatedposts_style');
?>

<div id="related_posts_list">
	<div class="text-center"><h2><?php echo esc_html__('You Might Also Like', 'voyager') ?></h2></div>
	<div class="<?php if ( $single_post_relatedposts_style == 'carousel' ) { echo 'owl-carousel'; } else { echo 'row';} ?> clearfix">

		<?php
			
			global $post;
			
			$categories = get_the_category($post->ID);
			$posts_per_page = 2;
			
			if ( $single_post_relatedposts_style == 'carousel' ) {
				$posts_per_page = 4;
			}
			
			if ($categories) {

				$category_ids = array();

				foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
				
				$args = array(
					'category__in'     => $category_ids,
					'post__not_in'     => array($post->ID),
					'posts_per_page'   => $posts_per_page,
					'ignore_sticky_posts' => 1,
					'orderby' => 'rand'
				);
				
					$my_query = new WP_Query($args);
					if( $my_query->have_posts() ) {
						while ($my_query->have_posts()) : $my_query->the_post();
							
							if ( $single_post_relatedposts_style == 'carousel' ) {
								
								$featured_image_url = wp_get_attachment_url(get_post_thumbnail_id());
								$featured_image = '<img src="' . aq_resize($featured_image_url, 300, 180, true, true, true) . '" alt="' . get_the_title() . '" />';
								
								echo '
									<div class="item">
										<div class="posts_carousel_wrap clearfix">
											<div class="post_format_content">
									';
												if( !empty( $featured_image ) ) {
													echo '<a href="' . get_permalink() . '">' . $featured_image . '</a>';
												} else {
													echo '<a class ="no_featured_img" href="' . get_permalink() . '">' . $no_featured_image . '</a>';
												}
										echo '
											</div>
											<div class="posts_carousel_content">
												<span class="post-meta-date">' . get_the_time('M j, Y') . '</span>
												<h2 class="post-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>
											</div>
										</div>
									</div>
								';
							} else {
								get_template_part('templates/blog/loop-grid-bg');
							}
							
						endwhile;
						wp_reset_postdata();
					}
				
			}
		?>

	</div>
	<div class="related_posts_list_overlay"></div>
</div>