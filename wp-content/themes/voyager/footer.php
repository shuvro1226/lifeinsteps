<?php
/**
 * The template for displaying the footer
 */
 
$instagram_enable = cstheme_option( 'instagram_enable' );
$instagram_userId = cstheme_option( 'instagram_userId' );
$prefooter_area_enable = get_metabox('prefooter_area_enable');
if ( is_single() ){
	$prefooter_area_enable = cstheme_option( 'single_post_prefooter_area_enable' );
	if ( $prefooter_area_enable ){
		$prefooter_area_enable = 'enabled';
	}
}
?>
		
		</div><!-- //page-content -->
		
		<?php if( !empty( $instagram_userId ) && ( $instagram_enable ) ) {
			get_template_part( 'templates/instagram' );
		} ?>
		
		<?php if( $prefooter_area_enable == 'enabled' ) { ?>
			<div id="prefooter_area">
				<div class="container">
					<div class="row">
						<?php get_sidebar('footer'); ?>
					</div>
				</div>
			</div>
		<?php } ?>
		
		<?php if( cstheme_option('footer_section') != 0 ) { ?>

			<footer>
				<div class="container">
					<div class="row">
						<div class="col-md-3 copyright_wrap">
							<?php $copyright_text = cstheme_option( 'copyright_text' ); ?>
							<?php if(!empty( $copyright_text ) ) { echo '<div class="copyright">'. esc_attr( $copyright_text ) .'</div>'; } ?>
						</div>
						<div class="col-md-6 social_links_wrap">
							<?php echo cstheme_social_links(); ?>
						</div>
						<div class="col-md-3 scroll_top_wrap">
							<a class="btn-scroll-top heading_font" href="javascript:void(0);"><?php echo esc_html__( 'Back top', 'voyager' ) ?><i class="fa fa-chevron-up"></i></a>
						</div>
					</div>
				</div>
			</footer>
			
		<?php } ?>
		
	</div><!-- //Page Wrap -->

<?php wp_footer(); ?>

</body>
</html>