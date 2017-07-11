<?php
global $post;

$embed = get_post_meta($post->ID, 'post_format_audio_embed', true);
?>
		
		<div class="post-audio">
			<?php echo apply_filters("the_content", htmlspecialchars_decode($embed)) ?>
		</div>
	