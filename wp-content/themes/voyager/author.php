<?php
/**
 * The template for displaying Author Archive pages
 */
 
get_header();

$evatheme_user_post_count = count_user_posts( get_the_author_meta( 'ID' ), $post_type = 'post' );
$evatheme_author_google_profile = get_the_author_meta( 'evatheme_author_google_profile' );
$evatheme_author_twitter_profile = get_the_author_meta( 'evatheme_author_twitter_profile' );
$evatheme_author_facebook_profile = get_the_author_meta( 'evatheme_author_facebook_profile' );
$evatheme_author_linkedin_profile = get_the_author_meta( 'evatheme_author_linkedin_profile' );
$evatheme_author_instagram_profile = get_the_author_meta( 'evatheme_author_instagram_profile' );
$evatheme_author_tumblr_profile = get_the_author_meta( 'evatheme_author_tumblr_profile' );
?>

		<div id="author_posts_page">
			
			<?php if ( have_posts() ) : the_post(); ?>
			
				<div id="author_posts_info" class="clearfix">
					<div class="container text-center">
						<div class="author_posts_avatar"><?php echo get_avatar( get_the_author_meta('user_email'), '120', '' ); ?></div>
						<div class="author_posts_descr">
							<div class="author_posts_count"><?php echo $evatheme_user_post_count . ' ' . esc_html__('articles','voyager') ?></div>
							<h5 class="author_posts_name"><?php the_author(); ?></h5>
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
					</div>
				</div>
				
				<?php rewind_posts(); ?>
				
				<div class="container">
					<div class="page_title text-center">
						<h1><?php echo esc_html__( 'Author Posts', 'voyager' ); ?></h1>
					</div>
					<div class="row">
						
						<?php while ( have_posts() ) : the_post(); ?>

							<?php get_template_part('templates/blog/loop-grid-bg'); ?>

						<?php endwhile; ?>
						
						<?php wp_reset_postdata(); ?>
						
					</div>
					<?php cstheme_pagination(); ?>
				</div>
				
			<?php endif; ?>
				
		</div>

<?php get_footer(); ?>