<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <?php cstheme_favicon(); ?>
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <script type="text/javascript">
        var cstheme_ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
    </script>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	
	<?php if( cstheme_option( 'fixed_sidebar_enable') ) { ?>
		<div class="fixed-sidebar">
			<a class="sidebar_btn_close" href="javascript:void(0);"></a>
			<div class="scroll-wrap"><?php get_sidebar('fixed'); ?></div>
		</div>
	<?php } ?>
	
	<?php if( cstheme_option( 'subscribe_popup_enable') ) {
		get_template_part( 'templates/subscribe-popup' );
	} ?>
	
	<?php if ( cstheme_woo_enabled() && cstheme_option( 'mini_cart_enabled') ) {
		echo cstheme_get_cart_icon();
		get_template_part( 'templates/mini-cart' );
	} ?>
	
	<div id="page-wrap">
		
		<?php get_template_part( 'templates/header/header_layout' ); ?>
		
		<?php get_template_part( 'templates/header/header-mobile' ); ?>
		
		<div id="page-content">