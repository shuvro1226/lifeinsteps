<?php

global $post, $sidebar_layout, $blog_list_style;
	
$vimeo_url = get_post_meta($post->ID, 'post_vimeo_video_url', true);
$youtube_url = get_post_meta($post->ID, 'post_youtube_video_url', true);

if ($blog_list_style == 'clean_card') {
	$featured_image_url = wp_get_attachment_url(get_post_thumbnail_id());
	$width = 400;
	$height = 400;
	if( $sidebar_layout == 'left-sidebar' || $sidebar_layout == 'right-sidebar' ) {
		$width = 300;
		$height = 300;
	}
	$featured_image_bg = aq_resize( $featured_image_url, $width, $height, true, true, true );
}

	if ($blog_list_style == 'clean_card') { ?>
		
		<div class="pf_video_wrap video_player" style="background-image:url(<?php echo $featured_image_bg ?>);">
			<a class="pf_video_play" href="javascript:void(0)"><i class="fa fa-play"></i></a>
		
	<?php }
	
		if ( $vimeo_url ) { ?>

			<div class="post-video vimeo_video">
				<iframe src='https://player.vimeo.com/video/<?php echo esc_html( $vimeo_url ); ?>?portrait=0'></iframe>
			</div>

		<?php }

		if ( $youtube_url ) { ?>

			<div class="post-video youtube_video">
				<iframe src="https://www.youtube.com/embed/<?php echo esc_html( $youtube_url ); ?>?wmode=opaque" class="youtube-video" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
			</div>
			
		<?php }
	
	if ($blog_list_style == 'clean_card') { ?>
		
		</div>
		
	<?php }