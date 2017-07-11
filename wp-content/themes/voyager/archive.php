<?php
/**
 * The template for displaying archive pages
 */

get_header();

$posts_in_a_row = cstheme_option('posts_in_a_row_stand_pages');
$blog_list_style = cstheme_option('blog_list_style_stand_pages');

if ( $blog_list_style == 'masonry-bg' ) {
	wp_enqueue_script('cstheme_isotope_js', get_template_directory_uri() . '/js/jquery.isotope.min.js', array(), false, true);
}

$sidebar_layout = cstheme_option( 'sidebar_layout' );
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
		
		<div id="blog_list" class="container mt0 <?php echo $blog_list_wrap_class ?> <?php echo ' blog_list_style_' . $blog_list_style . ' columns' . $posts_in_a_row; ?> clearfix">
			<div class="page_title text-center">
				<h1>
					<?php
						if ( is_day() ) :
							echo esc_html_e( 'DAILY ARCHIVES ', 'voyager' );
							printf( esc_html__( '%s', 'voyager' ), get_the_date() );

						elseif ( is_month() ) :
							echo esc_html_e( 'MONTHLY ARCHIVES ', 'voyager' );
							printf( esc_html__( '%s', 'voyager' ), get_the_date( esc_html_x( 'F Y', 'monthly archives date format', 'voyager' ) ) );

						elseif ( is_year() ) :
							echo esc_html_e( 'YEARLY ARCHIVES ', 'voyager' );
							printf( esc_html__( '%s', 'voyager' ), get_the_date( esc_html_x( 'Y', 'yearly archives date format', 'voyager' ) ) );

						else :
							esc_html_e( 'ARCHIVES', 'voyager' );

						endif;
					?>
				</h1>
			</div>
			<div class="row">
			
			<?php
			if( $sidebar_layout == 'left-sidebar' || $sidebar_layout == 'right-sidebar' ) {
			echo '
				<div class="' . $blog_list_class . '">
					<div class="row">
				';
			}
			
				if ( $blog_list_style == 'masonry-bg' ) {
					echo '
						<div class="isotope_container_wrap">
							<div class="isotope-container">
						';
				}
					
						while (have_posts()) {
							the_post();
							if ($blog_list_style == 'left-image') {
								get_template_part('templates/blog/loop-left-image');
							} else if ($blog_list_style == 'masonry-bg') {
								get_template_part('templates/blog/loop-masonry-bg');
							} else if ($blog_list_style == 'chess') {
								get_template_part('templates/blog/loop-chess');
							} else if ($blog_list_style == 'grid-bg') {
								get_template_part('templates/blog/loop-grid-bg');
							} else {
								get_template_part('templates/blog/loop');
							}
						}
				
				if ( $blog_list_style == 'masonry-bg' ) {
						echo '
							</div>
						</div>
					';
				}
			
			if( $sidebar_layout == 'left-sidebar' || $sidebar_layout == 'right-sidebar' ) {
			echo '
					</div>
				';
					
					cstheme_pagination();
			
			echo '
				</div>
				';
			}
			?>
				
				<?php if( $sidebar_layout == 'left-sidebar' || $sidebar_layout == 'right-sidebar' ) { ?>
					<div class="col-md-3 <?php echo $sidebar_class ?>">
						<?php get_sidebar(); ?>
					</div>
				<?php } ?>
				
			</div>
			
			<?php
				if( $sidebar_layout == 'no-sidebar' ) {
					cstheme_pagination();
				}
			?>
			
		</div>

<?php get_footer(); ?>