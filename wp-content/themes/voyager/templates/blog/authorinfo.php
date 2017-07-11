<?php

$voyager_authordesc = get_the_author_meta( 'description' );
?>
	
	<?php if ( ! empty ( $voyager_authordesc ) ) { ?>
	
		<div id="author-info" class="clearfix">
			<div class="author-image">
				<a class="author-avatar" href="<?php echo esc_url( get_author_posts_url(get_the_author_meta( 'ID' )) ); ?>"><?php echo get_avatar( get_the_author_meta('user_email'), '120', '' ); ?></a>
			</div>
			<div class="author_name">
				<div class="author_info_label"><?php echo esc_html__('Post Author','voyager') ?></div>
				<h5 class="author-name"><a href="<?php echo esc_url( get_author_posts_url(get_the_author_meta( 'ID' )) ); ?>"><?php the_author(); ?></a></h5>
				<?php
					$evatheme_author_google_profile = get_the_author_meta( 'evatheme_author_google_profile' );
					$evatheme_author_twitter_profile = get_the_author_meta( 'evatheme_author_twitter_profile' );
					$evatheme_author_facebook_profile = get_the_author_meta( 'evatheme_author_facebook_profile' );
					$evatheme_author_linkedin_profile = get_the_author_meta( 'evatheme_author_linkedin_profile' );
					$evatheme_author_instagram_profile = get_the_author_meta( 'evatheme_author_instagram_profile' );
					$evatheme_author_tumblr_profile = get_the_author_meta( 'evatheme_author_tumblr_profile' );
				?>
					<?php if ( $evatheme_author_google_profile != '' || $evatheme_author_twitter_profile != '' || $evatheme_author_facebook_profile != '' || $evatheme_author_linkedin_profile != '' || $evatheme_author_instagram_profile != '' || $evatheme_author_tumblr_profile != '' ) { ?>
						<div class="author_icons">
							<?php
								
								if ( $evatheme_author_google_profile && $evatheme_author_google_profile != '' ) {
										echo '<a class="social_link google-plus" href="' . esc_url($evatheme_author_google_profile) . '" target="_blank"><i class="fa fa-google-plus"></i></a>';
								}

								if ( $evatheme_author_twitter_profile && $evatheme_author_twitter_profile != '' ) {
										echo '<a class="social_link twitter" href="' . esc_url($evatheme_author_twitter_profile) . '" target="_blank"><i class="fa fa-twitter"></i></a>';
								}

								if ( $evatheme_author_facebook_profile && $evatheme_author_facebook_profile != '' ) {
										echo '<a class="social_link facebook" href="' . esc_url($evatheme_author_facebook_profile) . '" target="_blank"><i class="fa fa-facebook"></i></a>';
								}

								if ( $evatheme_author_linkedin_profile && $evatheme_author_linkedin_profile != '' ) {
									   echo '<a class="social_link linkedin" href="' . esc_url($evatheme_author_linkedin_profile) . '" target="_blank"><i class="fa fa-linkedin"></i></a>';
								}
								
								if ( $evatheme_author_instagram_profile && $evatheme_author_instagram_profile != '' ) {
									   echo '<a class="social_link instagram" href="' . esc_url($evatheme_author_instagram_profile) . '" target="_blank"><i class="fa fa-instagram"></i></a>';
								}
								
								if ( $evatheme_author_tumblr_profile && $evatheme_author_tumblr_profile != '' ) {
									   echo '<a class="social_link tumblr" href="' . esc_url($evatheme_author_tumblr_profile) . '" target="_blank"><i class="fa fa-tumblr"></i></a>';
								}
							?>
						</div>
					<?php } ?>
			</div>
			<div class="author-bio">
				<?php echo the_author_meta('description'); ?>
			</div>
		</div>
		
	<?php } ?>