<?php

global $post, $blog_list_style;

$postid = get_the_ID();

$blog_list_layout = get_metabox('blog_list_layout');
$sidebar_layout = cstheme_option( 'sidebar_layout' );
if( $sidebar_layout == 'left-sidebar' || $sidebar_layout == 'right-sidebar' && $blog_list_style != 'clean_card' ) {
	$width = 870;
	$height = 520;
} elseif ($blog_list_style == 'clean_card') {
	if ( $blog_list_layout == 'container' ) {
		$width = 370;
		$height = 370;
	} else {
		$width = 404;
		$height = 405;
	}
} else {
	$width = 1170;
	$height = 700;
}

$unique_id = uniqid('post_gallery');
$gallery_image_ids = get_post_meta($post->ID, 'gallery_image_ids', true);

if (!empty($gallery_image_ids)) {
	$my_posts_image_gallery = get_post_meta($postid, 'gallery_image_ids', true);
} else {
	// Backwards compat
	$attachment_ids = get_posts('post_parent=' . $postid . '&numberposts=-1&post_type=attachment&orderby=menu_order&order=ASC&post_mime_type=image&fields=ids');
	$attachment_ids = array_diff($attachment_ids, array(get_post_thumbnail_id()));
	$my_posts_image_gallery = implode(',', $attachment_ids);
}

$attachments = array_filter(explode(',', $my_posts_image_gallery));

    if ($attachments) {
        echo '<div id="'. $unique_id .'" class="post-slider owl-carousel clearfix">';
			foreach ($attachments as $attachment) {
				$featured_image_url = wp_get_attachment_url($attachment);
				$featured_image = '<img src="' . aq_resize( $featured_image_url, $width, $height, true, true, true ) . '" alt="" />';
				?>
				
				<?php if( $blog_list_style == 'fullwidth_img' ){ ?>
					
					<div class="featured_img_bg" 
						<?php if( !empty( $featured_image_url )) { ?>
							style="background-image:url(<?php echo $featured_image_url ?>);"
						<?php } ?>
					></div>
					
				<?php } else { ?>
				
					<div class="item">
						<?php echo $featured_image; ?>
					</div>
					
				<?php } ?>
				
			<?php  }
        echo '</div>';
    }
?>