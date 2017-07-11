<?php

global $posts_carousel_position;

$posts_carousel_style 		= get_metabox( 'posts_carousel_style' );
$posts_carousel_title 		= get_metabox( 'posts_carousel_title' );
$posts_carousel_cat 		= get_metabox( 'posts_carousel_cat' );
$posts_carousel_orderby 	= get_metabox( 'posts_carousel_orderby' );
$posts_carousel_count 		= get_metabox( 'posts_carousel_count' );
?>

<div id="posts_carousel" class="position_<?php echo $posts_carousel_position ?>">
	<div class="container <?php if(!empty( $posts_carousel_title ) ) { echo 'with_title'; } ?>">
	
		<?php if(!empty( $posts_carousel_title ) ) { echo '<div class="text-center"><h2 class="posts_carousel_title">'. esc_attr( $posts_carousel_title ) .'</h2></div>'; } ?>
		
		<?php
			
			$args = array(
				'post_type' 		=> 'post',
				'cat' 				=> ((isset($posts_carousel_cat) && $posts_carousel_cat) ? $posts_carousel_cat : 'all'),
				'orderby' 			=> ((isset($posts_carousel_orderby) && $posts_carousel_orderby) ? $posts_carousel_orderby : 'date'),
				'posts_per_page' 	=> ((isset($posts_carousel_count) && $posts_carousel_count) ? $posts_carousel_count : '6'),
				'post_status' 		=> 'publish'
			);
			
		?>
			
		<div class="posts_carousel_list owl-carousel clearfix">
			
			<?php
				$my_query = new WP_Query($args);
				
				if( $my_query->have_posts() ) {
					
					while ($my_query->have_posts()) : $my_query->the_post();
					
					$voyager_pf 			= get_post_format();
					$featured_image_url 	= wp_get_attachment_url(get_post_thumbnail_id());
					$featured_image 		= '<img src="' . aq_resize( $featured_image_url, 300, 180, true, true, true ) . '" alt="' . get_the_title() . '" />';
					?>
					
						<?php if ( isset( $posts_carousel_style ) && $posts_carousel_style == 'bg_image' ) { ?>
							
							<?php
								
								$pf_label = '';
								if ( $voyager_pf == 'audio' ) {
									$pf_label = 'fa fa-music';
								} else if ( $voyager_pf == 'link' ) {
									$pf_label = 'fa fa-link';
								} else if ( $voyager_pf == 'quote' ) {
									$pf_label = 'fa fa-quote-right';
								} else if ( $voyager_pf == 'video' ) {
									$pf_label = 'fa fa-play';
								} else {
									$pf_label = 'fa fa-image';
								}
								
							?>
							
							<div class="item bg_image">
								<div class="posts_carousel_item">
									<div class="featured_img_bg" 
										<?php if(has_post_thumbnail()) { ?>
											style="background-image:url(<?php echo $featured_image_url ?>);"
										<?php } ?>
									></div>
									<span class="post_meta_label"><i class="<?php echo esc_html( $pf_label ); ?>"></i></span>
									<div class="post-descr-wrap">
										<h2 class="post-title">
											<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__('Permalink to %s', 'voyager'), the_title_attribute('echo=0') ); ?>" rel="bookmark"><?php the_title(); ?></a>
										</h2>
										<div class="post_meta">
											<span class="post_meta_category"><?php the_category(', '); ?></span>
											<span class="post-meta-date"><?php the_time('M j, Y') ?></span>
											<span class="post-meta-comments"><i class="fa fa-comments"></i><?php echo get_comments_number(get_the_ID()); ?></span>
										</div>
									</div>
								</div>
							</div>
							
						<?php } else { ?>
							
							<div class="item top_image">
								<div class="posts_carousel_item">
									<?php if( !empty( $featured_image ) ) { ?>
										<a class="post_format_content" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo $featured_image ?></a>
									<?php } else {?>
										<a class="post_format_content no-image" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">No Image</a>
									<?php } ?>
									<div class="posts_carousel_descr">
										<span class="posts_carousel_meta_date"><?php the_time('M j, Y') ?></span>
										<h6 class="posts_carousel_title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h6>
									</div>
								</div>
							</div>
							
						<?php } ?>
						
					<?php
					endwhile;
					wp_reset_postdata();
					
				}
			?>
			
		</div>
	</div>
	<div class="posts_carousel_overlay"></div>
</div>

<script type="text/javascript">
	jQuery(window).load(function() {
		jQuery('.posts_carousel_list.owl-carousel').owlCarousel({
			margin: 30,
			dots: false,
			nav: true,
			navText: [
				"<i class='fa fa-chevron-left'></i>",
				"<i class='fa fa-chevron-right'></i>"
			],
			loop: true,
			autoplay: true,
			autoplaySpeed: 1000,
			autoplayTimeout: 3000,
			navSpeed: 1000,
			autoplayHoverPause: true,
			responsive: {
				0: {items: 1},
				480: {items: 2},
				
				<?php if ( isset( $posts_carousel_style ) && $posts_carousel_style == 'bg_image' ) { ?>
					
					481: {items: 2},
					769: {items: 2},
					960: {items: 3},
					
				<?php } else { ?>
				
					481: {items: 3},
					769: {items: 3},
					960: {items: 4},
					
				<?php } ?>
			},
			thumbs: false
		});
	});
</script>