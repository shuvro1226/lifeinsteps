<?php
/**
 * The blog post content
 */

global $post;

$width = 220;
$height = 157;
$featured_image_url = wp_get_attachment_url(get_post_thumbnail_id());
$featured_image = '<img src="' . aq_resize($featured_image_url, $width, $height, true, true, true) . '" alt="' . get_the_title() . '" />';
?>
 
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="post-content-wrapper">
				<div class="container">
					<div class="post-descr-wrap clearfix">
						<div class="post-meta">
							<span class="post_meta_category"><?php the_category(', '); ?></span>
							<span class="post-meta-date"><?php the_time('M j, Y') ?></span>
							<span class="post-meta-likes"><?php echo cstheme_likes(); ?></span>
							<span class="post-meta-comments"><i class="fa fa-comments"></i><?php echo get_comments_number(get_the_ID()); ?></span>
						</div>
						<?php if( !empty( $featured_image_url ) ) { ?>
							<div class="post_format_content">
								<?php echo '<a href="' . get_permalink() . '">' . $featured_image . '</a>'; ?>
							</div>
						<?php } ?>
						<h2 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__('Permalink to %s', 'voyager'), the_title_attribute('echo=0') ); ?>" rel="bookmark">
							<?php the_title(); ?>
						</a></h2>
					</div>
				</div>
				<div class="line_thumb_overlay"></div>
			</div>
		</article>