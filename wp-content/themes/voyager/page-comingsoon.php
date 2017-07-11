<?php
/**
 * Template Name: Page - Coming Soon
 */

get_header('comingsoon');

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

$coming_img = '';
if(get_metabox('coming_img') != '') {
	$coming_img = get_metabox('coming_img');
}
$subscribe_popup_mailChimpid = cstheme_option( 'subscribe_popup_mailChimpid' );
$copyright_text = cstheme_option( 'copyright_text' );
?>
		
		<div class="coming_soon_wrapper text-center" style="background-image:url( <?php echo esc_url( $coming_img ) ?> );">
			<?php cstheme_logo(); ?>
			<div class="container">
				<h1><?php echo esc_html__("Hey Guys!", "voyager") ?></h1>
				<h1><?php echo esc_html__("We're Coming Soon...","voyager") ?></h1>
				
				<!-- COUNTDOWN -->
				<h3 class="theme_color"><span><?php echo esc_html__("to start left", "voyager") ?></span></h3>
				<ul class="countdown heading_font">
					<li>
						<span class="days">00</span>
						<p class="days_ref">Days</p>
					</li>
					<li>
						<span class="hours">00</span>
						<p class="hours_ref">Hours</p>
					</li>
					<li>
						<span class="minutes">00</span>
						<p class="minutes_ref">Minutes</p>
					</li>
					<li>
						<span class="seconds">00</span>
						<p class="seconds_ref">Seconds</p>
					</li>
				</ul><!-- //COUNTDOWN -->
				
				<?php if (get_metabox('comingsoon_subscribe_form') == 'show' && is_plugin_active('mailchimp-for-wp/mailchimp-for-wp.php')) { ?>
					<div class="comingsoon_subscribe_form clearfix">
						<?php
							if( function_exists( 'mc4wp_show_form' ) ) {
								mc4wp_show_form( $id = esc_html( $subscribe_popup_mailChimpid ) );
							}
						?>
					</div>
				<?php } ?>
				
				<?php if (get_metabox('comingsoon_social_links') == 'show') { ?>
					<div class="coming-soon-social-links">
						<h6><?php echo esc_html__("FIND US ON", "voyager") ?></h6>
						<?php echo cstheme_social_links(); ?>
					</div>
				<?php } ?>
				
				<p class="copyright"><?php if(!empty( $copyright_text ) ) { echo esc_attr( $copyright_text ); } ?></p>
			</div>
		</div>

<?php
	
	wp_enqueue_script('downCount_js', get_template_directory_uri() . '/js/jquery.downCount.js', array(), false, true);

	echo '
		<script>
			jQuery(document).ready(function() {
				jQuery(".countdown").downCount({
					date: "'. get_metabox('coming_months') .'/'. get_metabox('coming_days') .'/'. get_metabox('coming_years') .' 12:00:00"
				});
			});
		</script>
	';

get_footer('comingsoon');
?>