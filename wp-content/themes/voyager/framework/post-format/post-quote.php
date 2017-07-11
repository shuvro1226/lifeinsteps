<?php 
	$quote_text = get_post_meta($post->ID, 'format_quote_text', true);
	$quote_author = get_post_meta($post->ID, 'format_quote_author', true);
?>

<div class="post-quote">
	<?php if (!empty($quote_text)) { ?>
		<blockquote><p><?php echo esc_attr( $quote_text ); ?><small class="heading_font theme_color"><?php echo esc_attr( $quote_author ); ?></small></p></blockquote>
	<?php } ?>
</div>