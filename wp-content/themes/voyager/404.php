<?php
/**
 * The template for displaying 404 pages (not found)
 */

$page_404_bg = cstheme_option('page_404_bg');
get_header(); ?>
	
	<div id="error404_container" class="text-center <?php if (!empty($page_404_bg)){ echo 'page_404_bg'; } ?>" style="background-image:url( <?php echo esc_url( $page_404_bg ) ?> );">
		<div class="container">
			<h1><?php echo esc_html__('404', 'voyager'); ?></h1>
			<h2><?php echo esc_html__('Oops...Page not found!', 'voyager'); ?></h2>
			<?php get_search_form(true) ?>
			<div class="clearfix"></div>
			<a class="btnback" href="<?php echo esc_url( home_url( '/' ) ); ?>"><i class="fa fa-chevron-left"></i><?php echo esc_html_e('back to home page', 'voyager'); ?></a>
		</div>
	</div>

<?php get_footer(); ?>
