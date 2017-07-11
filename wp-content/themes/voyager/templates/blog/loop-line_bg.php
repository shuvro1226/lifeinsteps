<?php
/**
 * The blog post content
 */

global $post;

$post_format = get_post_format();
$featured_image_url = wp_get_attachment_url(get_post_thumbnail_id());
$post_excerpt = (cstheme_smarty_modifier_truncate(get_the_excerpt(), 145));
?>
 
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="post-content-wrapper clearfix">
				<div class="featured_img_bg" 
					<?php if(!empty($featured_image_url)) { ?>
						style="background-image:url(<?php echo $featured_image_url ?>);"
					<?php } ?>
				></div>
				<div class="container">
					<div class="post-descr-wrap row">
						<div class="col-md-6">
							<span class="post_meta_category"><?php the_category(', '); ?></span>
							<h2 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__('Permalink to %s', 'voyager'), the_title_attribute('echo=0') ); ?>" rel="bookmark">
								<?php if($post_format == 'quote') { ?>
									<?php if (!empty($quote_text)) { ?>
										<?php echo esc_attr( $quote_text ); ?>
									<?php } else { ?>
										<?php the_title(); ?>
									<?php } ?>
								<?php } else {  ?>
									<?php the_title(); ?>
								<?php } ?>
							</a></h2>
							<div class="post-meta">
								<span class="post-meta-date"><?php the_time('M j, Y') ?></span>
								<span class="post-meta-comments"><i class="fa fa-comments"></i><?php echo get_comments_number(get_the_ID()); ?></span>
							</div>
						</div>
						<div class="col-md-4 pull-right">
							<div class="post-content">
								<p><?php echo $post_excerpt ?></p>
							</div>
							<div class="read_more_wrap text-center"><a class="read_more btn btn-white" href="<?php the_permalink(); ?>"><?php echo esc_html__('Read More','voyager') ?></a></div>
						</div>
					</div>
				</div>
			</div>
		</article>