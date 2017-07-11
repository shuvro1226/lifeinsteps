<div class="sharebox">
	<a class="sharebox_btn heading_font" href="javascript:void(0);"><i class="fa fa-share-alt"></i><?php echo esc_html__('Share','voyager'); ?></a>
	
	<div class="sharebox_links">
		<?php if(cstheme_option('check_sharingboxfacebook') == true) { ?>
			<a class="social_link facebook" href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&t=<?php the_title(); ?>" title="<?php esc_html_e( 'Facebook', 'voyager') ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><i class="fa fa-facebook"></i></a>
		<?php } ?>
		
		<?php if(cstheme_option('check_sharingboxtwitter') == true) { ?>
			<a class="social_link twitter" href="http://twitter.com/home?status=<?php the_title(); ?> <?php the_permalink(); ?>" title="<?php esc_html_e( 'Twitter', 'voyager') ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><i class="fa fa-twitter"></i></a>
		<?php } ?>
		
		<?php if(cstheme_option('check_sharingboxlinkedin') == true) { ?>
			<?php $featured_image_url = wp_get_attachment_url(get_post_thumbnail_id()); ?>
			<a class="social_link linkedin" href="https://www.linkedin.com/cws/share?url=<?php echo get_permalink(); ?>&title=<?php echo get_the_title(); ?>&summary=<?php echo get_the_excerpt(); ?>" title="Linkedin Share" data-image="<?php echo $featured_image_url ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><i class="fa fa-linkedin"></i></a><script type="in/share" data-url="<?php echo get_permalink() ?>" data-counter="right"></script>
		<?php } ?>
		
		<?php if(cstheme_option('check_sharingboxreddit') == true) { ?>
			<a class="social_link reddit" href="http://www.reddit.com/submit?url=<?php the_permalink() ?>&amp;title=<?php echo urlencode(the_title('', '', false)) ?>" title="<?php esc_html_e( 'Reddit', 'voyager') ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><i class="fa fa-reddit"></i></a>
		<?php } ?>
		
		<?php if(cstheme_option('check_sharingboxdigg') == true) { ?>
			<a class="social_link digg" href="http://digg.com/submit?phase=2&amp;url=<?php the_permalink() ?>&amp;bodytext=&amp;tags=&amp;title=<?php echo urlencode(the_title('', '', false)) ?>" title="<?php esc_html_e( 'Digg', 'voyager') ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><i class="fa fa-digg"></i></a>
		<?php } ?>
		
		<?php if(cstheme_option('check_sharingboxdelicious') == true) { ?>
			<a class="social_link delicious" href="http://www.delicious.com/post?v=2&amp;url=<?php the_permalink() ?>&amp;notes=&amp;tags=&amp;title=<?php echo urlencode(the_title('', '', false)) ?>" title="<?php esc_html_e( 'Delicious', 'voyager') ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><i class="fa fa-delicious"></i></a>
		<?php } ?>
		
		<?php if(cstheme_option('check_sharingboxgoogle') == true) { ?>
			<a class="social_link google-plus" href="http://plus.google.com/share?url=<?php the_permalink() ?>&amp;title=<?php echo str_replace(' ', '+', the_title('', '', false)); ?>" title="<?php esc_html_e( 'Google+', 'voyager') ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><i class="fa fa-google-plus"></i></a>
		<?php } ?>
		
		<?php if(cstheme_option('check_sharingboxpinterest') == true) { ?>
			<?php $featured_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID())); ?>
			<a class="social_link pinterest" href="http://pinterest.com/pin/create/button/?url=<?php echo get_permalink(); ?>&media=<?php echo (strlen($featured_image_url[0]) > 0) ? $featured_image_url[0] : get_option( 'cstheme_logo' ); ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><i class="fa fa-pinterest-p"></i></a>
		<?php } ?>
		
		<?php if(cstheme_option('check_sharingboxtumblr') == true) { ?>
			<a target="_blank" href="http://www.tumblr.com/share/link?url=<?php echo urlencode(get_permalink()) ?>&amp;name=<?php echo urlencode($post->post_title) ?>&amp;description=<?php echo urlencode(get_the_excerpt())?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><i class="fa fa-tumblr"></i></a>
		<?php } ?>
	</div>
</div>