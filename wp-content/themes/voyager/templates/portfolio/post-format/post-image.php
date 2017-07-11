<?php 

$featured_image_url = wp_get_attachment_url(get_post_thumbnail_id());
$featured_image = '<img src="' . $featured_image_url . '" alt="' . get_the_title() . '" />';
?>
	
	<?php if ( !empty( $featured_image_url )) { ?>
		<div class="portfolio_image">
			<?php echo $featured_image; ?>
		</div>
	<?php }?>