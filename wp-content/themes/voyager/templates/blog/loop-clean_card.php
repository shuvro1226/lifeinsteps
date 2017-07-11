<?php
/**
 * The blog post
 */

global $post, $sidebar_layout, $authordata;

$voyager_pf = get_post_format();

$post_class = '';

$post_clean_card_size = get_metabox('voyager_post_clean_card_size');
$post_class .= !empty( $post_clean_card_size ) ? 'clean_card_' . $post_clean_card_size : '';

$voyager_date_format = 'M j, Y';

$width = 400;
$height = 400;
if( $sidebar_layout == 'left-sidebar' || $sidebar_layout == 'right-sidebar' ) {
	$width = 300;
	$height = 300;
}
$featured_image_url = wp_get_attachment_url(get_post_thumbnail_id());
$featured_image = '<img src="' . aq_resize( $featured_image_url, $width, $height, true, true, true ) . '" alt="' . get_the_title() . '" width="' . $width . '" height="' . $height . '" />';
$quote_text = get_post_meta($post->ID, 'format_quote_text', true);
$quote_author = get_post_meta($post->ID, 'format_quote_author', true);
$format_link_url = get_post_meta($post->ID, 'format_link_url', true);
$author_name = get_the_author_meta('display_name');
$author_roles = $authordata->roles;
$author_role = array_shift($author_roles);
?>
 
		<article <?php post_class( $post_class ); ?>>
			<div class="post_content_wrapper">
			
				<?php if($voyager_pf == 'quote') { ?>
					
					<div class="post_descr_wrap text-center">
						<i class="pf_quote heading_font theme_color">”</i>
						<h2 class="post_title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__('Permalink to %s', 'voyager'), the_title_attribute('echo=0') ); ?>" rel="bookmark">
							<?php if (!empty($quote_text)) {
								echo esc_attr( $quote_text );
							} else {
								the_title();
							} ?>
						</a></h2>
						<p class="pf_quote_author">
							<?php
								if ( !empty( $quote_author ) ) {
									echo esc_attr( $quote_author );
								} else {
									echo esc_html( $author_name );
								}
							?>
						</p>
					</div>
					
				<?php } elseif ($voyager_pf == 'link') { ?>
					
					<i class="pf_link fa fa-link theme_color"></i>
					<div class="post_descr_wrap">
						<span class="post_meta_date"><?php the_date( esc_html( $voyager_date_format ) ); ?></span>
						<h2 class="post_title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__('Permalink to %s', 'voyager'), the_title_attribute('echo=0') ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
					</div>
					<a class="pf_link_url" href="<?php
						if ( !empty( $format_link_url ) ) {
							echo esc_url( $format_link_url );
						} else {
							echo the_permalink();
						}
						?>" target="_blank"><?php
							if ( !empty( $format_link_url ) ) {
								echo esc_attr( $format_link_url );
							} else {
								echo esc_html( $author_name );
							}
					?></a>
					
				<?php } elseif ($voyager_pf == 'aside') { ?>
					
					<?php get_template_part( 'framework/post-format/post', 'twitter' ); ?>
					
				<?php } elseif ($voyager_pf == 'status') { ?>
					
					<?php
						
						$voyager_pf_instagram_username = strtolower( get_post_meta($post->ID, 'voyager_pf_instagram_username', true) );
						$voyager_pf_instagram_url = 'http://instagram.com/' . $voyager_pf_instagram_username;
					?>
					
					<div class="post_descr_wrap">
						<a class="pf__instagram_label" href="<?php echo $voyager_pf_instagram_url; ?>" target="_blank"><i class="fa fa-instagram"></i></a>
						<h2 class="post_title">
							<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__('Permalink to %s', 'voyager'), the_title_attribute('echo=0') ); ?>" rel="bookmark">
								<?php the_title(); ?>
							</a>
						</h2>
					</div>
					
					<?php get_template_part( 'framework/post-format/post', 'instagram' ); ?>
					
				<?php } else { ?>
					
					<?php if ($voyager_pf == 'gallery') { ?>
					
						<div class="pf_slider_wrap">
							<?php get_template_part( 'framework/post-format/post', 'gallery' ); ?>
						</div>
						
					<?php } elseif ($voyager_pf == 'video') { ?>
						
						<?php get_template_part( 'framework/post-format/post', 'video' ); ?>
						
					<?php } else { ?>
						
						<?php if( ! empty( $featured_image_url ) ) { ?>
							<div class="featured_img">
								<a class="post_permalink" href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__('Permalink to %s', 'voyager'), the_title_attribute('echo=0') ); ?>">
									<?php if ($voyager_pf == 'audio') {
										echo '<i class="pf_audio fa fa-music"></i>';
									} ?>
									<?php echo $featured_image; ?>
								</a>
							</div>
						<?php } ?>
					
					<?php } ?>
					
					<div class="post_descr_wrap">
						<span class="post_meta_category post_category_fontfamily"><?php the_category(', '); ?></span>
						<a class="post_meta_author" href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>">
							<?php echo get_avatar( get_the_author_meta('user_email'), '40', '' ) ?>
							<b><?php echo esc_html( $author_name ); ?></b>
							<span><?php echo $author_role; ?></span>
						</a>
						<span class="post_meta_date"><?php the_date( esc_html( $voyager_date_format ) ); ?></span>
						<h2 class="post_title">
							<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__('Permalink to %s', 'voyager'), the_title_attribute('echo=0') ); ?>" rel="bookmark">
								<?php the_title(); ?>
							</a>
						</h2>
						<div class="post-meta">
							<span class="post-meta-likes"><?php echo cstheme_likes(); ?></span>
							<span class="post-meta-comments"><i class="fa fa-comments"></i><?php echo get_comments_number(get_the_ID()); ?></span>
						</div>
					</div>
					
				<?php } ?>
			
			</div>
		</article>