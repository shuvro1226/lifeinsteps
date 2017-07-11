<?php 

global $sidebar_layout;
if( $sidebar_layout == 'left-sidebar' || $sidebar_layout == 'right-sidebar' ) {
	$width = 900;
	$height = 520;
} else {
	$width = 1200;
	$height = 700;
}

$featured_image_url = wp_get_attachment_url(get_post_thumbnail_id());
if( !is_single() ){
	$featured_image = '<img src="' . aq_resize( $featured_image_url, $width, $height, true, true, true ) . '" alt="" />';
} else {
	$featured_image = '<img src="' . $featured_image_url . '" alt="" />';
}
?>
	
	<?php if (has_post_thumbnail()) { ?>
		<div class="post-image">
			<?php if ( !is_single() ) { ?>
				<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__('Permalink to %s', 'voyager'), the_title_attribute('echo=0') ); ?>" rel="bookmark">
			<?php } ?>
				<?php echo $featured_image; ?>
			<?php if ( !is_single() ) { ?>
				</a>
			<?php } ?>
		</div>
	<?php }?>