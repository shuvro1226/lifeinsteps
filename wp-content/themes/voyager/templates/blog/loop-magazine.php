<?php
/**
 * The blog post content
 */

$magazine_count_blocks 					= get_metabox( 'magazine_count_blocks' );
$blog_list_category 					= get_metabox('blog_list_category');
$blog_list_category_magazine_block2 	= get_metabox('blog_list_category_magazine_block2');
$posts_per_page 						= get_metabox('posts_per_page');
$posts_per_page_magazine_block2 		= get_metabox('posts_per_page_magazine_block2');
$magazine_style_orderby 				= get_metabox( 'magazine_style_orderby' );
$magazine_style_orderby_block2 			= get_metabox( 'magazine_style_orderby_block2' );

$sidebar_layout = get_metabox( 'sidebar_layout' );
if( $sidebar_layout == 'left-sidebar' ) {
	$sidebar_class = 'pull-left ';
	$blog_list_wrap_class = 'left_sidebar ';
	$blog_list_class = 'col-md-9 pull-right';
} elseif( $sidebar_layout == 'right-sidebar' ) {
	$sidebar_class = 'pull-right';
	$blog_list_wrap_class = 'right_sidebar ';
	$blog_list_class = 'col-md-9 pull-left ';
} else {
	$sidebar_class = '';
	$blog_list_class = 'col-md-12';
	$blog_list_wrap_class = 'no_sidebar ';
}
?>

	<div id="blog_list" class="style_magazine <?php echo esc_html( $blog_list_wrap_class ); ?>">
		<div class="container">
			<div class="row">	
			
				<div class="<?php echo esc_html( $blog_list_class ); ?>">
				
					<div class="row">
						
						<?php
							
							if ( get_query_var('paged') ) { $paged = get_query_var('paged'); } else if ( get_query_var('page') ) {$paged = get_query_var('page'); } else {$paged = 1; }
							$i = 1;
							
							$args = array(
								'post_type' 		=> 'post',
								'cat' 				=> ((isset($blog_list_category) && $blog_list_category) ? $blog_list_category : 'all'),
								'orderby' 			=> ((isset($magazine_style_orderby) && $magazine_style_orderby) ? $magazine_style_orderby : 'date'),
								'posts_per_page' 	=> ((isset($posts_per_page) && $posts_per_page) ? $posts_per_page : '5'),
								'paged' 			=> $paged,
								'post_status' 		=> 'publish'
							);
							$my_query = new WP_Query($args);
							
							if( $my_query->have_posts() ) {
								
								while ($my_query->have_posts()) : $my_query->the_post();
								
								$featured_image_url = wp_get_attachment_url(get_post_thumbnail_id());
								
								if ( $i == 1 ) {
								?>
								
									<article id="post-<?php the_ID(); ?>" <?php post_class('col-md-12 mb30 post_big'); ?>>
										<div class="post-content-wrapper clearfix">
											<div class="featured_img_bg" 
												<?php if( ! empty( $featured_image_url ) ) { ?>
													style="background-image:url(<?php echo $featured_image_url ?>);"
												<?php } ?>
											></div>
											<div class="post_author">
												<span><?php echo esc_html__('posted by','voyager'); ?></span>
												<h6><a class="post_author_name" href="<?php get_author_posts_url(get_the_author_meta( 'ID' )); ?>"><?php the_author(); ?></a></h6>
											</div>
											<span class="post-meta-comments"><i class="fa fa-comments"></i><?php echo get_comments_number(get_the_ID()); ?></span>
											<div class="post-descr-wrap">
												<span class="post_meta_category"><?php the_category(', '); ?></span>
												<h2 class="post_title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__('Permalink to %s', 'voyager'), the_title_attribute('echo=0') ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
											</div>
										</div>
									</article>
									
								<?php
								} else {
									
									$featured_image = '<img src="' . aq_resize( $featured_image_url, 410, 320, true, true, true ) . '" alt="' . get_the_title() . '" />';
									
								?>
								
									<article id="post-<?php the_ID(); ?>" <?php post_class('col-md-6 col-sm-6 post_small'); ?>>
										<div class="post-content-wrapper row">
											<?php if( !empty( $featured_image_url ) ) { ?>
												<div class="col-md-6 mb30">
													<div class="post_format_content">
														<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
															<?php echo $featured_image; ?>
														</a>
													</div>
												</div>
											<?php } ?>
											<?php if( !empty( $featured_image_url ) ) { ?>
												<div class="col-md-6 mb30">
											<?php } else { ?>
												<div class="col-md-12 mb30">
											<?php } ?>
													<div class="post_descr">
														<span class="post_meta_date"><?php the_time('M j, Y') ?></span>
														<h6 class="post_title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h6>
													</div>
												</div>
										</div>
									</article>
								
								<?php
								}
								
								$i++;
								endwhile;
								wp_reset_postdata();
								
							}
						?>
						
					</div>
					
					<?php
				
						$bloglist_banner2 = get_metabox('bloglist_banner2');
						
						if ( isset( $bloglist_banner2 ) && $bloglist_banner2 != '' ) {
							echo apply_filters("the_content", htmlspecialchars_decode($bloglist_banner2));
						}
					?>
					
					<?php if ( $magazine_count_blocks == '2' ) { ?>
						
						<div class="row magazine_block2">
						
							<?php
								
								if ( get_query_var('paged') ) { $paged = get_query_var('paged'); } else if ( get_query_var('page') ) {$paged = get_query_var('page'); } else {$paged = 1; }
								$i = 1;
								
								$args = array(
									'post_type' 		=> 'post',
									'cat' 				=> ((isset($blog_list_category_magazine_block2) && $blog_list_category_magazine_block2) ? $blog_list_category_magazine_block2 : 'all'),
									'orderby' 			=> ((isset($magazine_style_orderby_block2) && $magazine_style_orderby_block2) ? $magazine_style_orderby_block2 : 'date'),
									'posts_per_page' 	=> ((isset($posts_per_page_magazine_block2) && $posts_per_page_magazine_block2) ? $posts_per_page_magazine_block2 : '5'),
									'paged' 			=> $paged,
									'post_status' 		=> 'publish'
								);
								$my_query = new WP_Query($args);
								
								if( $my_query->have_posts() ) {
									
									while ($my_query->have_posts()) : $my_query->the_post();
									
									$featured_image_url = wp_get_attachment_url(get_post_thumbnail_id());
									
									if ( $i == 1 ) {
									?>
									
										<article id="post-<?php the_ID(); ?>" <?php post_class('col-md-12 mb30 post_big'); ?>>
											<div class="post-content-wrapper clearfix">
												<div class="featured_img_bg" 
													<?php if( ! empty( $featured_image_url ) ) { ?>
														style="background-image:url(<?php echo $featured_image_url ?>);"
													<?php } ?>
												></div>
												<div class="post_author">
													<span><?php echo esc_html__('posted by','voyager'); ?></span>
													<h6><a class="post_author_name" href="<?php get_author_posts_url(get_the_author_meta( 'ID' )); ?>"><?php the_author(); ?></a></h6>
												</div>
												<span class="post-meta-comments"><i class="fa fa-comments"></i><?php echo get_comments_number(get_the_ID()); ?></span>
												<div class="post-descr-wrap">
													<span class="post_meta_category"><?php the_category(', '); ?></span>
													<h2 class="post_title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__('Permalink to %s', 'voyager'), the_title_attribute('echo=0') ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
												</div>
											</div>
										</article>
										
									<?php
									} else {
										
										$featured_image = '<img src="' . aq_resize( $featured_image_url, 410, 320, true, true, true ) . '" alt="' . get_the_title() . '" />';
										
									?>
									
										<article id="post-<?php the_ID(); ?>" <?php post_class('col-md-6 col-sm-6 post_small'); ?>>
											<div class="post-content-wrapper row">
												<?php if( !empty( $featured_image_url ) ) { ?>
													<div class="col-md-6 mb30">
														<div class="post_format_content">
															<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
																<?php echo $featured_image; ?>
															</a>
														</div>
													</div>
												<?php } ?>
												<?php if( !empty( $featured_image_url ) ) { ?>
													<div class="col-md-6 mb30">
												<?php } else { ?>
													<div class="col-md-12 mb30">
												<?php } ?>
														<div class="post_descr">
															<span class="post_meta_date"><?php the_time('M j, Y') ?></span>
															<h6 class="post_title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h6>
														</div>
													</div>
											</div>
										</article>
									
									<?php
									}
									
									$i++;
									endwhile;
									wp_reset_postdata();
									
								}
							?>
							
						</div>
						
					<?php } ?>
					
				</div>
					
				<?php if ( $sidebar_layout == 'left-sidebar' || $sidebar_layout == 'right-sidebar' ) { ?>
					
					<div class="col-md-3 <?php echo esc_html( $sidebar_class ); ?>">

						<?php get_sidebar(); ?>
					
					</div>
				
				<?php } ?>
				
				
				
			</div>
		</div>
	</div>