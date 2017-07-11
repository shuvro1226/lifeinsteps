<?php
/**
 * The blog post content
 */

global $post, $sidebar_layout;

$post_format = get_post_format();

$width = 600;
$height = 470;
$post_excerpt_count = 430;
if( $sidebar_layout == 'left-sidebar' || $sidebar_layout == 'right-sidebar' ) {
	$width = 450;
	$height = 340;
	$post_excerpt_count = 160;
}
$featured_image_url = wp_get_attachment_url(get_post_thumbnail_id());
$featured_image = '<img src="' . aq_resize(wp_get_attachment_url(get_post_thumbnail_id()), $width, $height, true, true, true) . '" alt="' . get_the_title() . '" />';
$post_excerpt = (cstheme_smarty_modifier_truncate(get_the_excerpt(), $post_excerpt_count));
$quote_text = get_post_meta($post->ID, 'format_quote_text', true);
$quote_author = get_post_meta($post->ID, 'format_quote_author', true);
$format_link_url = get_post_meta($post->ID, 'format_link_url', true);
?>
 
		<article id="post-<?php the_ID(); ?>" <?php post_class('col-md-12'); ?>>
			<div class="post-content-wrapper clearfix">
			
				<?php if($post_format == 'quote') { ?>
					
					<div class="post-content-quote-wrapper">
						<div class="featured_img_bg" 
							<?php if(has_post_thumbnail()) { ?>
								style="background-image:url(<?php echo $featured_image_url ?>);"
							<?php } ?>
						></div>
						<div class="quote-format-wrap text-center">
							<i class="heading_font">”</i>
							<span class="post-meta-date"><?php the_time('M j, Y') ?></span>
							<h2 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__('Permalink to %s', 'voyager'), the_title_attribute('echo=0') ); ?>" rel="bookmark">
								<?php if (!empty($quote_text)) {
									echo esc_attr( $quote_text );
								} else {
									the_title();
								} ?>
							</a></h2>
							<span class="quote-author"><?php echo esc_attr__( 'Say', 'voyager' ); ?></span>
							<p class="quote-author-name heading_font">
								<?php
									if ( !empty( $quote_author ) ) {
										echo esc_attr( $quote_author );
									} else {
										echo get_the_author_meta('display_name');
									}
								?>
							</p>
						</div>
						<div class="overlay_border"></div>
					</div>
					
				<?php } elseif ($post_format == 'link') { ?>
					
					<div class="post-content-link-wrapper">
						<div class="featured_img_bg" 
							<?php if(has_post_thumbnail()) { ?>
								style="background-image:url(<?php echo $featured_image_url ?>);"
							<?php } ?>
						></div>
						<div class="link-format-wrap text-center">
							<i class="fa fa-link"></i>
							<span class="post-meta-date"><?php the_time('M j, Y') ?></span>
							<h2 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__('Permalink to %s', 'voyager'), the_title_attribute('echo=0') ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
							<a class="post-format-link-url heading_font" href="
								<?php
									if ( !empty( $format_link_url ) ) {
										echo esc_url( $format_link_url );
									} else {
										echo the_permalink();
									}
								?>
							"  target="_blank">
								<?php
									if ( !empty( $format_link_url ) ) {
										echo esc_attr( $format_link_url );
									} else {
										echo get_the_author_meta('display_name');
									}
								?>
							</a>
						</div>
						<div class="overlay_border"></div>
					</div>
					
				<?php } else { ?>
					
					<div class="row">
					<?php if(has_post_thumbnail()) { ?>
						<div class="col-md-6">
							<div class="post_format_content">
								<span class="post-meta-likes"><?php echo cstheme_likes(); ?></span>
								<?php echo '<a href="' . get_permalink() . '">' . $featured_image . '</a>'; ?>
							</div>
						</div>
						<div class="col-md-6">
					<?php } else { ?>
						<div class="col-md-12">
					<?php } ?>
							<div class="post-descr-wrap clearfix">
								<div class="post-meta clearfix">
									<span class="post_meta_category"><?php the_category(', '); ?></span>
									<span class="post-meta-date"><?php the_time('M j, Y') ?></span>
									<span class="post-meta-comments"><i class="fa fa-comments"></i><?php echo get_comments_number(get_the_ID()); ?></span>
								</div>
								<h2 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__('Permalink to %s', 'voyager'), the_title_attribute('echo=0') ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
								<div class="post-content clearfix">
									<p><?php echo $post_excerpt ?></p>
								</div>
								<a class="post_content_readmore heading_font" href="<?php echo get_permalink() ?>"><?php echo esc_html__('Read More','voyager') ?><i class="fa fa-chevron-right"></i></a>
							</div>
						</div>
					</div>
					
				<?php } ?>
			
			</div>
		</article>