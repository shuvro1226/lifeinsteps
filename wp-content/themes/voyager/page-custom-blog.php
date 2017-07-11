<?php
/*
 *	Template Name: Page - Blog Custom
 */

get_header();
the_post();

$featured_image_url 		= wp_get_attachment_url(get_post_thumbnail_id());
$top_slider 				= get_metabox('top_slider');
$categories_list 			= get_metabox('categories_list');
$categories_list_position 	= get_metabox('categories_list_position');
$posts_carousel 			= get_metabox('posts_carousel');
$posts_carousel_position 	= get_metabox('posts_carousel_position');
$blog_list_category 		= get_metabox('blog_list_category');
$blog_list 					= get_metabox('blog_list');
$posts_per_page 			= get_metabox('posts_per_page');
$posts_in_a_row 			= get_metabox('posts_in_a_row');
$blog_list_layout 			= get_metabox('blog_list_layout');
$blog_list_style 			= get_metabox('blog_list_style');
if ($blog_list_style == 'chess' || $blog_list_style == 'left-image') {
	$blog_list_layout 		= 'container';
} else if( $blog_list_style == 'fullwidth_img' ){
	$blog_list_layout 		= 'wide';
}
$posts_pagin_style 			= get_metabox('posts_pagin_style');
$post_padding 				= get_metabox('post_padding');

if ( $blog_list_style == 'masonry-bg' || $blog_list_style == 'masonry_top_image' || $blog_list_style == 'metro' || $blog_list_style == 'clean_card' ) {
	wp_enqueue_script('cstheme_isotope_js', get_template_directory_uri() . '/js/jquery.isotope.min.js', array(), false, true);
}

if ($top_slider != 'disabled') {
	get_template_part( 'templates/slider/top_slider' );
} elseif (!empty($featured_image_url)) {
	echo '<div class="page_featured_image" style="background-image:url(' . $featured_image_url . ');"></div>';
}

$sidebar_layout = get_metabox( 'sidebar_layout' );
if( $sidebar_layout == 'left-sidebar' ) {
	$sidebar_class = 'pull-left ';
	$blog_list_wrap_class = 'left_sidebar ';
	$blog_list_class = 'col-md-9 pull-right';
} elseif( $sidebar_layout == 'right-sidebar' ) {
	$sidebar_class = 'pull-right';
	$blog_list_wrap_class = 'right_sidebar ';
	$blog_list_class = 'col-md-9 pull-left ';
} else {
	$sidebar_class = $blog_list_class = '';
	$blog_list_wrap_class = 'no_sidebar ';
}
?>

	<?php
		
		$three_posts_after_slider 	= get_metabox('three_posts_after_slider');
		
		if ( isset( $three_posts_after_slider ) && $three_posts_after_slider != '' ) {
			get_template_part( 'templates/blog/three_posts_after_slider' );
		}
	?>
	
	<?php
		
		$bloglist_banner1 = get_metabox('bloglist_banner1');
		
		if ( isset( $bloglist_banner1 ) && $bloglist_banner1 != '' ) {
			echo '<div class="container">';
				echo apply_filters("the_content", htmlspecialchars_decode($bloglist_banner1));
			echo '</div>';
		}
	?>
	
	<?php
		if ($categories_list == 'enabled' && $categories_list_position == 'top') {
			get_template_part( 'templates/blog/categories_list' );
		}
	?>
	
	<?php
		if ($posts_carousel == 'enabled' && $posts_carousel_position == 'top' ) {
			get_template_part( 'templates/blog/posts_carousel' );
		}
	?>
	
	<div class="container">
		<?php the_content(); ?>
	</div>
	
	<?php if ( $blog_list != 'disabled' && $blog_list_style != 'magazine' ) { ?>
	
		<div id="blog_list" class="<?php echo $blog_list_wrap_class . $blog_list_layout . ' blog_list_style_' . $blog_list_style . ' columns' . $posts_in_a_row; ?> <?php if ($post_padding == '0') { echo 'no_margin'; } ?> clearfix" <?php if ($blog_list_style == 'grid-bg' || $blog_list_style == 'masonry-bg' || $blog_list_style == 'metro') { ?> style="padding-top:<?php echo esc_attr($post_padding) ?>px;" <?php } ?>>
			
				<?php echo '
					<div class="row" '; if ($blog_list_layout != 'container' && ( $blog_list_style == 'grid-bg' || $blog_list_style == 'masonry-bg' ) ) { echo 'style="margin-left:' . esc_attr($post_padding) . 'px; margin-right:' . esc_attr($post_padding) . 'px;"'; } echo'>
				';
					
				if( ( $sidebar_layout == 'left-sidebar' || $sidebar_layout == 'right-sidebar' ) && $blog_list_layout == 'container' ) {
					echo '
						<div class="' . $blog_list_class . '">
							<div class="row">
						';
				}

						if ( $blog_list_style == 'masonry-bg' || $blog_list_style == 'masonry_top_image' || $blog_list_style == 'metro' || $blog_list_style == 'clean_card' ) {
							echo '
								<div class="isotope_container_wrap">
									<div class="isotope-container">
								';
						}
							
							if ( get_query_var('paged') ) { $paged = get_query_var('paged'); } else if ( get_query_var('page') ) {$paged = get_query_var('page'); } else {$paged = 1; }
							
							$i = 1;
							
							$temp = $wp_query;  // re-sets query
							$wp_query = null;   // re-sets query
							$args = array(
								'post_type' => 'post',
								'cat' => ((isset($blog_list_category) && $blog_list_category) ? $blog_list_category : 'all'),
								'posts_per_page' => ((isset($posts_per_page) && $posts_per_page) ? $posts_per_page : '6'),
								'paged' => $paged,
								'post_status' => 'publish'
							);
							$wp_query = new WP_Query();
							$wp_query->query( $args );
							
								while ($wp_query->have_posts()) : $wp_query->the_post();
									if ($blog_list_style == 'left-image') {
										get_template_part('templates/blog/loop-left-image');
									} else if ($blog_list_style == 'top_image') {
										get_template_part('templates/blog/loop-top_image');
									} else if ($blog_list_style == 'masonry_top_image') {
										get_template_part('templates/blog/loop-masonry_top_image');
									} else if ($blog_list_style == 'masonry-bg') {
										get_template_part('templates/blog/loop-masonry-bg');
									} else if ($blog_list_style == 'chess') {
										get_template_part('templates/blog/loop-chess');
									} else if ($blog_list_style == 'grid-bg') {
										get_template_part('templates/blog/loop-grid-bg');
									} else if ($blog_list_style == 'line_bg') {
										get_template_part('templates/blog/loop-line_bg');
									} else if ($blog_list_style == 'line_thumb') {
										get_template_part('templates/blog/loop-line_thumb');
									} else if ($blog_list_style == 'fullwidth_img') {
										get_template_part('templates/blog/loop-fullwidth_img');
									} else if ($blog_list_style == 'metro') {
										get_template_part('templates/blog/loop-metro');
									} else if ($blog_list_style == 'clean_card') {
										get_template_part('templates/blog/loop-clean_card');
									} else {
										get_template_part('templates/blog/loop');
									}
									
									$i++;
									
								endwhile;
								
						if ( $blog_list_style == 'masonry-bg' || $blog_list_style == 'masonry_top_image' || $blog_list_style == 'metro' || $blog_list_style == 'clean_card' ) {
								echo '
									</div>
								</div>
							';
						}
						
				if( ( $sidebar_layout == 'left-sidebar' || $sidebar_layout == 'right-sidebar' ) && $blog_list_layout == 'container' ) {
						echo '
							</div>
						';
							
							if($posts_pagin_style == 'infinite'){
								cstheme_infinite_scroll('query2');
							} else {
								cstheme_pagination();
							}

					echo '
						</div>
					';
				}
					
				if( ( $sidebar_layout == 'left-sidebar' || $sidebar_layout == 'right-sidebar' ) && $blog_list_layout == 'container' ) {
					echo '
						<div class="col-md-3 ' . $sidebar_class . '">
					';
							get_sidebar();
					echo '
						</div>
					';
				}
					
				echo '
					</div>
				';

				if( $sidebar_layout == 'no-sidebar' || $blog_list_layout == 'wide' ) {
					if($posts_pagin_style == 'infinite' && ( $blog_list_style == 'masonry-bg' || $blog_list_style == 'masonry_top_image' || $blog_list_style == 'metro' || $blog_list_style == 'clean_card' ) ){
						cstheme_infinite_scroll('query2');
					} else {
						cstheme_pagination();
					}
				}
				
				$wp_query = null;
				$wp_query = $temp; // Reset
				
				wp_reset_postdata();
			?>
			
		</div>
	
	<?php } ?>
	
	<?php
		
		if ( $blog_list != 'disabled' && $blog_list_style == 'magazine' ) {
			
			get_template_part('templates/blog/loop-magazine');

		}
		
	?>
	
	<?php
		if ($posts_carousel == 'enabled' && $posts_carousel_position == 'bottom' ) {
			get_template_part( 'templates/blog/posts_carousel' );
		}
	?>
	
	<?php
		if ($categories_list == 'enabled' && $categories_list_position == 'bottom') {
			get_template_part( 'templates/blog/categories_list' );
		}
	?>
	
	<?php comments_template(); ?>
<?php
get_footer();