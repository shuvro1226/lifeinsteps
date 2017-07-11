<?php

$three_posts_after_slider_category 		= get_metabox( 'three_posts_after_slider_category' );
$three_posts_after_slider_orderby 		= get_metabox( 'three_posts_after_slider_orderby' );
?>

<div id="three_posts_after_slider">
	<div class="container">
		
		<?php
			
			$args = array(
				'post_type' 			=> 'post',
				'cat' 					=> ((isset($three_posts_after_slider_category) && $three_posts_after_slider_category) ? $three_posts_after_slider_category : 'all'),
				'orderby' 				=> ((isset($three_posts_after_slider_orderby) && $three_posts_after_slider_orderby) ? $three_posts_after_slider_orderby : 'date'),
				'posts_per_page' 		=> '3',
				'post_status' 			=> 'publish',
				'ignore_sticky_posts' 	=> 1
			);
			
		?>
			
		<div class="three_posts_after_slider_list row">
			
			<?php
				
				$i = 1;
				$my_query = new WP_Query($args);
				
				if( $my_query->have_posts() ) {
					
					while ($my_query->have_posts()) : $my_query->the_post();
					
					$featured_image_url = wp_get_attachment_url(get_post_thumbnail_id());
					
					if ( $i == 1 ) {
					?>
					
						<div class="col-md-6 mb30">
							<div class="three_posts_after_slider_item">
								<div class="featured_img_bg" 
									<?php if( ! empty( $featured_image_url ) ) { ?>
										style="background-image:url(<?php echo $featured_image_url ?>);"
									<?php } ?>
								></div>
								<span class="post_meta_category"><?php the_category(', '); ?></span>
								<span class="post-meta-comments"><i class="fa fa-comments"></i><?php echo get_comments_number(get_the_ID()); ?></span>
								<div class="post-descr-wrap">
									<span class="post-meta-date"><?php the_time('M j, Y') ?></span>
									<h2 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__('Permalink to %s', 'voyager'), the_title_attribute('echo=0') ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
								</div>
							</div>
						</div>
						
					<?php
					} else {
						
						$featured_image = '<img src="' . aq_resize( $featured_image_url, 380, 300, true, true, true ) . '" alt="' . get_the_title() . '" />';
						$voyager_post_excerpt = (cstheme_smarty_modifier_truncate(get_the_excerpt(), 100));
					?>
					
						<div class="col-md-3 col-sm-6 mb30">
							<div class="three_posts_after_slider_item">
								<?php if( !empty( $featured_image ) ) { ?>
									<div class="post_format_content">
										<span class="post_meta_category"><?php the_category(', '); ?></span>
										<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
											<?php echo $featured_image ?>
										</a>
									</div>
								<?php } ?>
								<div class="three_posts_after_slider_descr">
									<span class="post_meta_date"><?php the_time('M j, Y') ?></span>
									<h6 class="post_title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h6>
									<div class="post-content">
										<?php echo $voyager_post_excerpt; ?>
									</div>
								</div>
							</div>
						</div>
					
					<?php
					}
					
					$i++;
					endwhile;
					wp_reset_postdata();
					
				}
			?>
			
		</div>
	</div>
</div>