<?php
/**
 * The template for displaying search results pages.
 */

get_header();

$sidebar_layout = cstheme_option( 'sidebar_layout' );
if( $sidebar_layout == 'left-sidebar' ) {
	$sidebar_class = 'pull-left ';
	$blog_list_wrap_class = 'left_sidebar ';
	$blog_list_class = 'col-md-9 pull-right';
} elseif( $sidebar_layout == 'right-sidebar' ) {
	$sidebar_class = 'pull-right';
	$blog_list_wrap_class = 'right_sidebar ';
	$blog_list_class = 'col-md-9 pull-left ';
} else {
	$sidebar_class = $blog_list_class = '';
	$blog_list_wrap_class = 'no_sidebar ';
}
?>

		<div id="blog_list" class="container blog_list_style_default search-result-list mt0 <?php echo $blog_list_wrap_class ?>">
			<div class="page_title text-center">
				<h1><?php printf( esc_html__( 'Search Results for: %s', 'voyager' ), get_search_query() ); ?></h1>
			</div>
			<div class="row">
			
			<?php
			if( $sidebar_layout == 'left-sidebar' || $sidebar_layout == 'right-sidebar' ) {
			echo '
				<div class="' . $blog_list_class . '">
					<div class="row">
				';
			}
			?>

						<?php

							if (have_posts ()) {
								
								while (have_posts ()) : the_post();
									
									$post_excerpt = (cstheme_smarty_modifier_truncate(get_the_excerpt(), 250));
									$featured_image_url = wp_get_attachment_url(get_post_thumbnail_id());
									$featured_image = '<img src="' . aq_resize( $featured_image_url, 300, 220, true, true, true ) . '" alt="' . get_the_title() . '" />';
								?>

									<article id="post-<?php the_ID(); ?>" <?php post_class( 'col-md-12' ); ?>>
										<div class="post-content-wrapper clearfix">
											<?php if( !empty( $featured_image_url )) { echo '<a class="featured_image" href="' . get_permalink() . '">' . $featured_image . '</a>'; } ?>
											<div class="post-descr-wrap">
												<div class="post-meta">
													<?php if ( has_category() ) { ?>
														<span class="blog_meta_category"><?php the_category(', '); ?></span>
													<?php } ?>
													<span class="post-meta-date"><?php the_time('M j, Y') ?></span>
												</div>
												<h2 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__('Permalink to %s', 'voyager'), the_title_attribute('echo=0') ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
												<div class="post-content clearfix">
													<p><?php echo $post_excerpt ?></p>
												</div>
												<a class="post_content_readmore" href="<?php echo get_permalink() ?>"><?php echo esc_html__('Read More','voyager') ?></a>
											</div>
										</div>
									</article>

								<?php endwhile; ?>
								
								<?php wp_reset_postdata(); ?>
								
							<?php

							} else {

							?>
								<div id="error404-container">
									<h4 class="error404"><?php esc_html_e('Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'voyager');?></h4>
								</div>
								
							<?php }

								
								
							?>
					
			<?php
			if( $sidebar_layout == 'left-sidebar' || $sidebar_layout == 'right-sidebar' ) {
			echo '
					</div>
				';
					
					cstheme_pagination();
			
			echo '
				</div>
				';
			}
			?>
				
				<?php if( $sidebar_layout == 'left-sidebar' || $sidebar_layout == 'right-sidebar' ) { ?>
					<div class="col-md-3 <?php echo $sidebar_class ?>">
						<?php get_sidebar(); ?>
					</div>
				<?php } ?>
				
			</div>
		</div>

<?php get_footer(); ?>