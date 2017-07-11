<?php

$format_link_url = get_post_meta($post->ID, 'format_link_url', true);
?>
	
	<?php if(!empty($format_link_url)) { ?>
		<div class="post-link">
			<a class="post-format-link-url heading_font theme_color" href="<?php echo esc_url( $format_link_url ); ?>"  target="_blank" title="<?php printf( esc_attr__('Permalink to %s', 'voyager'), the_title_attribute('echo=0') ); ?>" rel="bookmark"><?php echo esc_url( $format_link_url ); ?></a>
		</div>
	<?php } ?>