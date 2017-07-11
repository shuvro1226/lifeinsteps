<?php

$subscribe_popup_heading = cstheme_option( 'subscribe_popup_heading' );
$subscribe_popup_descr = cstheme_option( 'subscribe_popup_descr' );
$subscribe_popup_mailChimpid = cstheme_option( 'subscribe_popup_mailChimpid' );
?>
	
	<div class="subscribe_popup_btn"><a href="javascript:void(0);"><i class="fa fa-envelope-o"></i></a></div>
	<div class="subscribe_popup_wrap">
		<div class="subscribe_popup_bg"></div>
		<a class="subscribe_popup_close" href="javascript:void(0);"></a>
		<div class="subscribe_popup_content">
			<h4><?php echo esc_attr( $subscribe_popup_heading ); ?></h4>
			<p class="mb40"><?php echo esc_attr( $subscribe_popup_descr ); ?></p>
			<div class="clearfix">
			
				<?php
					if( function_exists( 'mc4wp_show_form' ) ) {
						mc4wp_show_form( $id = esc_html( $subscribe_popup_mailChimpid ) );
					}
				?>
			
			</div>
		</div>
	</div>
	<div class="subscribe_popup_back"></div>