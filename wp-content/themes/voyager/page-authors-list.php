<?php
/*
 *	Template Name: Page - Authors List
 */

get_header();

$featured_image_url = wp_get_attachment_url(get_post_thumbnail_id());

$sidebar_layout = get_metabox( 'sidebar_layout' );
if( $sidebar_layout == 'left-sidebar' ) {
	$sidebar_class = 'pull-left';
	$page_content_class = 'col-md-9 pull-right ';
} elseif( $sidebar_layout == 'right-sidebar' ) {
	$sidebar_class = 'pull-right ';
	$page_content_class = 'col-md-9 pull-left ';
} else {
	$sidebar_class = '';
	$page_content_class = 'col-md-12 ';
}
?>
		
		<div id="authors_list_page">
			
			<?php
				if (!empty($featured_image_url)) {
					echo '<div class="page_featured_image" style="background-image:url(' . $featured_image_url . ');"></div>';
				}
			?>
			
			<div class="container">
				<div class="row">
					<div class="<?php echo $page_content_class ?>">
						<div class="page_title text-center">
							<h1><?php the_title(); ?></h1>
						</div>
						
						<div class="row">
						
							<?php

								global $wpdb;
								
								$query = "SELECT ID, user_nicename from $wpdb->users ORDER BY user_nicename";
								$author_ids = $wpdb->get_results($query);

								foreach($author_ids as $author) :

									$curauth = get_userdata($author->ID);

									if($curauth->user_level > 0 || $curauth->user_login == 'admin') :

										$user_link = get_author_posts_url($curauth->ID);
										$avatar = 'identicon';
										$evatheme_user_post_count = count_user_posts( $curauth->ID, $post_type = 'post' );
										$evatheme_author_google_profile = get_user_meta( $curauth->ID, 'evatheme_author_google_profile', true );
										$evatheme_author_twitter_profile = get_user_meta( $curauth->ID, 'evatheme_author_twitter_profile', true );
										$evatheme_author_facebook_profile = get_user_meta( $curauth->ID, 'evatheme_author_facebook_profile', true );
										$evatheme_author_linkedin_profile = get_user_meta( $curauth->ID, 'evatheme_author_linkedin_profile', true );
										$evatheme_author_instagram_profile = get_user_meta( $curauth->ID, 'evatheme_author_instagram_profile', true );
										?>
										
										<div class="col-md-3">
											<div class="author_item text-center mb60">
												<a class="author_posts_avatar" href="<?php echo esc_url( $user_link ); ?>" title="Articles by <?php echo esc_attr( $curauth->display_name ); ?>"><?php echo get_avatar($curauth->user_email, '250', $avatar); ?></a>
												<div class="author_posts_count"><?php echo $evatheme_user_post_count . ' ' . esc_html__('articles','voyager') ?></div>
												<h5 class="author_posts_name"><a href="<?php echo esc_url( $user_link ); ?>" title="Articles by <?php echo esc_attr( $curauth->display_name ); ?>"><?php echo esc_attr( $curauth->display_name ); ?></a></h5>
												<?php if ( $evatheme_author_google_profile != '' || $evatheme_author_twitter_profile != '' || $evatheme_author_facebook_profile != '' || $evatheme_author_linkedin_profile != '' || $evatheme_author_instagram_profile != '' ) { ?>
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
														?>
													</div>
												<?php } ?>
											</div>
										</div>
								
									<?php endif; ?>
								
							<?php endforeach; ?>
						
						</div>
					</div>
					
					<?php 
						if( $sidebar_layout == 'left-sidebar' || $sidebar_layout == 'right-sidebar' ) {
							echo '<div class="col-md-3 ' . $sidebar_class . '">';
								get_sidebar();
							echo '</div>';
						}
					?>
					
				</div>
			</div>
		</div>

<?php get_footer(); ?>