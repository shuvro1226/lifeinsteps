<?php
/**
 * The template for displaying all single portfolio posts and attachments
 */

get_header();
the_post();

global $post;

$post_format = get_post_format();
if (empty($post_format)) $post_format = "standard";

$portfolio_single_layout 		= get_metabox('portfolio_single_layout');
$portfolio_single_client 		= get_metabox('portfolio_single_client');
$portfolio_single_url 			= get_metabox('portfolio_single_url');

// Categories
$portfolio_category = get_the_term_list($post->ID, 'portfolio_category', '', ', ', '');

/* ADD 1 view for this post */
$post_views = (get_post_meta(get_the_ID(), "post_views", true) > 0 ? get_post_meta(get_the_ID(), "post_views", true) : "0");
update_post_meta(get_the_ID(), "post_views", (int)$post_views + 1);
?>
		
		<div class="container">
			<div id="portfolio_single_wrap" class="<?php echo 'format-'.$post_format; ?> clearfix">
				
				<?php if(cstheme_option('portfolio_single_navigation') != 0) { ?>
					<div class="portfolio_single_nav clearfix">
						<?php
							$prev_post = get_adjacent_post(false, '', true);
							$next_post = get_adjacent_post(false, '', false);

							if($prev_post){
								$post_url = get_permalink($prev_post->ID);            
								echo '<div class="pull-left"><a href="' . esc_url( $post_url ) . '" title="' . $prev_post->post_title . '"><p class="heading_font"><i class="fa fa-chevron-left"></i>' . esc_html__('Previous','voyager') . '</p><b>' . $prev_post->post_title . '</b></a></div>';
							}

							if($next_post) {
								$post_url = get_permalink($next_post->ID);            
								echo '<div class="pull-right text-right"><a href="' . esc_url( $post_url ) . '" title="' . $next_post->post_title . '"><p class="heading_font">' . esc_html__('Next','voyager') . '<i class="fa fa-chevron-right"></i></p><b>' . $next_post->post_title . '</b></a></div>';
							} 
						?>
					</div>
				<?php } ?>
				
				<div class="row">
					
					<?php if( $portfolio_single_layout != 'full' ) { ?>
						<div class="col-md-8">
					<?php } else { ?>
						<div class="col-md-12">
					<?php } ?>
				
							<div class="portfolio_format_content mb55">
								<?php get_template_part( 'templates/portfolio/post-format/post', $post_format ); ?>
							</div>
						</div>
						
						<div class="col-md-4 <?php if( $portfolio_single_layout != 'half' ) { echo 'pull-right'; } ?>">
							<div class="portfolio_single_details_wrap mb55">
								<?php if( $portfolio_single_layout != 'full' ) { ?>
									<div class="portfolio_single_likes"><?php echo cstheme_likes(); ?></div>
									<h2 class="portfolio_single_title"><?php the_title(); ?></h2>
								<?php } ?>
								<?php if( !empty( $portfolio_category ) ) { ?>
									<div class="portfolio_single_det">
										<p><strong><?php esc_html_e('Category:', 'voyager') ?></strong>
										<span class="portfolio-category">
											<?php echo strip_tags($portfolio_category) ?>
										</span></p>
									</div>
								<?php } ?>
								<?php if( isset( $portfolio_single_client ) && $portfolio_single_client != '' ) { ?>
									<div class="portfolio_single_det">
										<p><strong><?php esc_html_e('Client:', 'voyager') ?></strong>
										<span class="portfolio-client">
											<?php echo esc_attr( $portfolio_single_client ); ?>
										</span></p>
									</div>
								<?php } ?>
								<div class="portfolio_single_det">
									<p><strong><?php esc_html_e('Date:', 'voyager') ?></strong>
									<span class="portfolio-date">
										<?php the_time('M j, Y') ?>
									</span></p>
								</div>
								<?php if(get_the_term_list($post->ID, 'portfolio_tag', '', ',', '')) { ?>
									<div class="portfolio_single_det">
										<p><strong><?php esc_html_e('Tags:', 'voyager') ?></strong>
										<span class="portfolio-tag">
											<?php echo get_the_term_list($post->ID, 'portfolio_tag', '', ', ', ''); ?>
										</span></p>
									</div>
								<?php } ?>
								<?php if( isset( $portfolio_single_url ) && $portfolio_single_url != '' ) { ?>
									<div class="portfolio_single_det">
										<p><strong><?php esc_html_e('Project URL:', 'voyager') ?></strong>
										<span class="portfolio-custom-link">
											<a href="<?php echo esc_url( $portfolio_single_url ); ?>" target="_blank"><?php echo esc_attr( $portfolio_single_url ); ?></a>
										</span></p>
									</div>
								<?php } ?>
							</div>
								
					<?php if( $portfolio_single_layout != 'half' ) { ?>
						</div>
						<div class="col-md-8 pull-left">
					<?php } ?>
							<div class="portfolio_single_descr_wrap mb55">
								<?php if( $portfolio_single_layout != 'half' ) { ?>
									<div class="portfolio_single_likes"><?php echo cstheme_likes(); ?></div>
									<h2 class="portfolio_single_title"><?php the_title(); ?></h2>
								<?php } ?>
								<div class="portfolio_single_content clearfix">
									
									<?php
										the_content(esc_html__('Read more!', 'voyager'));
										wp_link_pages(array('before' => '<div class="page-link">' . esc_html__('Pages', 'voyager') . ': ', 'after' => '</div>'));
									?>
									
								</div>
								<div class="portfolio_single_sharebox">
									<?php if(cstheme_option('portfolio_single_sharebox') != 0) { get_template_part( 'templates/portfolio/sharebox' ); } ?>
								</div>
							</div>
						</div>
				</div>
				
				<?php if(cstheme_option('portfolio_single_relatedposts') != 0) { get_template_part('templates/portfolio/related-portfolios'); } ?>
				
			</div>
		</div>

<?php get_footer(); ?>
