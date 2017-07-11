<?php
global $post, $portfolio_single_layout;

$postid = get_the_ID();

$portfolio_single_carousel_enable = get_metabox( 'portfolio_single_carousel_enable' );

if( $portfolio_single_layout != 'full' ) {
	$width = 870;
	$height = 520;
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
		if( $portfolio_single_carousel_enable ) {
			echo '<div id="'. $unique_id .'" class="post-slider owl-carousel clearfix">';
		} else {
			echo '<div class="post_images_grid">';
		}
			foreach ($attachments as $attachment) {
				$featured_image_url = wp_get_attachment_url($attachment);
				$featured_image = '<img src="' . aq_resize( $featured_image_url, $width, $height, true, true, true ) . '" alt="" />';
				?>
				<div class="item">
					<?php echo $featured_image; ?>
				</div>
			<?php  }
		echo '</div>';
    }
?>
<script type="text/javascript">
	jQuery(window).load(function() {
		jQuery('#<?php echo $unique_id; ?>.owl-carousel').owlCarousel({
			items: 1,
			margin: 0,
			dots: false,
			nav: true,
			navText: [
				"<i class='fa fa-chevron-left'></i>",
				"<i class='fa fa-chevron-right'></i>"
			],
			loop: true,
			autoplay: true,
			autoplaySpeed: 1000,
			autoplayTimeout: 5000,
			navSpeed: 1000,
			autoplayHoverPause: true,
			thumbs: false
		});
	});
</script>