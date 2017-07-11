<?php

$instagram_type = cstheme_option( 'page_instagram_type' );
$instagram_title = cstheme_option( 'instagram_title' );
$instagram_descr = cstheme_option( 'instagram_descr' );
$instagram_link = cstheme_option( 'instagram_link' );
$type3_class = '';
if (is_404() ) {
	$type3_class = 'type3';
}
if( cstheme_woo_enabled() && ( is_shop() || is_product() || is_product_category() || is_product_tag() ) ) {
	$type3_class = 'type3';
}

if ( is_home() || is_category() || is_tag() || is_search() || is_day() || is_month() || is_year() ) {
	$instagram_type = cstheme_option( 'blog_instagram_type' );
} else if ( is_single() ){
	$instagram_type = cstheme_option( 'single_post_instagram_type' );
} else if ( is_page() ){
	$instagram_type = get_metabox('instagram_type');
}
?>
		
		<div class="instagram_wrap <?php echo $instagram_type ?> <?php echo $type3_class ?>">
			<?php if ( $instagram_type == 'type2' ) { ?>
				<div class="container text-center">
					<a class="custom_inst_link heading_font" href="<?php echo esc_url( $instagram_link ) ?>" target="_blank"><i class="fa fa-instagram"></i><?php echo esc_attr__('Join to Instagram','voyager') ?></a>
					<h2><?php echo esc_attr( $instagram_title ) ?></h2>
					<div class="instafeed_wrap">
						<div class="instagram_preloader">
							<div class="instagram_preloader_in"></div>
						</div>
						<div id="instafeed" class="clearfix"></div>
					</div>
				</div>
			<?php } else if ( $instagram_type == 'type3' || is_404() || ( cstheme_woo_enabled() && ( is_shop() || is_product() || is_product_category() || is_product_tag() ) ) ) { ?>
				<a class="custom_inst_link heading_font" href="<?php echo esc_url( $instagram_link ) ?>" target="_blank"><i class="fa fa-instagram"></i><?php echo esc_attr__('Join to Instagram','voyager') ?></a>
				<div class="instafeed_wrap">
					<div class="instagram_preloader">
						<div class="instagram_preloader_in"></div>
					</div>
					<div id="instafeed" class="clearfix"></div>
				</div>
			<?php } else { ?>
				<div class="container">
					<div class="row">
						<div class="col-md-6 mb30">
							<h2><?php echo esc_attr( $instagram_title ) ?></h2>
							<p><?php echo esc_attr( $instagram_descr ) ?></p>
							<a class="custom_inst_link heading_font" href="<?php echo esc_url( $instagram_link ) ?>" target="_blank"><i class="fa fa-instagram"></i><?php echo esc_attr__('Join to Instagram','voyager') ?></a>
						</div>
						<div class="col-md-6 mb30">
							<div class="instafeed_wrap">
								<div class="instagram_preloader">
									<div class="instagram_preloader_in"></div>
								</div>
								<div id="instafeed" class="clearfix"></div>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>