<?php
/**
 * The portfolio post content
 */

global $post, $portfolio_style, $portfolio_in_a_row, $portfolio_layout;

if( $portfolio_in_a_row == '2' ) {
	$portfolio_class = 'col-sm-6 col-xs-12';
} elseif( $portfolio_in_a_row == '3' ) {
	$portfolio_class = 'col-md-4 col-sm-6 col-xs-12';
} elseif( $portfolio_in_a_row == '4' ) {
	$portfolio_class = 'col-md-3 col-sm-6 col-xs-12';
} elseif( $portfolio_in_a_row == '5' ) {
	$portfolio_class = 'col-md-25 col-sm-6 col-xs-12';
} else {
	$portfolio_class = 'col-md-12';
}

if ($portfolio_in_a_row == '5' && $portfolio_layout == 'wide') {
	$width = 470;
	$height = 360;
} elseif ($portfolio_in_a_row == '4' && $portfolio_layout == 'wide') {
	$width = 550;
	$height = 420;
} elseif ($portfolio_in_a_row == '3' && $portfolio_layout == 'wide') {
	$width = 650;
	$height = 500;
} elseif ($portfolio_in_a_row == '2' && $portfolio_layout == 'wide') {
	$width = 960;
	$height = 540;
} elseif ($portfolio_in_a_row == '5' && $portfolio_layout == 'container') {
	$width = 300;
	$height = 310;
} elseif ($portfolio_in_a_row == '4' && $portfolio_layout == 'container') {
	$width = 300;
	$height = 310;
} elseif ($portfolio_in_a_row == '3' && $portfolio_layout == 'container') {
	$width = 400;
	$height = 410;
} elseif ($portfolio_in_a_row == '2' && $portfolio_layout == 'container') {
	$width = 600;
	$height = 620;
} else {
	$width = 800;
	$height = 520;
}
if( $portfolio_style == 'masonry' ){
	$height = '';
}

$featured_image_url = wp_get_attachment_url(get_post_thumbnail_id());
$featured_image = '<img src="' . aq_resize( $featured_image_url, $width, $height, true, true, true ) . '" alt="' . get_the_title() . '" />';
$no_featured_image_url = get_template_directory_uri() . '/images/no_featured_img.jpg';
$no_featured_image = '<img src="' . get_template_directory_uri() . '/images/no_featured_img.jpg" alt="" />';

// Categories
$terms = get_the_terms( get_the_ID(), 'portfolio_category' );
if ( $terms && ! is_wp_error( $terms ) ) {
	$categories_links = array();
	foreach ( $terms as $term ) {
		$categories_links[] = '<a href="'.get_term_link($term->slug, "portfolio_category").'">'.$term->name.'</a>';
		$tempname = strtr($term->name, array(
			" " => "-",
			"'" => "-",
		));
		$portfolio_class .= ' ' . strtolower($tempname) . ' ';
		$echoterm[] = $term->name;
	}
	$categories_list = join( ", ", $echoterm );
} else {
	$categories_list = 'Uncategorized';
}
?>
 
		<article id="portfolio-<?php the_ID(); ?>" <?php post_class( $portfolio_class ); ?>>
			<div class="portfolio_content_wrapper clearfix">
				<div class="portfolio_descr_wrap clearfix">
					<span class="portfolio_likes heading_font"><?php echo cstheme_likes(); ?></span>
					<span class="portfolio_meta_category"><?php echo $categories_list; ?></span>
					<h2 class="portfolio-title"><a href="<?php the_permalink( $post->ID ); ?>" title="<?php printf( esc_attr__('Permalink to %s', 'voyager'), the_title_attribute('echo=0') ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
				</div>
				<div class="portfolio_format_content">
					<?php if(has_post_thumbnail()) { ?>
						<?php echo '<a href="' . get_permalink() . '">' . $featured_image . '<i class="fa fa-eye"></i></a>'; ?>
					<?php } else { ?>
						<?php echo '<a class ="no_featured_img" href="' . get_permalink() . '">' . $no_featured_image . '<i class="fa fa-eye"></i></a>'; ?>
					<?php } ?>
				</div>
			</div>
		</article>